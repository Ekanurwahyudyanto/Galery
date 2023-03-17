<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tim_ligas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'id',
            'nama',
            'keterangan',
            'stadion'
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {

            $tim_ligas = Tim_ligas::create([
                'id' => $request->id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
                'stadion' => $request->stadion,
            ]);

            if ($tim_ligas) {

                return response()->json([
                    'status' => 200,
                    'message' => $tim_ligas
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
            'keterangan',
            'stadion'
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
                    'keterangan' => $request->keterangan,
                    'stadion' => $request->tanggal,
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
