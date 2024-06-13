@extends('layouts.app')
@section('content')
<div class="card">
    <div class="m-4">
        <div class="pt-3">
            <h1 class="h2 text-center">Biodata Mahasiswa</h1>
        </div>
        <hr>
            <ul>
                <li>Nama: <strong>{{ $mahasiswa->nama }}</strong></li>
                <li>Nomor Induk Mahasiswa: <strong>{{ $mahasiswa->nim }}</strong></li>
                <li>jurusan: <strong>{{ $mahasiswa->jurusan->nama }}</strong></li>
                <li>Total Matakuliah:
                    <strong>{{ count($matakuliahs) }}</strong>
                    ({{ $matakuliahs->sum('jumlah_sks') }} SKS)
                </li>
            </ul>
            <p>Mengambil Mata Kuliah:</p>
            <ol>
                @foreach ($matakuliahs as $matakuliah)
                    <li>
                        {{ $matakuliah->nama }}
                        <small>
                            ( <a href="{{ route('matakuliahs.show', ['matakuliah' => $matakuliah->id]) }}">{{ $matakuliah->kode }}</a>
                            - {{ $matakuliah->jumlah_sks }} SKS )
                        </small>
                    </li>
                @endforeach
            </ol>

            @auth
                <a href="{{ route('ambil-matakuliah', ['mahasiswa' => $mahasiswa->id]) }}" class="btn btn-info" title="Daftarkan Mata Kuliah">Ambil Mata Kuliah</a>
            @endauth
    </div>
</div>
@endsection