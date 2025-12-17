@extends('layout.app')
@section('title','tambah tambah')
@section('content')

<div class="row g-6">
    <!-- Input Sizing -->
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Tambah Album</h5>
            <div class="card-body">
                <div class="mt-2 mb-4">
                    <label for="largeInput" class="form-label">Nama</label>
                    <input id="largeInput" name="name" class="form-control form-control-lg" type="text" placeholder="Nama....................." />
                </div>
                <div class="mb-4">
                    <label for="defaultInput" class="form-label">Deskripsi</label>
                    <input id="defaultInput" class="form-control" type="text" placeholder="Deskripsi.................." />
                </div>
                <div class="mb-4">
                    <label for="defaultInp" class="form-label">Cover</label>
                    <input id="defaultInp" class="form-control" type="file" />
                </div>
            </div>
        </div>
    </div>
</div>

@endsection