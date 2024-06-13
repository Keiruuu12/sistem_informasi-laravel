@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="m-4">
            <div class="pt-3">
                <h1 class="h2">Daftarkan Mahasiswa ke Matakuliah</h1>
            </div>
            <hr>
            <ul>
                <li>Nama: <strong>{{ $matakuliah->nama }}</strong></li>
                <li>Kode Mata Kuliah: <strong>{{ $matakuliah->kode }}</strong></li>
                <li>Dosen Pengajar: 
                    <strong>{{ $matakuliah->dosen->nama }}</strong>
                </li>
                <li>Jurusan: <strong>{{ $matakuliah->jurusan->nama }}</strong></li>
                <li>Jumlah SKS: <strong>{{ $matakuliah->jumlah_sks }}</strong></li>
                <li>Total Mahasiswa: 
                    <strong>{{ count($mahasiswas_sudah_terdaftar) }}</strong>
                </li>
            </ul>
            <hr>
            <h5 class="mt-5 mb-4">Daftar mahasiswa {{ $matakuliah->jurusan->nama }} yang mengambil matakuliah {{ $matakuliah->nama }}:</h5>

            <form action="{{ route('proses-daftarkan-mahasiswa', ["matakuliah" => $matakuliah->id]) }}" method="POST">
                @csrf

                <div class="form-group row">
                    @error('mahasiswa.*')
                        <div class="invalid-feedback my-3 d-block ml-3">
                            <strong>Error: Pilihan mahasiswa ada yang berulang / bukan dari jurusan {{ $matakuliah->jurusan->nama }}</strong>
                        </div>
                    @enderror
                    <div class="col-md-12" style="column: 3;">
                        @foreach ($mahasiswas as $mahasiswa)
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" name="mahasiswa[]" id="mahasiswa-{{ $mahasiswa->id }}" class="custom-control-input" value="{{ $mahasiswa->id }}"
                                @if ( in_array($mahasiswa->id, (old('mahasiswa') ?? $mahasiswas_sudah_terdaftar ?? [] )) )
                                checked                                    
                                @endif
                                >
                                <label for="mahasiswa-{{ $mahasiswa->id }}" class="custom-control-label">
                                    {{ $mahasiswa->nama }}
                                    <small>
                                        ( <a href="{{ route('mahasiswas.show', ['mahasiswa' => $mahasiswa->id]) }}">{{ $mahasiswa->nim }}</a> )
                                    </small>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Daftarkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection