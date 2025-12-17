@extends('layout.app')
@section('title','Tambah Photo')
@section('content')

<div class="row g-6">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Tambah Photo</h5>

            <div class="card-body">
                <form action="{{ route('admin.photo.store') }}"method="POST"enctype="multipart/form-data">
                    @csrf
                    {{-- PILIH ALBUM --}}
                    <div class="mb-4">
                        <label class="form-label">Album</label>
                        <select name="album_id"class="form-select form-select-lg">
                            <option value="">-- Pilih Album --</option>
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}"
                                    {{ old('album_id') == $album->id ? 'selected' : '' }}>
                                    {{ $album->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('album_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- UPLOAD FOTO --}}
                    <div class="mb-4">
                        <label class="form-label">Photo</label>
                        <input name="file"class="form-control"type="file"accept="image/*">
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- CAPTION --}}
                    <div class="mb-4">
                        <label class="form-label">Caption</label>
                        <textarea name="caption"class="form-control"rows="3"placeholder="Caption photo (opsional)">{{ old('caption') }}</textarea>
                        @error('caption')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.photo.index') }}"class="btn btn-outline-secondary">
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
