@extends('layouts.app')

@section('title', 'Edit Jurusan')
@section('page-title', 'Edit Jurusan')

@section('content')

    <div class="page-header">
        <h4><i class="bi bi-pencil-square me-2" style="color:#1a237e;"></i>Edit Jurusan</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('jurusan.index') }}" class="text-decoration-none">Jurusan</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title"><i class="bi bi-diagram-3 me-2 text-primary"></i>Form Edit Jurusan</h6>
                    <span class="badge bg-secondary">ID: {{ $jurusan->id_jurusan }}</span>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('jurusan.update', $jurusan->id_jurusan) }}" method="POST" id="form-edit-jurusan">
                        @csrf
                        @method('PUT')

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
                                    class="form-select @error('akreditasi') is-invalid @enderror">
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

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-2 pt-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save-fill me-2"></i>Update
                            </button>
                            <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
