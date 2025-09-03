@extends('layouts.app')
@section('content')
<div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="m-4">
        <div class="pt-3">
            <h1 class="h2 text-center">Informasi Mata Kuliah</h1>
        </div>
        @auth
        <td>
            <a href="{{ route('matakuliahs.edit', ['matakuliah' => $matakuliah->id]) }}" class="btn btn-secondary" title="Edit Matakuliah">Edit</a>
            <form action="{{ route('matakuliahs.destroy', ['matakuliah' => $matakuliah->id]) }}" class="d-inline" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger shadow-none btn-hapus" title="Hapus Matakuliah">Hapus</button>
            </form>
        </td>
        @endauth
        <hr>
        <ul>
            <li>Nama: <strong>{{ $matakuliah->nama }}</strong></li>
            <li>Kode Mata Kuliah <strong>{{ $matakuliah->kode }}</strong></li>
            <li>Dosen Pengajar:
                <a href="{{ route('dosens.show', ['dosen' => $matakuliah->dosen->id]) }}"><strong>{{ $matakuliah->dosen->nama }}</strong></a>
            </li>
            <li>Jurusan: <strong>{{ $matakuliah->jurusan->nama }}</strong></li>
            <li>Jurusan SKS: <strong>{{ $matakuliah->jumlah_sks }}</strong></li>
            <li>Total Mahasiswa: <strong>{{ count($mahasiswas) }}</strong></li>
        </ul>
        <p>Daftar Mahasiswa:</p>
        <ol>
            @foreach ($mahasiswas as $mahasiswa)
                <li>
                    {{ $mahasiswa->nama }}
                    <small>
                        ( <a href="{{ route('mahasiswas.show', ['mahasiswa' => $mahasiswa->id]) }}">{{ $mahasiswa->nim }}</a> )
                    </small>
                </li>
            @endforeach
        </ol>
        @auth
            <a href="{{ route('daftarkan-mahasiswa', ['matakuliah' => $matakuliah->id]) }}" class="btn btn-info" title="Daftarkan Mahasiswa">Daftarkan Mahasiswa</a>
        @endauth
    </div>
</div>
@endsection