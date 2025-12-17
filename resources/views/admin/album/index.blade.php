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
                        <i class="icon-base bx bxl-angular icon-md text-danger me-4"></i> <span>{{ $album->name ?? '-' }}</span>
                    </td>
                    <td>{{ $album->deskripsi ?? '-' }}</td>
                    <td>
                        <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                            <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Christina Parker">
                                <img src={{ asset('admin/assets/img/avatars/4.png') }} alt="Avatar" class="rounded-circle" />
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
                                <a class="dropdown-item" href="{{ route('admin.jurusan.edit', $album->id) }}"><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i> Delete</a>
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