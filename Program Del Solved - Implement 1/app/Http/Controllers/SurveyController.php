<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
        
    /**
     * menampilkan seluruh survey
     */
    public function showAllSurvey() {
        $surveys = Survey::all();
        return view('survey.surveys', compact('surveys'));
    }

    /**
     * menampikan form untuk memasukkan survey baru
     */
    public function showForm() {
        return view('survey.survey_form');
    }

    /**
     * untuk menyimpan data yang sudah ditambahkan di form
     * ke dalam database
     */
    public function storeSurvey(Request $request) {
        $survey = new Survey();
        $survey->title = $request->title;
        $survey->body = $request->body;
        $survey->link = $request->link;
        $survey->user_id = auth()->id();
        $survey->save();
        return back();
    }

    /**
     * menampilkan survey tertentu -> selengkapnya
     */
    public function showSurvey($id) {
        $survey = Survey::find($id);
        return view('survey.survey', compact('survey'));
    }

    /**
     * menampilkan survey kepemilikan
     */
    public function showSelfSurvey($id) {
        if (auth()->id() != $id) {
            echo "NOT FOUND";
        } else {
            $surveys = Survey::where('user_id', $id)->get();
            return view('survey.self_survey', compact('surveys'));
        }
    }

    /**
     * menampilkan form untuk mengedit survey
     */
    public function editSurveyForm($id) {
        $survey = Survey::find($id);
        return view('survey.survey_edit_form', compact('survey'));
    }

    /**
     * menyimpan data hasil edit
     */
    public function storeEditSurvey(Request $request, $id) {
        $survey = Survey::find($id);
        $survey->title = $request->title;
        $survey->body = $request->body;
        $survey->link = $request->link;
        $survey->update();

        $user_id = auth()->id();
        
        return redirect("/survey/self/$user_id");
    }

    /**
     * hapus data survey
     */
    public function deleteSurvey($id) {
        Survey::find($id)->delete();
        return back();
    }

}
