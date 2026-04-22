@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Page Header --}}
    <div class="page-header">
        <h4><i class="bi bi-grid-1x2-fill me-2" style="color:#1a237e;"></i>Dashboard</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Beranda</li>
            </ol>
        </nav>
    </div>

    {{-- ── STAT CARDS ── --}}
    <div class="row g-3 mb-4">

        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('jurusan.index') }}" class="stat-card">
                <div class="stat-icon indigo">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-label">Total Jurusan</div>
                    <div class="stat-value">{{ $totalJurusan }}</div>
                    <div class="stat-sub">Program studi terdaftar</div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('mahasiswa.index') }}" class="stat-card">
                <div class="stat-icon teal">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-label">Total Mahasiswa</div>
                    <div class="stat-value">{{ $totalMahasiswa }}</div>
                    <div class="stat-sub">Mahasiswa aktif terdaftar</div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-4">
            <a href="{{ route('matakuliah.index') }}" class="stat-card">
                <div class="stat-icon orange">
                    <i class="bi bi-book-fill"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-label">Total Mata Kuliah</div>
                    <div class="stat-value">{{ $totalMatakuliah }}</div>
                    <div class="stat-sub">Mata kuliah tersedia</div>
                </div>
            </a>
        </div>

    </div>

    {{-- ── KONTEN BAWAH ── --}}
    <div class="row g-3">

        {{-- Mahasiswa Terbaru --}}
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h6 class="card-title">
                        <i class="bi bi-clock-history me-2 text-primary"></i>Mahasiswa Terbaru
                    </h6>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mahasiswaTerbaru as $mhs)
                                <tr>
                                    <td class="font-monospace text-muted" style="font-size:0.82rem;">
                                        {{ $mhs->nim }}
                                    </td>
                                    <td class="fw-500">{{ $mhs->nama }}</td>
                                    <td>
                                        @if ($mhs->jurusan)
                                            <span class="badge" style="background:#e8eaf6; color:#3949ab; font-weight:500;">
                                                {{ $mhs->jurusan->nama_jurusan }}
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        Belum ada data mahasiswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Distribusi Mahasiswa per Jurusan --}}
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="card-title">
                        <i class="bi bi-bar-chart-fill me-2 text-primary"></i>Mahasiswa per Jurusan
                    </h6>
                </div>
                <div class="card-body" style="padding: 1.25rem;">
                    @forelse ($distribusiJurusan as $jurusan)
                        @php
                            $persen = $totalMahasiswa > 0
                                ? round(($jurusan->mahasiswas_count / $totalMahasiswa) * 100)
                                : 0;
                        @endphp
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span style="font-size:0.82rem; font-weight:500; color:#343a40;">
                                    {{ $jurusan->nama_jurusan }}
                                </span>
                                <span style="font-size:0.8rem; color:#6c757d;">
                                    {{ $jurusan->mahasiswas_count }} mhs
                                </span>
                            </div>
                            <div class="progress" style="height: 7px; border-radius: 10px; background:#e8eaf6;">
                                <div class="progress-bar"
                                     role="progressbar"
                                     style="width: {{ $persen }}%; background: linear-gradient(90deg, #1a237e, #5c6bc0); border-radius: 10px;"
                                     aria-valuenow="{{ $persen }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                            Belum ada data jurusan.
                        </div>
                    @endforelse
                </div>

                {{-- Quick Actions --}}
                <div class="card-footer bg-white border-top py-3 px-3">
                    <p class="dashboard-section-title mb-2" style="font-size:0.8rem;">
                        <i class="bi bi-lightning-charge-fill text-warning"></i> Aksi Cepat
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('jurusan.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-plus-lg me-1"></i>Jurusan
                        </a>
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-plus-lg me-1"></i>Mahasiswa
                        </a>
                        <a href="{{ route('matakuliah.create') }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-plus-lg me-1"></i>Mata Kuliah
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
