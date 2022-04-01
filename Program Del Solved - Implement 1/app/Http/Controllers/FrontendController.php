<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Discussion;
use App\Models\User;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $user = new User;
        $users_online =  $user->allOnline();
        $forumsCount = count(Forum::all());
        $topicsCount = count(Discussion::all());
        $totalMembers = count(User::all());
        $newest = User::latest()->first();
        $totalCategories = count(Category::all());
        $categories = Category::latest()->get();
        // dd($categories);
        $few_users = User::latest()->take(5)->get();
        return view('welcome', \compact('categories', 'forumsCount', 'topicsCount', 'newest', 'totalMembers', 'totalCategories', 'users_online', 'few_users', 'user'));
    }

    public function categoryOverview($id)
    {
        $user = new User;
        $users_online =  $user->allOnline();
        $forumsCount = count(Forum::all());
        $topicsCount = count(Discussion::all());
        $totalMembers = count(User::all());
        $newest = User::latest()->first();
        $totalCategories = count(Category::all());
        $category = Category::find($id);
        
        return view('client.category-overview', \compact('category', 'forumsCount', 'topicsCount', 'newest', 'totalMembers', 'totalCategories', 'users_online'));
    }

    public function forumOverview($id)
    {
        $forum = Forum::find($id);
        return view('client.forum-overview', \compact('forum'));
    }

    public function profile($id)
    {   
        $user = User::find($id);
        $discussions = Discussion::where('user_id', $id)->get();
        return view('client.user_profile', compact('discussions', 'user'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('client.users', \compact('users'));
    }

    public function photoUpdate(Request $request, $id)
    {
        if (!$request->profile_image) {
            toastr()->error('Please select Image!');
            return back();
        }

        $image = $request->profile_image;
        $name = $image->getClientOriginalName();
        $new_image = time().$name;
        $dir = 'storage/profile/';
        $image->move($dir, $new_image);

        $user = User::find($id);
        $user->image = $new_image;
        $user->save();
        toastr()->success('The profile photo updated successfully');
        return back();
    }

    /**
     * delete topic by admin
     */
    public function deleteTopic($id) {
        Discussion::find($id)->delete();
        return back();
    }

}
