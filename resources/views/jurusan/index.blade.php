@extends('layouts.app')

@section('title', 'Data Jurusan')
@section('page-title', 'Jurusan')

@section('content')

    {{-- Page Header --}}
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h4><i class="bi bi-diagram-3-fill me-2" style="color:#1a237e;"></i>Data Jurusan</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-muted">Master Data</li>
                    <li class="breadcrumb-item active">Jurusan</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('jurusan.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Jurusan</span>
        </a>
    </div>

    {{-- Main Card --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="card-title">Daftar Jurusan</h6>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('jurusan.index') }}" class="d-flex gap-2">
                <div class="input-group" style="min-width: 260px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted" style="font-size:0.85rem;"></i>
                    </span>
                    <input type="text"
                           id="search-jurusan"
                           name="search"
                           class="form-control border-start-0 ps-0"
                           placeholder="Cari nama atau akreditasi..."
                           value="{{ $search ?? '' }}">
                </div>
                <button type="submit" class="btn btn-primary btn-sm px-3">Cari</button>
                @if($search)
                    <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>ID Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th width="120">Akreditasi</th>
                        <th width="140" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jurusans as $index => $jurusan)
                        <tr>
                            <td class="text-muted">{{ $jurusans->firstItem() + $index }}</td>
                            <td>
                                <span class="badge bg-secondary fw-normal">{{ $jurusan->id_jurusan }}</span>
                            </td>
                            <td class="fw-500">{{ $jurusan->nama_jurusan }}</td>
                            <td>
                                <span class="badge badge-{{ $jurusan->akreditasi }} rounded-pill px-3 py-1">
                                    Akreditasi {{ $jurusan->akreditasi }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('jurusan.edit', $jurusan->id_jurusan) }}"
                                   class="btn btn-sm btn-outline-primary me-1"
                                   title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Hapus"
                                        onclick="confirmDelete({{ $jurusan->id_jurusan }}, '{{ $jurusan->nama_jurusan }}')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                @if($search)
                                    Tidak ada data yang cocok dengan pencarian <strong>"{{ $search }}"</strong>.
                                @else
                                    Belum ada data jurusan.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($jurusans->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <small class="text-muted">
                        Menampilkan {{ $jurusans->firstItem() }}–{{ $jurusans->lastItem() }}
                        dari {{ $jurusans->total() }} data
                    </small>
                    {{ $jurusans->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white border-0">
                    <h6 class="modal-title" id="deleteModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="mb-1">Hapus data jurusan:</p>
                    <p class="fw-bold mb-1" id="deleteItemName" style="color:#1a237e;"></p>
                    <small class="text-muted">Tindakan ini tidak dapat dibatalkan dan<br>akan menghapus data terkait.</small>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i>Batal
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm px-4" id="btn-delete-submit">
                            <i class="bi bi-trash-fill me-1"></i>Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id, name) {
        document.getElementById('deleteItemName').textContent = name;
        document.getElementById('deleteForm').action = '{{ url("jurusan") }}/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endpush
