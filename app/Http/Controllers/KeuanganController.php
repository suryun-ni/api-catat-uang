<?php

namespace App\Http\Controllers;

use App\Models\keuangan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

            //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            //validate data
            $validator = Validator::make($request->all(), [
                'id_user'     => 'required',
                'uang_masuk'   => 'required',
                'uang_keluar'     => 'required',
            ],
                [
                    'id_user.required' => 'Masukkan id_user Post !',
                    'uang_masuk.required' => 'Masukkan uang_masuk Post !',
                    'uang_keluar.required' => 'Masukkan uang_keluar Post !',
                    ]
            );
    
            if($validator->fails()) {
    
                return response()->json([
                    'success' => false,
                    'message' => 'Silahkan Isi Bidang Yang Kosong',
                    'data'    => $validator->errors()
                ],401);
    
            } else {
    
                $post = keuangan::create([
                    'id_user'     => $request->input('id_user'),
                    'uang_masuk'   => $request->input('uang_masuk'),
                    'uang_keluar'   => $request->input('uang_keluar')
                ]);
    
                if ($post) {         
                    return response()->json([
                        'success' => true,
                        'id'=> $post->id,
                        'message' => 'sukses',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'gagal',
                    ], 401);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_user'     => 'required',
            'uang_masuk'   => 'required',
            'uang_keluar'   => 'required',
        ],
            [
                'id_user.required' => 'Masukkan id_user !',
                'uang_masuk.required' => 'Masukkan uang_masuk !',
                'uang_keluar.required' => 'Masukkan uang_keluar !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'gagal',
                'data'    => $validator->errors()
            ],401);

        } else {
            $keuangan = new keuangan(); 
            $id_user = $request->id_user;
            $uang_masuk = $request->uang_masuk;
            $uang_keluar = $request->uang_keluar;
    
            $keuangan = keuangan::find($id);
            
            $keuangan->id_user = $id_user;
            $keuangan->uang_masuk = $uang_masuk;
            $keuangan->uang_keluar = $uang_keluar;
            $keuangan->save();  
            $valid = $keuangan;
            if ($valid) {
                return response()->json([
                    'success' => true,
                    'id_user'=>$ird_use,
                    'message' => 'sukses',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    $id_user,
                    'message' => 'gagal',
                ], 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(keuangan $keuangan)
    {
        //
    }
}
