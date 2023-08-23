<?php

namespace App\Http\Controllers\API;

use App\Models\replay;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\support\Facades\Validate;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\ReplayController;

class ReplayController extends Controller
{
    public function index()
    {
        $replays = replay::all();
        if ($replays->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $replays
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Record Found"
            ], 404);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id',
            'tuan_rumah_id',
            'penantang_id',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' =>422,
                'message' =>$validator->message()
            ],422);
        }else{
            $replays = replay::create([
                'id'=>$request->id,
                'tuan_rumah_id'=>$request->tuan_rumah_id,
                'penantang_id'=>$request->penantang_id,
            ]);

        if($replays){

            return response()->json([
                'status' =>200,
                'message' =>"Successfully Created"
            ],200);
        }else{

            return response()->json([
                'status' =>500,
                'message' =>"Someting Went Created"
            ],500);
        }
    }

    }

    public function show($id)
    {
        $replays = jadwal_pertandingans::find($id);
        if($replays){

            return response()->json([
                'status' => 200,
                'replays' => $replays
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Such replays Found!"
            ],404);
        }
    }

    public function edit($id)
    {
        $replays = jadwal_pertandingans::find($id);
        if($replays){

            return response()->json([
                'status' => 200,
                'replays' => $replays
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Such replays Found!"
            ],404);
    }
}

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'id',
            'tuan_rumah_id',
            'penantang_id',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' =>422,
                'message' =>$validator->message()
            ],422);
        }else{

        $replays = jadwal_pertandingans::find($id);        
        if($replays){

            $replays->update([
                'id'=>$request->id,
                'tuan_rumah_id'=>$request->tuan_rumah_id,
                'penantang_id'=>$request->penantang_id,
            ]);

            return response()->json([
                'id'=>$request->id,
                'tuan_rumah_id'=>$request->tuan_rumah_id,
                'penantang_id'=>$request->penantang_id,
            ],200);
        }else{

            return response()->json([
                'status' =>404,
                'message' =>"No Such Galerys  Found!"
            ],404);
        }
    }

    }

    public function destory($id)
    {
        $replays = replay::find($id);
        if($replays){
            
            $replays->delete();
            return response()->json([
                'status' =>200,
                'message' =>"Delete Successfully"
            ],200);
            
        }else{
            return response()->json([
                'status' =>404,
                'message' =>"No Such replays  Found!"
            ],404);
        }
    }
}
