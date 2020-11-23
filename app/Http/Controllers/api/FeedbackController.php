<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Interfaces\FeedbackTypes;
use App\Services\FeedbackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'name'=>'required|string',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message'=>'required|string'
        ]);
        if($validate->fails()){
            return response()->json([
                'status'=>'401',
                'error'=>$validate->failed()
            ]);
        }
        // saving to different storage
        $feedback = FeedbackService::save($request);

        return response()->json([
            'status'=>'200',
            'data'=>new \App\Http\Resources\Feedback($feedback)
        ]);

    }


}
