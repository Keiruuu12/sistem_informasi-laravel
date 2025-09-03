@extends('layouts.app')
@section('content')
    <h1 class="display-4 text-center my-5" id="judul">
        Mahasiswa {{ $nama_jurusan ?? '' }}
    </h1>

    <div class="text-end pt-5 pb-4">
        @auth
            <a href="{{ route('mahasiswas.create') }}" class="btn btn-info">Tambah Mahasiswa</a>
        @endauth
    </div>

    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jurusan Mahasiswa</th>
                    @auth
                    <th>Action</th>
                    @endauth
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($mahasiswas as $mahasiswa)
                    <tr>
                        <th>{{ $mahasiswas->firstItem() + $loop->iteration -1 }}</th>
                        <td>{{ $mahasiswa->nim }}</td>
                        <td>
                            <a href="{{ route('mahasiswas.show', ['mahasiswa' => $mahasiswa->id]) }}">
                                {{ $mahasiswa->nama }}
                            </a>
                        </td>
                        <td>{{ $mahasiswa->jurusan->nama }}</td>
                        @auth
                        <td>
                            <a href="{{ route('mahasiswas.edit', ['mahasiswa' => $mahasiswa->id]) }}" class="btn btn-secondary" title="Edit Mahasiswa">Edit</a>
                            <form action="{{ route('mahasiswas.destroy', ['mahasiswa' => $mahasiswa]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger shadow-none btn-hapus" title="Hapus Mahasiswa">Hapus</button>
                            </form>
                        </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="mx-auto mt-3">
            {{ $mahasiswas->fragment('judul')->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
@endsection