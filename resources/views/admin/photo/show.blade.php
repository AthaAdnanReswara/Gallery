@extends('layout.app')

@section('content')
<div class="container">

    <h4 class="mb-3">Detail Foto</h4>

    <div class="card">
        <img src="{{ asset('storage/'.$photo->file) }}"
            class="card-img-top"
            style="max-height:400px; object-fit:contain;">

        <div class="card-body">
            <p><strong>Album:</strong> {{ $photo->album->name ?? '-' }}</p>
            <p><strong>Caption:</strong> {{ $photo->caption }}</p>
            <p><strong>Status:</strong>
                <span class="badge bg-warning">{{ $photo->status }}</span>
            </p>
            <p><strong>Email:</strong>{{ $photo->upload->name }}</p>
            <p><strong>Email:</strong>{{ $photo->upload->email }}</p>

        </div>

        <div class="card-footer d-flex gap-2">

            @if($photo->status === 'pending')
            <form action="{{ route('admin.photo.approve', $photo->id) }}" method="POST">
                @csrf
                <button class="btn btn-success">Approve</button>
            </form>

            <form action="{{ route('admin.photo.reject', $photo->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menolak dan menghapus foto ini?')">
                @csrf
                <button class="btn btn-danger">Reject</button>
            </form>
            @endif

            <a href="{{ route('admin.photo.pending') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>

</div>
@endsection