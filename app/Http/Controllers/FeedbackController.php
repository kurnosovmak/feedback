<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request){
        $createForm = null;
        return view('feedback');
    }
}
