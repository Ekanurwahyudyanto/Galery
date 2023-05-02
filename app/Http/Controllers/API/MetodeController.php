<?php

namespace App\Http\Controllers\API;

use App\Models\metode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\validate;
use Illuminate\Support\Str;

class MetodeController extends Controller
{
    public function index()
    {
        // $metodes =metode::all();
        $metodes = metode::with('tiket.tuan_rumah','tiket.penantang','keranjang')->get();
        if ($metodes->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => $metodes
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
        $metodes = new metode();
        $request->validate([
            'tiket_id' => 'required',
            'keranjang_id' => 'required',
            'logo1' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'logo2' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'logo3' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'logo4' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $filename = "";
        if ($request->hasFile('image')) {
            $md5Name = md5_file($request->file('image')->getRealPath());
            $guessExtension = $request->file('image')->guessExtension();
            $filename = Str::uuid()->toString().".".$guessExtension;
            $fullpath = $request->file('image')->storeAs('public/img', $filename);
        } else {
            $filename = Null;
        }

            $metodes->id = $request->id;
            $metodes->tiket_id = $request->tiket_id;
            $metodes->keranjang_id = $request->keranjang_id;
            $metodes->logo1 = "storage/img/".$filename;
            $metodes->logo2 = "storage/img/".$filename;
            $metodes->logo3 = "storage/img/".$filename;
            $metodes->logo4 = "storage/img/".$filename;
            $result = $metodes->save();

            if ($result) {

                return response()->json([
                    'status' => 422,
                    'message' => $metodes
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
        $metodes = metode::find($id);
        if ($metodes) {

            return response()->json([
                'status' => 200,
                'message' => $metodes
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
        $metodes = metode::find($id);
        if ($metodes) {

            return response()->json([
                'status' => 200,
                'message' => $metodes
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
            'tiket_id',
            'keranjang_id',
            'logo1',
            'logo2',
            'logo3',
            'logo4'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $metodes = metode::find($id);
            if ($metodes) {

                $metodes->update([
                    'id' => $request->id,
                    'tiket_id' => $request->tiket_id,
                    'keranjang_id' => $request->keranjang_id,
                    'logo1' => $request->logo1,
                    'logo2' => $request->logo2,
                    'logo3' => $request->logo3,
                    'logo4' => $request->logo4
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => $metodes
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
        $metodes = metode::find($id);
        if ($metodes) {

            $metodes->delete();
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
