<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tim_Persik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Tim_PersikController extends Controller
{
    public function index()
    {
        $persiks = Tim_Persik::all();
        if ($persiks->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $persiks
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
        $persiks = new Tim_Persik();
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'keterangan' => 'required',
            'kewarganegaraan' => 'required',
            'is_aktif' => 'required',
            'url_logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'pemain' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'posisi_pemain' => 'required'
        ]);
        $filename = "";
        if ($request->hasFile('url_logo')) {
            $md5Name = md5_file($request->file('url_logo')->getRealPath());
            $guessExtension = $request->file('url_logo')->guessExtension();
            $filename = Str::uuid()->toString() . "." . $guessExtension;
            $fullpath = $request->file('url_logo')->storeAs('public/img', $filename);
        } else {
            $filename = Null;
        }

        $filename = "";
        if ($request->hasFile('pemain')) {
            $md5Name = md5_file($request->file('pemain')->getRealPath());
            $guessExtension = $request->file('pemain')->guessExtension();
            $filename = Str::uuid()->toString() . "." . $guessExtension;
            $fullpath = $request->file('pemain')->storeAs('public/img', $filename);
        } else {
            $filename = Null;
        }

        $persiks->id = $request->id;
        $persiks->nama = $request->nama;
        $persiks->keterangan = $request->keterangan;
        $persiks->kewarganegaraan = $request->kewarganegaraan;
        $persiks->is_aktif = $request->is_aktif;
        $persiks->url_logo = "storage/img/" . $filename;
        $persiks->Pemain = "storag/img/" . $filename;
        $persiks->posisi_pemain = $request->posisi_pemain;
        $result = $persiks->save();

        if ($result) {

            return response()->json([
                'status' => 422,
                'message' => $persiks
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
        $persiks = Tim_Persik::find($id);
        if ($persiks) {

            return response()->json([
                'status' => 200,
                'message' => $persiks
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
        $persiks = Tim_Persik::find($id);
        if ($persiks) {

            return response()->json([
                'status' => 200,
                'message' => $persiks
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
            'nama'  => 'required',
            'keterangan'  => 'required',
            'kewarganegaraan'  => 'required',
            'is_aktif'  => 'required',
            'url_logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'posisi_pemain'  => 'required'
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

    public function destory($id)
    {
        $persiks = Tim_Persik::find($id);
        if ($persiks) {

            $persiks->delete();
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
