@extends('layouts.app')

@section('title', 'Edit Mahasiswa')
@section('page-title', 'Edit Mahasiswa')

@section('content')

    <div class="page-header">
        <h4><i class="bi bi-person-gear me-2" style="color:#1a237e;"></i>Edit Mahasiswa</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.index') }}" class="text-decoration-none">Mahasiswa</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title"><i class="bi bi-people me-2 text-primary"></i>Form Edit Mahasiswa</h6>
                    <span class="badge bg-primary font-monospace">{{ $mahasiswa->nim }}</span>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST" id="form-edit-mahasiswa">
                        @csrf
                        @method('PUT')

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
                                    class="form-select @error('id_jurusan') is-invalid @enderror">
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

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-2 pt-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save-fill me-2"></i>Update
                            </button>
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
