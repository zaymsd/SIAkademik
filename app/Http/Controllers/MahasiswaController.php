<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mahasiswas = Mahasiswa::with('jurusan')
            ->when($search, function ($query, $search) {
                return $query->where('nim', 'like', "%{$search}%")
                             ->orWhere('nama', 'like', "%{$search}%");
            })->paginate(10)->withQueryString();

        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::all();

        return view('mahasiswa.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim'        => 'required|string|max:20|unique:mahasiswas,nim',
            'nama'       => 'required|string|max:100',
            'id_jurusan' => 'required|exists:jurusans,id_jurusan',
        ], [
            'nim.required'        => 'NIM wajib diisi.',
            'nim.unique'          => 'NIM sudah terdaftar.',
            'nama.required'       => 'Nama mahasiswa wajib diisi.',
            'id_jurusan.required' => 'Jurusan wajib dipilih.',
            'id_jurusan.exists'   => 'Jurusan yang dipilih tidak valid.',
        ]);

        Mahasiswa::create($request->only('nim', 'nama', 'id_jurusan'));

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $jurusans  = Jurusan::all();

        return view('mahasiswa.edit', compact('mahasiswa', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim'        => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswa->id_mahasiswa . ',id_mahasiswa',
            'nama'       => 'required|string|max:100',
            'id_jurusan' => 'required|exists:jurusans,id_jurusan',
        ], [
            'nim.required'        => 'NIM wajib diisi.',
            'nim.unique'          => 'NIM sudah terdaftar.',
            'nama.required'       => 'Nama mahasiswa wajib diisi.',
            'id_jurusan.required' => 'Jurusan wajib dipilih.',
            'id_jurusan.exists'   => 'Jurusan yang dipilih tidak valid.',
        ]);

        $mahasiswa->update($request->only('nim', 'nama', 'id_jurusan'));

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
