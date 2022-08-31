<?php

namespace App\Http\Controllers;

use App\Models\keuangan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('id', 'DESC')->paginate(1);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'alamat'   => 'required',
            'kontak'   => 'required',
            'email'   => 'required',
        ],
            [
                'name.required' => 'Masukkan name !',
                'alamat.required' => 'Masukkan alamat !',
                'kontak.required' => 'Masukkan kontak !',
                'email.required' => 'Masukkan email !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'gagal',
                'data'    => $validator->errors()
            ],401);

        } else {
            $user = new User(); 
            $name = $request->name;
            $alamat = $request->alamat;
            $kontak = $request->kontak;
            $email = $request->email;
            
    
            $user = User::find($id);
            
            $user->name = $name;
            $user->alamat = $alamat;
            $user->kontak = $kontak;
            $user->email = $email;
            $user->save();  
            $valid = $user;
            if ($valid) {
                return response()->json([
                    'success' => true,
                    $id,
                    'message' => 'sukses',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    $id,
                    'message' => 'gagal',
                ], 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
