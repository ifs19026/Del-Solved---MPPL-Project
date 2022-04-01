<?php

namespace App\Http\Controllers;

use App\Models\ForumRequest;
use App\Models\RequestCategory;
use App\Models\User;
use App\Notifications\NewRequestCategory;
use App\Notifications\NewRequestForum;
use Illuminate\Http\Request;

class RequestController extends Controller
{

    /**
     * menampilkan halaman form menambahkan
     * request category baru
     */
    public function show_category_view() {
        return view('request.request_category');
    }

    /**
     * menyimpan data request category baru yang ditambahkan
     * di form ke dalam database
     */
    public function store_request_category(Request $request) {
        $request_category = new RequestCategory();
        $request_category->category_title = $request->request_category;
        $request_category->user_id = auth()->id();
        $request_category->save();

        $latest_request_category = RequestCategory::latest()->first();
        $admins = User::where('is_admin', 1)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewRequestCategory($latest_request_category));
        }

        return redirect('/');
    }

    /**
     * menampilkan halaman form menambahkan
     * request forum baru
     */
    public function show_forum_view() {
        return view('request.request_forum');
    }

    /**
     * menyimpan data request forum baru yang ditambahkan
     * di form ke dalam database
     */
    public function store_request_forum(Request $request) {
        $request_forum = new ForumRequest();
        $request_forum->forum_title = $request->request_forum;
        $request_forum->user_id = auth()->id();
        $request_forum->save();

        $latest_request_forum = ForumRequest::latest()->first();
        $admins = User::where('is_admin', 1)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewRequestForum($latest_request_forum));
        }

        return redirect('/');
    }

}
