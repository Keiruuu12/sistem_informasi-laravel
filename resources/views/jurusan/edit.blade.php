@extends('layouts.app')
@section('content')
    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="m-4">
            <div class="pt-3">
                <h1 class="h2">Edit Jurusan</h1>
            </div>
        </div>
        <hr>

        <form action="{{ route('jurusans.update', ['jurusan' => $jurusan->id]) }}" method="POST">
            @method('PATCH')
            @include('jurusan.form', ['tombol' => 'Update'])
        </form>
    </div>
@endsection