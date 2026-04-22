@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')
@section('page-title', 'Edit Mata Kuliah')

@section('content')

    <div class="page-header">
        <h4><i class="bi bi-journal-pen me-2" style="color:#1a237e;"></i>Edit Mata Kuliah</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('matakuliah.index') }}" class="text-decoration-none">Mata Kuliah</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title"><i class="bi bi-book me-2 text-primary"></i>Form Edit Mata Kuliah</h6>
                    <span class="badge bg-secondary">ID: {{ $matakuliah->id_matakuliah }}</span>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('matakuliah.update', $matakuliah->id_matakuliah) }}" method="POST" id="form-edit-matakuliah">
                        @csrf
                        @method('PUT')

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

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-2 pt-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save-fill me-2"></i>Update
                            </button>
                            <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
