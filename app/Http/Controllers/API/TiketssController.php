<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tiketss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TiketssController extends Controller
{
    public function index()
    {
        //$tikets = Tikets::all();
        $tikets = Tiketss::with('tuan_rumah','penantang')->get();
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
            'stadiun',
            'tanggal'
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $tikets = Tiketss::create([
                'id' => $request->id,
                'tuan_rumah_id' => $request->tuan_rumah_id,
                'penantang_id' => $request->penantang_id,
                'stadiun' => $request->stadiun,
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
        $tikets = Tiketss::find($id);
        if ($tikets) {

            return response()->json([
                'status' => 200,
                'message' => $tikets
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Tikets Found!"
            ], 404);
        }
    }

    public function edit($id)
    {
        $tikets = Tiketss::find($id);
        if ($tikets) {

            return response()->json([
                'status' => 200,
                'message' => $tikets
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => "No Such Tikets Found!"
            ], 404);
        }
    }
    public function update(int $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id',
            'tuan_rumah_id',
            'penantang_id',
            'stadiun',
            'tanggal'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $tikets = Tiketss::find($id);
            if ($tikets) {

                $tikets->update([
                    'id' => $request->id,
                    'tuan_rumah_id' => $request->tuan_rumah_id,
                    'penantang_id' => $request->penantang_id,
                    'stadiun' => $request->stadiun,
                    'tanggal' => $request->tanggal
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $tikets
                ], 200);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => "No Such Tikets Found!"
                ], 404);
            }
        }
    }
    public function destory($id)
    {
        $tikets = Tiketss::find($id);
        if ($tikets) {

            $tikets->delete();
            return response()->json([
                'status' => 200,
                'message' => "Tikets Deleted Succesfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Tikets Found!"
            ], 404);
        }
    }

    public function search(Request $request)
    {
        $tikets = Tiketss::all();

        $tikets = Tiketss::all('first_name', 'like', "%{$tikets}%")
                ->orWhere('last_name', 'like', "%{$tikets}%")
                ->get();

        return response()->json([
            'tiket' => $tikets->all()
        ]);
    }
}
