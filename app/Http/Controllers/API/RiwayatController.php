<?php

namespace App\Http\Controllers\API;

use App\Models\riwayat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RiwayatController extends Controller
{
    public function index()
    {
        //$riwayats = riwayat::all();
        $riwayats = riwayat::with('tiket.tuan_rumah','tiket.penantang')->get();
        if ($riwayats->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $riwayats
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
            'seat',
            'pembayaran'
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $riwayats = riwayat::create([
                'id' => $request->id,
                'tiket_id' => $request->tiket_id,
                'seat' => $request->seat,
                'pembayaran' => $request->pembayaran,
            ]);

            if ($riwayats) {

                return response()->json([
                    'status' => 200,
                    'message' => $riwayats
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
        $riwayats = riwayat::find($id);
        if ($riwayats) {

            return response()->json([
                'status' => 200,
                'message' => $riwayats
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such riwayats Found!"
            ], 404);
        }
    }

    public function edit($id)
    {
        $riwayats = riwayat::find($id);
        if ($riwayats) {

            return response()->json([
                'status' => 200,
                'message' => $riwayats
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such riwayats Found!"
            ], 404);
        }
    }
    public function update(int $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id',
            'tiket_id',
            'seat',
            'pembayaran'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $riwayats = riwayat::find($id);
            if ($riwayats) {

                $riwayats->update([
                    'id' => $request->id,
                    'tiket_id' => $request->tiket_id,
                    'seat' => $request->seat,
                    'pembayaran' => $request->pembayaran
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $riwayats
                ], 200);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => "No Such riwayats Found!"
                ], 404);
            }
        }
    }
    public function destory($id)
    {
        $riwayats = riwayat::find($id);
        if ($riwayats) {

            $riwayats->delete();
            return response()->json([
                'status' => 200,
                'message' => "riwayats Deleted Succesfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such riwayats Found!"
            ], 404);
        }
    }

    public function search(Request $request)
    {
        $riwayats = riwayat::all();

        $riwayats = riwayat::all('first_name', 'like', "%{$riwayats}%")
                ->orWhere('last_name', 'like', "%{$riwayats}%")
                ->get();

        return response()->json([
            'riwayats' => $riwayats->all()
        ]);
    }
}
