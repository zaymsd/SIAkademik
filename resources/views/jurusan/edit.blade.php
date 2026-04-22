@extends('layouts.app')

@section('title', 'Edit Jurusan')
@section('page-title', 'Edit Jurusan')

@section('content')

    {{-- Page Header --}}
    <div class="form-page-header">
        <div>
            <h4 class="page-header" style="margin-bottom:0.2rem;">
                <i class="bi bi-pencil-square me-2" style="color:#1a237e;"></i>Edit Jurusan
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('jurusan.index') }}" class="text-decoration-none">Jurusan</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="form-page-main">
        <div class="form-page-header-bar">
            <h6 class="form-page-title">
                <i class="bi bi-diagram-3 text-primary"></i> Form Edit Jurusan
            </h6>
            <span class="badge bg-secondary">ID: {{ $jurusan->id_jurusan }}</span>
        </div>

        <div class="form-page-body">
            <form action="{{ route('jurusan.update', $jurusan->id_jurusan) }}" method="POST" id="form-edit-jurusan">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- ── Kolom Kiri: Fields Utama ── --}}
                    <div class="col-lg-8">

                        {{-- Nama Jurusan --}}
                        <div class="mb-4">
                            <label for="nama_jurusan" class="form-label">
                                Nama Jurusan <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   id="nama_jurusan"
                                   name="nama_jurusan"
                                   class="form-control @error('nama_jurusan') is-invalid @enderror"
                                   placeholder="Contoh: Teknik Informatika"
                                   value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                                   maxlength="100"
                                   autofocus>
                            @error('nama_jurusan')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Akreditasi --}}
                        <div class="mb-4">
                            <label for="akreditasi" class="form-label">
                                Akreditasi <span class="text-danger">*</span>
                            </label>
                            <select id="akreditasi"
                                    name="akreditasi"
                                    class="form-select @error('akreditasi') is-invalid @enderror"
                                    style="max-width: 300px;">
                                <option value="" disabled>— Pilih Akreditasi —</option>
                                <option value="A" {{ old('akreditasi', $jurusan->akreditasi) == 'A' ? 'selected' : '' }}>A (Unggul)</option>
                                <option value="B" {{ old('akreditasi', $jurusan->akreditasi) == 'B' ? 'selected' : '' }}>B (Baik Sekali)</option>
                                <option value="C" {{ old('akreditasi', $jurusan->akreditasi) == 'C' ? 'selected' : '' }}>C (Baik)</option>
                            </select>
                            @error('akreditasi')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="form-divider">

                        {{-- Action Buttons --}}
                        <div class="form-actions">
                            <button type="button"
                                    class="btn btn-primary px-4"
                                    data-confirm-form="form-edit-jurusan"
                                    data-confirm-title="Update Jurusan"
                                    data-confirm-message="Simpan perubahan data jurusan?"
                                    data-subject-field="nama_jurusan">
                                <i class="bi bi-save-fill me-2"></i>Update
                            </button>
                            <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-x-lg me-2"></i>Batal
                            </a>
                        </div>
                    </div>

                    {{-- ── Kolom Kanan: Info Panel ── --}}
                    <div class="col-lg-4">
                        <div class="form-info-panel">
                            <div class="info-title">
                                <i class="bi bi-card-text"></i> Info Record
                            </div>
                            <div class="info-item">
                                <i class="bi bi-hash"></i>
                                <span>ID: <strong>{{ $jurusan->id_jurusan }}</strong></span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-calendar3"></i>
                                <span>Dibuat: {{ $jurusan->created_at?->format('d M Y') ?? '—' }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-pencil"></i>
                                <span>Diubah: {{ $jurusan->updated_at?->format('d M Y') ?? '—' }}</span>
                            </div>
                            <hr style="border-color: #c5cae9; margin: 0.75rem 0;">
                            <div class="info-title mt-2">
                                <i class="bi bi-info-circle-fill"></i> Petunjuk
                            </div>
                            <div class="info-item">
                                <i class="bi bi-check2-circle"></i>
                                <span>Nama jurusan harus unik dan belum digunakan jurusan lain.</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-check2-circle"></i>
                                <span>Perubahan akreditasi akan mempengaruhi tampilan di daftar mahasiswa.</span>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
