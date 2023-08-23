<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturPembayaran;
use Illuminate\Support\Facades\Validator;

class StrukturPembayaranController extends Controller
{
    public function index()
    {
        // $strukturpembayarans =Pembayaran::all();
        $strukturpembayarans = StrukturPembayaran::with('tiket.tuan_rumah', 'tiket.penantang', 'harga_tiket', 'keranjang')->get();
        if ($strukturpembayarans->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $strukturpembayarans
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
            'nomor_transaksi',
            'tiket_id',
            'harga_tiket_id',
            'keranjang_id',
            'tanggal',
            'pembayaran',
            'nomor_virtual_account'
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $strukturpembayarans = StrukturPembayaran::create([
                'id' => $request->id,
                'nomor_transaksi' => $request->nomor_transaksi,
                'tiket_id' => $request->tiket_id,
                'harga_tiket_id' => $request->harga_tiket_id,
                'keranjang_id' => $request->keranjang_id,
                'tanggal' => $request->tanggal,
                'pembayaran' => $request->pembayaran,
                'nomor_virtual_account' => $request->nomor_virtual_account
            ]);

            if ($strukturpembayarans) {

                return response()->json([
                    'status' => 200,
                    'message' => $strukturpembayarans
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
        $strukturpembayarans = StrukturPembayaran::with('tiket.tuan_rumah','tiket.penantang','harga_tiket','keranjang')->where('id', $id)->first();
        if ($strukturpembayarans->count() > 0){

            return response()->json([
                'status' => 200,
                'message' => $strukturpembayarans
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Tim_Persik Found!"
            ], 404);
        }
    }

    public function destory($id)
    {
        $strukturpembayarans = StrukturPembayaran::find($id);
        if ($strukturpembayarans) {

            $strukturpembayarans->delete();
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