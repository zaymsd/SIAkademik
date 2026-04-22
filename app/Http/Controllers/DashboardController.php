<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan statistik ringkasan.
     */
    public function index()
    {
        $totalJurusan    = Jurusan::count();
        $totalMahasiswa  = Mahasiswa::count();
        $totalMatakuliah = Matakuliah::count();

        // 5 mahasiswa terbaru beserta relasi jurusan
        $mahasiswaTerbaru = Mahasiswa::with('jurusan')
            ->latest('id_mahasiswa')
            ->take(5)
            ->get();

        // Distribusi mahasiswa per jurusan
        $distribusiJurusan = Jurusan::withCount('mahasiswas')
            ->orderByDesc('mahasiswas_count')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalJurusan',
            'totalMahasiswa',
            'totalMatakuliah',
            'mahasiswaTerbaru',
            'distribusiJurusan'
        ));
    }
}
