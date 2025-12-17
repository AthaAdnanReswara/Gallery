@extends('layout.app')
@section('title','Edit Album')

@section('content')

<div class="row g-6">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Album</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.album.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Nama Album -->
                    <div class="mb-4">
                        <label class="form-label">Nama Album</label>
                        <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name', $album->name) }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $album->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Cover -->
                    <div class="mb-4">
                        <label class="form-label">Cover</label>
                        @if($album->cover)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $album->cover) }}" alt="Cover Album" width="120" class="rounded shadow-sm">
                        </div>
                        @endif
                        <input type="file" name="cover" class="form-control" accept="image/*">
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
                            <i class="bx bx-save me-1"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection