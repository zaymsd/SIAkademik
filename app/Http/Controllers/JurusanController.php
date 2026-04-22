<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $jurusans = Jurusan::when($search, function ($query, $search) {
            return $query->where('nama_jurusan', 'like', "%{$search}%")
                         ->orWhere('akreditasi', 'like', "%{$search}%");
        })->paginate(10)->withQueryString();

        return view('jurusan.index', compact('jurusans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:100|unique:jurusans,nama_jurusan',
            'akreditasi'   => 'required|in:A,B,C',
        ], [
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'nama_jurusan.unique'   => 'Nama jurusan sudah terdaftar.',
            'akreditasi.required'   => 'Akreditasi wajib dipilih.',
            'akreditasi.in'         => 'Akreditasi harus A, B, atau C.',
        ]);

        Jurusan::create($request->only('nama_jurusan', 'akreditasi'));

        return redirect()->route('jurusan.index')
                         ->with('success', 'Data jurusan berhasil ditambahkan.');
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
        $jurusan = Jurusan::findOrFail($id);

        return view('jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $request->validate([
            'nama_jurusan' => 'required|string|max:100|unique:jurusans,nama_jurusan,' . $jurusan->id_jurusan . ',id_jurusan',
            'akreditasi'   => 'required|in:A,B,C',
        ], [
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'nama_jurusan.unique'   => 'Nama jurusan sudah terdaftar.',
            'akreditasi.required'   => 'Akreditasi wajib dipilih.',
            'akreditasi.in'         => 'Akreditasi harus A, B, atau C.',
        ]);

        $jurusan->update($request->only('nama_jurusan', 'akreditasi'));

        return redirect()->route('jurusan.index')
                         ->with('success', 'Data jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')
                         ->with('success', 'Data jurusan berhasil dihapus.');
    }
}
