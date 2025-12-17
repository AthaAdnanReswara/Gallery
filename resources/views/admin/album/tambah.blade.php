@extends('layout.app')
@section('title','tambah tambah')
@section('content')

<div class="row g-6">
    <!-- Input Sizing -->
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Tambah Album</h5>
            <div class="card-body">
                <form action="{{ route('admin.album.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2 mb-4">
                        <label for="largeInput" class="form-label">Nama Album</label>
                        <input id="largeInput" name="name" class="form-control form-control-lg" type="text" placeholder="Nama Album....................." />
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="defaultInput" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi album................"></textarea>
                        @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="defaultInp" class="form-label">Cover</label>
                        <input name="cover" id="defaultInp" class="form-control" type="file" accept="image/*">
                        @error('cover')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- Button -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.album.index') }}" class="btn btn-outline-secondary">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection