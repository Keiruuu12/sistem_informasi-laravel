@extends('layouts.app')
@section('content')
<div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="pt-3">
        <h1 class="h2">Tambah Dosen</h1>
    </div>
    <hr>
    
    <form action="{{ route('dosens.store') }}" method="POST">
        @include('dosen.form', ['tombol' => 'Tambah'])
    </form>
</div>
@endsection