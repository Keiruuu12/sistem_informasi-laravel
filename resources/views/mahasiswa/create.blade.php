@extends('layouts.app')
@section('content')
<div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="pt-3">
        <h1 class="h2">Tambah Mahasiswa</h1>
    </div>
    <hr>

    <form action="{{ route('mahasiswas.store') }}" method="POST">
        @include('mahasiswa.form', ['tombol' => 'tambah'])
    </form>
</div>
@endsection