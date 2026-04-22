@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')
@section('page-title', 'Edit Mata Kuliah')

@section('content')

    {{-- Page Header --}}
    <div class="form-page-header">
        <div>
            <h4 class="page-header" style="margin-bottom:0.2rem;">
                <i class="bi bi-journal-pen me-2" style="color:#1a237e;"></i>Edit Mata Kuliah
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('matakuliah.index') }}" class="text-decoration-none">Mata Kuliah</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="form-page-main">
        <div class="form-page-header-bar">
            <h6 class="form-page-title">
                <i class="bi bi-book text-primary"></i> Form Edit Mata Kuliah
            </h6>
            <span class="badge bg-secondary">ID: {{ $matakuliah->id_matakuliah }}</span>
        </div>

        <div class="form-page-body">
            <form action="{{ route('matakuliah.update', $matakuliah->id_matakuliah) }}" method="POST" id="form-edit-matakuliah">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- ── Kolom Kiri: Fields Utama ── --}}
                    <div class="col-lg-8">

                        {{-- Nama Matakuliah --}}
                        <div class="mb-4">
                            <label for="nama_matakuliah" class="form-label">
                                Nama Mata Kuliah <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   id="nama_matakuliah"
                                   name="nama_matakuliah"
                                   class="form-control @error('nama_matakuliah') is-invalid @enderror"
                                   placeholder="Contoh: Pemrograman Web 2"
                                   value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}"
                                   maxlength="100"
                                   autofocus>
                            @error('nama_matakuliah')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- SKS --}}
                        <div class="mb-4">
                            <label for="sks" class="form-label">
                                SKS <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="input-group" style="max-width: 180px;">
                                    <input type="number"
                                           id="sks"
                                           name="sks"
                                           class="form-control @error('sks') is-invalid @enderror"
                                           placeholder="1–6"
                                           value="{{ old('sks', $matakuliah->sks) }}"
                                           min="1"
                                           max="6">
                                    <span class="input-group-text">SKS</span>
                                    @error('sks')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <small class="text-muted">Nilai antara 1 sampai 6</small>
                            </div>
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
                                        {{ old('id_jurusan', $matakuliah->id_jurusan) == $jurusan->id_jurusan ? 'selected' : '' }}>
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
                                    data-confirm-form="form-edit-matakuliah"
                                    data-confirm-title="Update Mata Kuliah"
                                    data-confirm-message="Simpan perubahan data mata kuliah?"
                                    data-subject-field="nama_matakuliah">
                                <i class="bi bi-save-fill me-2"></i>Update
                            </button>
                            <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary px-4">
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
                                <span>ID: <strong>{{ $matakuliah->id_matakuliah }}</strong></span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-mortarboard"></i>
                                <span>SKS saat ini: <strong>{{ $matakuliah->sks }} SKS</strong></span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-calendar3"></i>
                                <span>Dibuat: {{ $matakuliah->created_at?->format('d M Y') ?? '—' }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-pencil"></i>
                                <span>Diubah: {{ $matakuliah->updated_at?->format('d M Y') ?? '—' }}</span>
                            </div>
                            <hr style="border-color: #c5cae9; margin: 0.75rem 0;">
                            <div class="info-title mt-2">
                                <i class="bi bi-info-circle-fill"></i> Petunjuk
                            </div>
                            <div class="info-item">
                                <i class="bi bi-check2-circle"></i>
                                <span>SKS diisi antara 1 hingga 6 sesuai bobot mata kuliah.</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-check2-circle"></i>
                                <span>Perubahan jurusan akan memindahkan mata kuliah ke program studi lain.</span>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
