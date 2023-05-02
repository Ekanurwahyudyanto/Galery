<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Harga_Tikets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Harga_TiketsController extends Controller
{
    public function index()
    {
        //$harga_tiket = Harga_Tikets::all();
        $harga_tiket = Harga_Tikets::with('tiket.tuan_rumah','tiket.penantang','jenis_tiket')->get();
        if ($harga_tiket->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $harga_tiket
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
        $validator = Validator::make($request->all(), [
            'id',
            'tiket_id',
            'harga',
            'jenis_tiket_id',
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $harga_tiket = Harga_Tikets::create([
                'id' => $request->id,
                'tiket_id' => $request->tiket_id,
                'harga' => $request->harga,
                'jenis_tiket_id' => $request->jenis_tiket_id,
            ]);

            if ($harga_tiket) {

                return response()->json([
                    'status' => 200,
                    'message' => $harga_tiket
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ], 500);
            }
        }
    }
    public function show($id)
    {
        $harga_tiket = Harga_Tikets::find($id);
        if ($harga_tiket) {

            return response()->json([
                'status' => 200,
                'message' => $harga_tiket
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
        $harga_tiket = Harga_Tikets::find($id);
        if ($harga_tiket) {

            return response()->json([
                'status' => 200,
                'message' => $harga_tiket
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
            'tiket_id',
            'harga',
            'jenis_tiket_id',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $harga_tiket = Harga_Tikets::find($id);
            if ($harga_tiket) {

                $harga_tiket->update([
                    'id' => $request->id,
                    'nama' => $request->nama,
                    'keterangan' => $request->keterangan,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $harga_tiket
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
        $harga_tiket = Harga_Tikets::find($id);
        if ($harga_tiket) {

            $harga_tiket->delete();
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
