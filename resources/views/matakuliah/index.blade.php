@extends('layouts.app')
@section('content')
    <h1 class="display-4 text-center my-5" id="judul">Matakuliah</h1>
    
    <div class="text-end pt-5 pb-4">
        @auth
            <a href="{{ route('matakuliahs.create') }}" class="btn btn-info">
                Tambah Mata Kuliah
            </a>
        @endauth
    </div>
    
    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Dosen Pengajar</th>
                    <th>Jumlah SKS</th>
                    <th>Jurusan</th>
                    @auth
                    <th>Action</th>
                    @endauth
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($matakuliahs as $matakuliah)
                    <tr>
                        <th>{{ $matakuliahs->firstItem() + $loop->iteration -1 }}</th>
                        <td>{{ $matakuliah->kode }}</td>
                        <td>
                            <a href="{{ route('matakuliahs.show', ['matakuliah' => $matakuliah->id]) }}">
                                {{ $matakuliah->nama }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('dosens.show', ['dosen' => $matakuliah->dosen->id]) }}">
                                {{ $matakuliah->dosen->nama }}
                            </a>
                        </td>
                        <td>{{ $matakuliah->jumlah_sks }}</td>
                        <td>{{ $matakuliah->jurusan->nama }}</td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="mx-auto mt-3">
            {{ $matakuliahs->fragment('judul')->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
@endsection