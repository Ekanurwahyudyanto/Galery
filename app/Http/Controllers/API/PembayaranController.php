<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    public function index()
    {
        // $pembayarans =Pembayaran::all();
        $pembayarans = Pembayaran::with('tiket.tuan_rumah','tiket.penantang','harga_tiket','keranjang')->get();
        if ($pembayarans->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $pembayarans
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
            'harga_tiket_id',
            'keranjang_id',
            'tanggal_pembelian',
            'stadiun'
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $pembayarans = Pembayaran::create([
                'id' => $request->id,
                'tiket_id' => $request->tiket_id,
                'harga_tiket_id' => $request->harga_tiket_id,
                'keranjang_id' => $request->keranjang_id,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'stadiun' => $request->stadiun,
            ]);

            if ($pembayarans) {

                return response()->json([
                    'status' => 200,
                    'message' => $pembayarans
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
        $pembayarans = Pembayaran::find($id);
        if ($pembayarans) {

            return response()->json([
                'status' => 200,
                'message' => $pembayarans
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
        $pembayarans = Pembayaran::find($id);
        if ($pembayarans) {

            return response()->json([
                'status' => 200,
                'message' => $pembayarans
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
            'tuan_rumah_id',
            'penantang',
            'tanggal_pembelian',
            'stadiun'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $pembayarans = Pembayaran::find($id);
            if ($pembayarans) {

                $pembayarans->update([
                    'id' => $request->id,
                    'tuan_rumah_id' => $request->tuan_rumah_id,
                    'penantang' => $request->penantang,
                    'tanggal_pembelian' => $request->tanggal_pembelian,
                    'stadiun' => $request->stadiun,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $pembayarans
                ], 200);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => "No Such Pembayaran Found!"
                ], 404);
            }
        }
    }
    public function destory($id)
    {
        $pembayarans = Pembayaran::find($id);
        if ($pembayarans) {

            $pembayarans->delete();
            return response()->json([
                'status' => 200,
                'message' => "Pembayaran Deleted Succesfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Pembayaran Found!"
            ], 404);
        }
    }
}