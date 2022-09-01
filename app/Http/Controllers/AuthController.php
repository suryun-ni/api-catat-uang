<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['status' => 'fail' ,'message' => 'Login gagal'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['status' => 'ture','message' => 'Login Berhasil '.$user->name.', Selamat Datang','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function getProfile(Request $request) {
        $user = auth()->user();
        $response = [
            'message' => 'Data User',
            'data' => $user,
        ];
        if ($user) {
            return response()->json([
                'success' => true,
                $response,
                'message' => 'data ditampilkan',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data kosong',
            ], 401);
        }
        
        
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Berhasil Log Out'
        ];
    }
}
