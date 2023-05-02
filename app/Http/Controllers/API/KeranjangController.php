<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeranjangController extends Controller
{
    public function index()
    {
        //$keranjang = Keranjang::all();
        $keranjang = keranjang::with('harga_tiket','tiket.tuan_rumah','tiket.penantang')->get();
        if ($keranjang->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $keranjang
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
            'harga_tiket_id',
            'harga',
            'tiket_id',
            'total',
            'tanggal_pembelian',
            'Seat'
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {
            $keranjang = Keranjang::create([
                'harga_tiket_id' => $request->harga_tiket_id,
                'harga' => $request->harga,
                'tiket_id' => $request->tiket_id,
                'total' => $request->total,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'Seat' => $request->Seat,
            ]);

            if ($keranjang) {

                return response()->json([
                    'status' => 200,
                    'message' => $keranjang
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
        $keranjang = Keranjang::find($id);
        if ($keranjang) {

            return response()->json([
                'status' => 200,
                'message' => $keranjang
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Keranjang Found!"
            ], 404);
        }
    }

    public function edit($id)
    {
        $keranjang = Keranjang::find($id);
        if ($keranjang) {

            return response()->json([
                'status' => 200,
                'message' => $keranjang
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Keranjang Found!"
            ], 404);
        }
    }
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id',
            'harga_tiket_id',
            'harga',
            'tiket_id',
            'total',
            'tanggal_pembelian',
            'Seat'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $keranjang = Keranjang::find($id);
            if ($keranjang) {

                $keranjang->update([
                    'id' => $request->id,
                    'harga_tiket_id' => $request->harga_tiket_id,
                    'harga' => $request->harga,
                    'tiket_id' => $request->tiket_id,
                    'total' => $request->total,
                    'tanggal_pembelian' => $request->tanggal_pembelian,
                    'Seat' => $request->Seat,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $keranjang
                ], 200);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => "No Such Keranjang Found!"
                ], 404);
            }
        }
    }
    public function destory($id)
    {
        $keranjang = Keranjang::find($id);
        if ($keranjang) {

            $keranjang->delete();
            return response()->json([
                'status' => 200,
                'message' => "Keranjang Deleted Succesfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Keranjang Found!"
            ], 404);
        }
    }
}
