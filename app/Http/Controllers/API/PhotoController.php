<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = photo::all();
        if($photos->count()>0){
            
            return response()->json([
                'status' =>200,
                'photos' =>$photos
            ],200);
        } else {

            return response()->json([
                'status' =>400,
                'message' =>"No records created"
            ],400);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id',
            'galery_pertandingan_id',
            'path',
            'is_default'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' =>422,
                'message' =>$validator->message()
            ],422);
        }else{
            $photos = photo::create([
                'id'=>$request->id,
                'galery_pertandingan_id'=>$request->galery_pertandingan_id,
                'path'=>$request->path,
                'is_default'=>$request->is_default
            ]);

        if($photos){

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
        $photos = photo::find($id);
        if($photos){

            return response()->json([
                'status' => 200,
                'photos' => $photos
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Such Photos Found!"
            ],404);
        }
    }

    public function edit($id)
    {
        $photos = photo::find($id);
        if($photos){

            return response()->json([
                'status' => 200,
                'photos' => $photos
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Such Photos Found!"
            ],404);
    }
}
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'id',
            'galery_pertandingan_id',
            'path',
            'is_default'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' =>422,
                'message' =>$validator->message()
            ],422);
        }else{

        $photos = photo::find($id);        
        if($photos){

            $photos->update([
                'id'=>$request->id,
                'galery_pertandingan_id'=>$request->galery_pertandingan_id,
                'path'=>$request->path,
                'is_default'=>$request->is_default
            ]);

            return response()->json([
                'status' =>200,
                'message' =>"Successfully Update"
            ],200);
        }else{

            return response()->json([
                'status' =>404,
                'message' =>"No Such Photos  Found!"
            ],404);
        }
    }

    }

    public function destory($id)
    {
        $photos = photo::find($id);
        if($photos){
            
            $photos->delete();
            return response()->json([
                'status' =>200,
                'message' =>"Delete Successfully"
            ],200);
            
        }else{
            return response()->json([
                'status' =>404,
                'message' =>"No Such Photos  Found!"
            ],404);
        }
    }
}
