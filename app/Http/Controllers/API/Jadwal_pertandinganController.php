<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\jadwal_pertandingans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Jadwal_pertandinganController extends Controller
{
    public function index()
    {
        //$jadwals = jadwal_pertandingans::all();
        $jadwals = jadwal_pertandingans::with('tuan_rumah','penantang')->get();
        if($jadwals->count()>0){
            return response()->json([
                'status' =>200,
                'jadwals' =>$jadwals
            ],200);
        } else {

            return response()->json([
                'status' =>400,
                'message' =>"No records created"
            ],400);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id',
            'tuan_rumah_id',
            'penantang_id',
            'tanggal'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' =>422,
                'message' =>$validator->message()
            ],422);
        }else{
            $jadwals = jadwal_pertandingans::create([
                'id'=>$request->id,
                'tuan_rumah_id'=>$request->tuan_rumah_id,
                'penantang_id'=>$request->penantang_id,
                'tanggal'=>$request->tanggal
            ]);

        if($jadwals){

            return response()->json([
                'status' =>200,
                'message' =>"Successfully Created"
            ],200);
        }else{

            return response()->json([
                'status' =>500,
                'message' =>"Someting Went Created"
            ],500);
        }
    }

    }

    public function show($id)
    {
        $jadwals = jadwal_pertandingans::find($id);
        if($jadwals){

            return response()->json([
                'status' => 200,
                'jadwals' => $jadwals
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Such jadwals Found!"
            ],404);
        }
    }

    public function edit($id)
    {
        $jadwals = jadwal_pertandingans::find($id);
        if($jadwals){

            return response()->json([
                'status' => 200,
                'jadwals' => $jadwals
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Such jadwals Found!"
            ],404);
    }
}

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'id',
            'tuan_rumah_id',
            'penantang_id',
            'tanggal'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' =>422,
                'message' =>$validator->message()
            ],422);
        }else{

        $jadwals = jadwal_pertandingans::find($id);        
        if($jadwals){

            $jadwals->update([
                'id'=>$request->id,
                'tuan_rumah_id'=>$request->tuan_rumah_id,
                'penantang_id'=>$request->penantang_id,
                'tanggal'=>$request->tanggal
            ]);

            return response()->json([
                'id'=>$request->id,
                'tuan_rumah_id'=>$request->tuan_rumah_id,
                'penantang_id'=>$request->penantang_id,
                'tanggal'=>$request->tanggal
            ],200);
        }else{

            return response()->json([
                'status' =>404,
                'message' =>"No Such Galerys  Found!"
            ],404);
        }
    }

    }

    public function destory($id)
    {
        $jadwals = jadwal_pertandingans::find($id);
        if($jadwals){
            
            $jadwals->delete();
            return response()->json([
                'status' =>200,
                'message' =>"Delete Successfully"
            ],200);
            
        }else{
            return response()->json([
                'status' =>404,
                'message' =>"No Such jadwals  Found!"
            ],404);
        }
    }

}