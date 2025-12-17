@extends('layout.app')
@section('title','Photo')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Photo</h5>
        <a href="{{ route('admin.photo.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Photo
        </a>
    </div>

    <div class="m-3 mb-2">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table" id="photo">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Preview</th>
                    <th>Album</th>
                    <th>Caption</th>
                    <th>Uploader</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @foreach ($photos as $photo)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <img src="{{ asset('storage/' . $photo->file) }}" alt="Photo" class="rounded" width="60">
                    </td>
                    <td>{{ $photo->album->name ?? '-' }}</td>
                    <td>{{ $photo->caption ?? '-' }}</td>
                    <td>
                        @if($photo->user_id)
                        <span class="badge bg-label-primary">Admin</span>
                        @else
                        <span class="badge bg-label-secondary">Publik</span>
                        @endif
                    </td>
                    <td>
                        @if($photo->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                        @elseif($photo->status === 'pending')
                        <span class="badge bg-warning">Pending</span>
                        @else
                        <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('admin.photo.edit', $photo->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.photo.destroy', $photo->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="dropdown-item text-danger">
                                        <i class="bx bx-trash me-1"></i> Delete
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
        $('#photo').DataTable();
    });
</script>

@endsection