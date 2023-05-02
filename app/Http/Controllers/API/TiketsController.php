<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tikets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TiketsController extends Controller
{
    public function index()
    {
        //$tikets = Tikets::all();
        $tikets = Tikets::with('tuan_rumah','penantang')->get();
        if ($tikets->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $tikets
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
            'tuan_rumah_id',
            'penantang_id',
            'tanggal'
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $tikets = Tikets::create([
                'id' => $request->id,
                'tuan_rumah_id' => $request->tuan_rumah_id,
                'penantang_id' => $request->penantang_id,
                'tanggal' => $request->tanggal

            ]);

            if ($tikets) {

                return response()->json([
                    'status' => 200,
                    'message' => $tikets
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
        $tikets = Tikets::find($id);
        if ($tikets) {

            return response()->json([
                'status' => 200,
                'message' => $tikets
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
        $tikets = Tikets::find($id);
        if ($tikets) {

            return response()->json([
                'status' => 200,
                'message' => $tikets
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Tiket Found!"
            ], 404);
        }
    }
    public function update(int $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id',
            'tuan_rumah_id',
            'penantang_id',
            'tanggal'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $tikets = Tikets::find($id);
            if ($tikets) {

                $tikets->update([
                    'id' => $request->id,
                    'tuan_rumah_id' => $request->tuan_rumah_id,
                    'penantang_id' => $request->penantang_id,
                    'tanggal' => $request->tanggal
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $tikets
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
        $tikets = Tikets::find($id);
        if ($tikets) {

            $tikets->delete();
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

    public function search(Request $request)
    {
        $tikets = Tikets::all();

        $tikets = Tikets::all('first_name', 'like', "%{$tikets}%")
                ->orWhere('last_name', 'like', "%{$tikets}%")
                ->get();

        return response()->json([
            'tiket' => $tikets->all()
        ]);
    }
}
