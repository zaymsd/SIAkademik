<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaApi extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();
        if ($mahasiswa) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Data mahasiswa berhasil diambil',
                'result' => $mahasiswa
                            ],200);
        }
        return response()->json([
            'status' => 404,
            'success' => false,
            'message' => 'Data mahasiswa tidak ditemukan',
        ],404);
    }

    public function show($nim)
    {
        $mahasiswa = Mahasiswa::with('jurusan')->find($nim);
        if ($mahasiswa) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Data mahasiswa berhasil diambil',
                'result' => $mahasiswa
                            ],200);
        }
        return response()->json([
            'status' => 404,
            'success' => false,
            'message' => 'Data mahasiswa tidak ditemukan',
        ],404);
    }
    
    //tambah data
    public function store(Request $request)
    {
            $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan',
            'result' => $mahasiswa
                        ],201);
    }

    //edit data
    public function update(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::find($nim);
        
        if (!$mahasiswa) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ],404);
        }
        $mahasiswa->update($request->all());
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil diupdate',
            'result' => $mahasiswa
                        ],200);
    }

    //delete data
    public function destroy($nim)
    {
        $mahasiswa = Mahasiswa::find($nim);
        if (!$mahasiswa) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ],404);
        }
        $mahasiswa->delete();
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil dihapus',
                        ],200);
    }
}
