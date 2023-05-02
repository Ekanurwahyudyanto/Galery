<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\support\Facades\Validate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = photos::all();
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
        $photos = new photos();
        $validator = Validator::make($request->all(),[
            'id',
            'galery_pertandingan_id' => 'required',
            'path' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'is_default'  => 'required'
        ]);

        $filename = "";
        if ($request->hasFile('path')) {
            $md5Name = md5_file($request->file('path')->getRealPath());
            $guessExtension = $request->file('path')->guessExtension();
            $filename = Str::uuid()->toString().".".$guessExtension;
            $fullpath = $request->file('path')->storeAs('public/img', $filename);
        } else {
            $filename = Null;
        }

        $photos->id = $request->id;
        $photos->galery_pertandingan_id = $request->galery_pertandingan_id;
        $photos->path = "storage/img/".$filename;
        $photos->is_default = $request->is_default;
        $result = $photos->save();

        if ($result) {

            return response()->json([
                'status' => 422,
                'message' => $photos
            ], 422);
        } else {

                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ], 500);
            
        }

    }

    public function show($id)
    {
        $photos = photos::find($id);
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
        $photos = photos::find($id);
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
            //'is_default'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' =>422,
                'message' =>$validator->message()
            ],422);
        }else{

        $photos = photos::find($id);        
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
        $photos = photos::find($id);
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
