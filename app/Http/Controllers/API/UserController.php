<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request){

            $request->validate([
                'email' => ['required','email'],
                'password' => ['required']
            ]);
    
            $credentials = request(['email','password']);
    
            if(!Auth::attempt($credentials)){
                return $this->sendError('Akun yang anda masukan salah/belum terdaftar', 0);
            }
    
            $user = User::where('email', $request->email)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new \Exception('Invalid Credentials');
            }
    
            //jika berhasil maka login
            $tokenResult = $user->createToken('authToken')->plainTextToken;
    
            return $this->sendResponse([
                'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user' => $user
            ], 'Authenticated');
        
    }
    public function store(Request $request){ //register

        try{
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required','string','email','max:50','unique:users'],
                'password' => ['required','min:6']
            ]);
            
            $validator = validator::make($request->all(),[
                'name'=>'required|min:2|max:100',
                'email'=>'required|email|uniqe:users',
                'password'=>'required|same:password'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]); //insert data
    
            $user = User::where('email', $request->email)->first();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            
            $data = [
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ];
    
            return $this->sendResponse($data, 'Successfull Register');
        } 
        catch(Exception $error){
            return $this->sendError(
                [
                    'message' => 'Something went wrong',
                    'error' => $error
                ],
                'Registration Failed'
            );
        }

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ],422);
            
        }
        
    }

    public function show(User $user){
        try{
            $user = Auth::user($user);

            return $this->sendResponse($user, 'Succesfull fet user');
        }catch(Exception $error){
            return $this->sendError(
                [
                    'message' => 'Something went wrong',
                    'error' => $error
                ],
                'Get User Failed'
            );
        }
    }
    public function logout(){
        $user = User::find(Auth::user()->id);

        $user->tokens()->delete();

        return response()->noContent();
    }

    public function update(Request $request, User $user){ 
        $validator = validator::make($request->all(),[
            'old_password'=>'required',
            'password'=>'required|min:6|max:100',
            'confirm_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ],422);
        }

        // $user = auth()->user();
        $user = Auth::user($user);
        
        if(Hash::check($request->old_password,$user->password)){
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
            return response()->json([
                'message'=>'Password Successfully update',
            ],200);

        }else{
            return response()->json([
                'message'=>'Old password does not matched',
            ],400);
        }

    }

    public function list($name) {
        $user = User::where('name', 'LIKE', '%'. $name. '%')->get();
        if(count($user)){
            return Response()->json($user);
        }
        else
        {
        return response()->json(['user' => 'No Data not found'], 404);
        }
    }

    public function index(Request $request){

        $request->validate([
            'name' => ['required'],
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        $credentials = request(['name','email','password']);

        if(!Auth::attempt($credentials)){
            return $this->sendError('Akun yang anda masukan salah/belum terdaftar', 0);
        }

        $user = User::where('name', $request->name)->first();
        $user = User::where('email', $request->email)->first();
        if(!Hash::check($request->password, $user->password, [])){
            throw new \Exception('Invalid Credentials');
        }

        //jika berhasil maka login
        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return $this->sendResponse([
            'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
        ], 'Authenticated');
    
}
public function tambah(Request $request){ //register

    try{
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required','string','email','max:50','unique:users'],
            'password' => ['required','min:6']
        ]);
        
        $validator = validator::make($request->all(),[
            'name'=>'required|min:2|max:100',
            'email'=>'required|email|uniqe:users',
            'password'=>'required|same:password'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]); //insert data

        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        
        $data = [
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user
        ];

        return $this->sendResponse($data, 'Successfull Register');
    } 
    catch(Exception $error){
        return $this->sendError(
            [
                'message' => 'Something went wrong',
                'error' => $error
            ],
            'Registration Failed'
        );
    }

    if ($validator->fails()) {
        return response()->json([
            'message'=>'Validations fails',
            'errors'=>$validator->errors()
        ],422);
        
    }
    
}

public function showw(User $user){
    try{
        $user = Auth::user($user);

        return $this->sendResponse($user, 'Succesfull fet user');
    }catch(Exception $error){
        return $this->sendError(
            [
                'message' => 'Something went wrong',
                'error' => $error
            ],
            'Get User Failed'
        );
    }
}

public function logouut(){
    $user = User::find(Auth::user()->id);

    $user->tokens()->delete();

    return response()->noContent();
}

public function updatee(Request $request, User $user){ 
    $validator = validator::make($request->all(),[
        'password_lama'=>'required',
        'password'=>'required|min:6|max:100',
        'confirmasi_password' => 'required|same:password'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'message'=>'Validations fails',
            'errors'=>$validator->errors()
        ],422);
    }

    // $user = auth()->user();
    $user = Auth::user($user);
    
    if(Hash::check($request->password_lama,$user->password)){
        $user->update([
            'password'=>Hash::make($request->password)
        ]);
        return response()->json([
            'message'=>'Password Successfully update',
        ],200);

    }else{
        return response()->json([
            'message'=>'password lama does not matched',
        ],400);
    }

}

public function lisst($name) {
    $user = User::where('name', 'LIKE', '%'. $name. '%')->get();
    if(count($user)){
        return Response()->json($user);
    }
    else
    {
    return response()->json(['user' => 'No Data not found'], 404);
    }
}
    
}
