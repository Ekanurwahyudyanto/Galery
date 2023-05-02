<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tim_ligas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\support\Facades\Validate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Tim_LigasController extends Controller
{
    public function index()
    {
        $tim_ligas = Tim_ligas::all();
        if ($tim_ligas->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $tim_ligas
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
        $tim_ligas = new Tim_ligas();
        $request->validate([
            'nama' => 'required',
            'stadiun' => 'required',
            'keterangan' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $filename = "";
        if ($request->hasFile('image')) {
            $md5Name = md5_file($request->file('image')->getRealPath());
            $guessExtension = $request->file('image')->guessExtension();
            $filename = Str::uuid()->toString().".".$guessExtension;
            $fullpath = $request->file('image')->storeAs('public/img', $filename);
        } else {
            $filename = Null;
        }

        $tim_ligas->id = $request->id;
        $tim_ligas->nama = $request->nama;
        $tim_ligas->stadiun = $request->stadiun;
        $tim_ligas->keterangan = $request->keterangan;
        $tim_ligas->image = "storage/img/".$filename;
        $result = $tim_ligas->save();
        
        if ($result) {

            return response()->json([
                'status' => 422,
                'message' => $tim_ligas
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
        $tim_ligas = Tim_ligas::find($id);
        if ($tim_ligas) {

            return response()->json([
                'status' => 200,
                'message' => $tim_ligas
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Tim_Persik Found!"
            ], 404);
        }
    }

    public function edit($id)
    {
        $tim_ligas = Tim_ligas::find($id);
        if ($tim_ligas) {

            return response()->json([
                'status' => 200,
                'message' => $tim_ligas
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Tim_Persik Found!"
            ], 404);
        }
    }
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id',
            'nama',
            'stadiun',
            'keterangan',
            'image'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $tim_ligas = Tim_ligas::find($id);
            if ($tim_ligas) {

                $tim_ligas->update([
                    'id' => $request->id,
                    'nama' => $request->nama,
                    'stadiun' => $request->stadiun,
                    'keterangan' => $request->keterangan,
                    'path'=> $request->path
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $tim_ligas
                ], 200);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => "No Such Tim_Persik Found!"
                ], 404);
            }
        }
    }
    public function destory($id)
    {
        $tim_ligas = Tim_ligas::find($id);
        if ($tim_ligas) {

            $tim_ligas->delete();
            return response()->json([
                'status' => 200,
                'message' => "Tim_Persik Deleted Succesfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Tim_Persik Found!"
            ], 404);
        }
    }
}
