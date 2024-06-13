@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="m-4">
            <div class="pt-3">
                <h1 class="h2">Edit Dosen</h1>
            </div>
        </div>
        <hr>

        <form action="{{ route('dosens.update', ['dosen' => $dosen->id]) }}" method="POST">
            @method('PATCH')
            @include('dosen.form', ['tombol' => 'Update'])
        </form>
    </div>
@endsection