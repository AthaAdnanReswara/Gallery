@extends('layout.app')
@section('title','Edit Photo')

@section('content')

<div class="row g-6">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Photo</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.photo.update', $photo->id) }}"method="POST"enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- PILIH ALBUM --}}
                    <div class="mb-4">
                        <label class="form-label">Album</label>
                        <select name="album_id"
                            class="form-select form-select-lg">
                            @foreach ($albums as $album)
                            <option value="{{ $album->id }}"
                                {{ old('album_id', $photo->album_id) == $album->id ? 'selected' : '' }}>
                                {{ $album->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('album_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- CAPTION --}}
                    <div class="mb-4">
                        <label class="form-label">Caption</label>
                        <textarea name="caption"class="form-control"rows="3">{{ old('caption', $photo->caption) }}</textarea>
                        @error('caption')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- FOTO --}}
                    <div class="mb-4">
                        <label class="form-label">Photo</label>
                        @if($photo->file)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $photo->file) }}" alt="Photo"width="120"class="rounded shadow-sm">
                        </div>
                        @endif
                        <input type="file" name="file" class="form-control"accept="image/*">
                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto
                        </small>
                        @error('file')
                        <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.photo.index') }}"class="btn btn-outline-secondary">
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