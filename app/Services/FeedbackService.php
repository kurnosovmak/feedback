<?php


namespace App\Services;


use App\Models\Feedback;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FeedbackService
{

    public static function save($request){
        $model = self::saveToBd($request);
        self::saveToFile($request);

        return $model;
    }


    private static function saveToBd($request){
        $model = Feedback::factory($request->all())->create();
        return $model;
    }

    private static function saveToFile($request){
        $model = Feedback::factory($request->all())->make();
        $contents ='';
        if(Storage::disk('local')->exists('feedback.txt')) {
            $contents = Storage::disk('local')->get('feedback.txt').':';
        }
        Storage::disk('local')->put('feedback.txt', $contents.$model->toJson());
        return $model;
    }

}
