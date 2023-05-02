<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jenis_Tikets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Jenis_TiketsController extends Controller
{
    public function index()
    {
        $jenis_tiket = Jenis_Tikets::all();
        if ($jenis_tiket->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $jenis_tiket
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

        $jenis_tiket = new Jenis_Tikets();
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'keterangan' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $filename = "";
        if ($request->hasFile('keterangan')) {
            $md5Name = md5_file($request->file('keterangan')->getRealPath());
            $guessExtension = $request->file('keterangan')->guessExtension();
            $filename = Str::uuid()->toString().".".$guessExtension;
            $fullpath = $request->file('keterangan')->storeAs('public/img', $filename);
        } else {
            $filename = Null;
        }

        $jenis_tiket->id = $request->id;
        $jenis_tiket->nama = $request->nama;
        $jenis_tiket->keterangan = "storage/img/".$filename;
        $result = $jenis_tiket->save();
        
        if ($result) {

            return response()->json([
                'status' => 422,
                'message' => $jenis_tiket
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
        $jenis_tiket = Jenis_Tikets::find($id);
        if ($jenis_tiket) {

            return response()->json([
                'status' => 200,
                'message' => $jenis_tiket
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Tiket Found!"
            ], 404);
        }
    }

    public function edit($id)
    {
        $jenis_tiket = Jenis_Tikets::find($id);
        if ($jenis_tiket) {

            return response()->json([
                'status' => 200,
                'message' => $jenis_tiket
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Tiket Found!"
            ], 404);
        }
    }
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id',
            'nama',
            'keterangan'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $jenis_tiket = Jenis_Tikets::find($id);
            if ($jenis_tiket) {

                $jenis_tiket->update([
                    'id' => $request->id,
                    'nama' => $request->nama,
                    'keterangan' => $request->keterangan,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $jenis_tiket
                ], 200);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => "No Such Tiket Found!"
                ], 404);
            }
        }
    }
    public function destory($id)
    {
        $jenis_tiket = Jenis_Tikets::find($id);
        if ($jenis_tiket) {

            $jenis_tiket->delete();
            return response()->json([
                'status' => 200,
                'message' => "Tiket Deleted Succesfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Tiket Found!"
            ], 404);
        }
    }
}
