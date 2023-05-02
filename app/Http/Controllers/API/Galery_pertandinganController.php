<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\galery_pertandingans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Galery_pertandinganController extends Controller
{
    public function index(Request $request)
    {
      //$galerys = galery_pertandingan::all();
        $galerys = galery_pertandingans::with('tiket.tuan_rumah','tiket.penantang')->get();
        if($galerys->count()>0){
            
            return response()->json([
                'status' =>200,
                'galerys' =>$galerys
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
            'tiket_id'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' =>422,
                'message' =>$validator->message()
            ],422);
        }else{
            $galerys = galery_pertandingans::create([
                'id'=>$request->id,
                'tiket_id'=>$request->tiket_id
            ]);

        if($galerys){

            return response()->json([
                'id'=>$request->id,
                'tiket_id'=>$request->tiket_id,
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
        $galerys = galery_pertandingans::find($id);
        if($galerys){

            return response()->json([
                'status' => 200,
                'galerys' => $galerys
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Such Galerys Found!"
            ],404);
        }
    }

    public function edit($id)
    {
        $galerys = galery_pertandingans::with('tikets')->first();
        if($galerys){

            return response()->json([
                'status' => 200,
                'galerys' => $galerys
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "No Such Galerys Found!"
            ],404);
    }
}

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'id',
            'tiket_id'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' =>422,
                'message' =>$validator->message()
            ],422);
        }else{

        $galerys = galery_pertandingans::find($id);        
        if($galerys){

            $galerys->update([
                'id'=>$request->id,
                'tiket_id'=>$request->tiket_id,
            ]);

            return response()->json([
                'id'=>$request->id,
                'tiket_id'=>$request->tiket_id,
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
        $galerys = galery_pertandingans::find($id);
        if($galerys){
            
            $galerys->delete();
            return response()->json([
                'status' =>200,
                'message' =>"Delete Successfully"
            ],200);
            
        }else{
            return response()->json([
                'status' =>404,
                'message' =>"No Such Galerys  Found!"
            ],404);
        }
    }

    public function list($id) {
        $galerys = galery_pertandingans::where('id', 'LIKE', '%'. $id. '%')->get();
        if(count($galerys)){
            return Response()->json($galerys);
        }
        else
        {
        return response()->json(['galerys' => 'No Data not found'], 404);
        }
    }

}