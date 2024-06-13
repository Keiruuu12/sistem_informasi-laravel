@extends('layouts.app')
@section('content')
<div class="card">
    <div class="m-4">
        <div class="pt-3">
            <h1 class="pt-3 text-center">Biodata Dosen</h1>
        </div>    
        <hr>
        <ul>
            <li>Nama: <strong>{{ $dosen->nama }}</strong></li>
            <li>Nomor Induk Dosen <strong>{{ $dosen->nid }}</strong></li>
            <li>Jurusan: <strong>{{ $dosen->jurusan->nama }}</strong></li>
        </ul>
        <p>Mengajar Matakuliah:</p>
        <ol>
            @foreach ($dosen->matakuliahs as $matakuliah)
                <li>
                    {{ $matakuliah->nama }}
                    <small>
                        ( <a href="{{ route('matakuliahs.show', ['matakuliah' => $matakuliah->id]) }}">{{ $matakuliah->kode }}</a> 
                        - {{ $matakuliah->jumlah_sks }} SKS)
                    </small>
                </li>
            @endforeach
        </ol>

        @auth
            <a href="{{ route('buat-matakuliah', ['dosen' => $dosen->id]) }}" class="btn btn-info" title="Buat Mata Kuliah">
                Buat Mata Kuliah
            </a>
        @endauth

    </div>
</div>
@endsection