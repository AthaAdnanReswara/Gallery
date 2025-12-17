@extends('layout.app')
@section('title','album')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Album</h5>
        <a href="{{ route('admin.album.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Album
        </a>
    </div>
    <div class="m-3 mb-2">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible text-dark">{{ session('success') }}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger small mx-3">{{ session('error') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger small mx-3">{{ $errors->first() }}</div>
        @endif
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table " id="album">
            <thead>
                <tr>
                    <th>no</th>
                    <th>Album</th>
                    <th>Deskripsi</th>
                    <th>Cover</th>
                    <th>Is_active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ( $albums as $album )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span>{{ $album->name ?? '-' }}</span>
                    </td>
                    <td>{{ $album->deskripsi ?? '-' }}</td>
                    <td>
                        <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                            <li class="avatar avatar-xs pull-up">
                                <img src="{{ asset('storage/' . $album->cover) }}" alt="Cover Album" class="rounded-circle" />
                            </li>
                        </ul>
                    </td>
                    <td><span class="badge bg-label-primary me-1">{{ $album->is_active }}</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="icon-base bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.album.edit', $album->id) }}">
                                    <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.album.destroy', $album->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus album ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="icon-base bx bx-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>

                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#album').DataTable();
    });
</script>

@endsection