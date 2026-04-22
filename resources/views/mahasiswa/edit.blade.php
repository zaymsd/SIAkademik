@extends('layouts.app')

@section('title', 'Edit Mahasiswa')
@section('page-title', 'Edit Mahasiswa')

@section('content')

    {{-- Page Header --}}
    <div class="form-page-header">
        <div>
            <h4 class="page-header" style="margin-bottom:0.2rem;">
                <i class="bi bi-person-gear me-2" style="color:#1a237e;"></i>Edit Mahasiswa
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none">Mahasiswa</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="form-page-main">
        <div class="form-page-header-bar">
            <h6 class="form-page-title">
                <i class="bi bi-people text-primary"></i> Form Edit Mahasiswa
            </h6>
            <span class="badge bg-primary font-monospace">{{ $mahasiswa->nim }}</span>
        </div>

        <div class="form-page-body">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST" id="form-edit-mahasiswa">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- ── Kolom Kiri: Fields Utama ── --}}
                    <div class="col-lg-8">

                        {{-- NIM --}}
                        <div class="mb-4">
                            <label for="nim" class="form-label">
                                NIM <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   id="nim"
                                   name="nim"
                                   class="form-control font-monospace @error('nim') is-invalid @enderror"
                                   placeholder="Contoh: 10124001"
                                   value="{{ old('nim', $mahasiswa->nim) }}"
                                   maxlength="20"
                                   autofocus>
                            @error('nim')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label for="nama" class="form-label">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   id="nama"
                                   name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   placeholder="Contoh: Budi Santoso"
                                   value="{{ old('nama', $mahasiswa->nama) }}"
                                   maxlength="100">
                            @error('nama')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Jurusan --}}
                        <div class="mb-4">
                            <label for="id_jurusan" class="form-label">
                                Jurusan <span class="text-danger">*</span>
                            </label>
                            <select id="id_jurusan"
                                    name="id_jurusan"
                                    class="form-select @error('id_jurusan') is-invalid @enderror"
                                    style="max-width: 400px;">
                                <option value="" disabled>— Pilih Jurusan —</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id_jurusan }}"
                                        {{ old('id_jurusan', $mahasiswa->id_jurusan) == $jurusan->id_jurusan ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                        (Akreditasi {{ $jurusan->akreditasi }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jurusan')
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
                                    data-confirm-form="form-edit-mahasiswa"
                                    data-confirm-title="Update Mahasiswa"
                                    data-confirm-message="Simpan perubahan data mahasiswa?"
                                    data-subject-field="nama">
                                <i class="bi bi-save-fill me-2"></i>Update
                            </button>
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary px-4">
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
                                <span>ID: <strong>{{ $mahasiswa->id_mahasiswa }}</strong></span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-person-badge"></i>
                                <span>NIM: <strong class="font-monospace">{{ $mahasiswa->nim }}</strong></span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-calendar3"></i>
                                <span>Dibuat: {{ $mahasiswa->created_at?->format('d M Y') ?? '—' }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-pencil"></i>
                                <span>Diubah: {{ $mahasiswa->updated_at?->format('d M Y') ?? '—' }}</span>
                            </div>
                            <hr style="border-color: #c5cae9; margin: 0.75rem 0;">
                            <div class="info-title mt-2">
                                <i class="bi bi-info-circle-fill"></i> Petunjuk
                            </div>
                            <div class="info-item">
                                <i class="bi bi-check2-circle"></i>
                                <span>NIM harus unik dan tidak boleh sama dengan mahasiswa lain.</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-check2-circle"></i>
                                <span>Perubahan jurusan akan langsung mempengaruhi relasi data.</span>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
