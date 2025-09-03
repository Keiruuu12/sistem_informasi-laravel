@extends('layouts.app')
@section('content')
<div class="card pt-3 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div>
        <h1 class="h2">Edit Mata Kuliah</h1>
    </div>
    <hr>
    
    <form action="{{ route('matakuliahs.update', ['matakuliah' => $matakuliah->id]) }}" method="POST">
        @method('PATCH')
        @include('matakuliah.form', ['tombol' => 'Update'])
    </form>
</div>
@endsection