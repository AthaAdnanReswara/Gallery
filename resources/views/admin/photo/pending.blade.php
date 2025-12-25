@extends('layout.app')

@section('content')
<div class="container">

    <h4 class="mb-3">Foto Pending</h4>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($photos as $photo)
        <div class="col-md-4">
            <div class="card mb-3">

                <img src="{{ asset('storage/'.$photo->file) }}"
                    class="card-img-top"
                    style="height:200px; object-fit:cover;">

                <div class="card-body">
                    <p class="mb-1">{{ $photo->caption }}</p>
                    <small class="text-muted">
                        Album: {{ $photo->album->name ?? '-' }}
                    </small>
                </div>

                <div class="card-footer d-flex gap-2">

                    <!-- APPROVE -->
                    <form action="{{ route('admin.photo.approve', $photo->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>

                    <!-- REJECT -->
                    <form action="{{ route('admin.photo.reject', $photo->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menolak dan menghapus foto ini?')">
                        @csrf
                        <button class="btn btn-danger btn-sm">Reject</button>
                    </form>

                    <!-- DETAIL -->
                    <a href="{{ route('admin.photo.show', $photo->id) }}"
                        class="btn btn-secondary btn-sm">
                        Detail
                    </a>

                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection