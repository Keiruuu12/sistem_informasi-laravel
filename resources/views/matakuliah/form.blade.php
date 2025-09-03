@csrf
<div class="row mb-3">
    <label for="kode" class="col-md-3 col-form-label text-md-end" title="5 digit kode mata kuliah">Kode Mata Kuliah</label>
    <div class="col-md-4">
        <input type="text" name="kode" id="kode" autofocus class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode') ?? $matakuliah->kode ?? '' }}" placeholder="5 digit kode mata kuliah contoh: 12xa5">
        @error('kode')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="nama" class="col-md-3 col-form-label text-md-end">Nama Mata Kuliah</label>
    <div class="col-md-4">
        <input type="text" name="nama" id="nama" autofocus class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') ?? $matakuliah->nama ?? '' }}">
        @error('nama')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="jurusan_id" class="col-md-3 col-form-label text-md-end">Jurusan</label>
    @if ( ($tombol == 'Update') AND ($matakuliah->mahasiswas->count() > 0) )
        <div class="col-md-9 d-flex align-items-center">
            <div>
                {{ $matakuliah->jurusan->nama }}
                <small>
                    <i>(tidak bisa di ubah karena sudah diambil {{ $matakuliah->mahasiswas->count() }} mahasiswa)</i>
                </small>
            </div>
        </div>
        <input type="hidden" name="jurusan_id" id="jurusan_id" value="{{ $matakuliah->jurusan_id }}">
    @else
        <div class="col-md-4">
            <select name="jurusan_id" id="jurusan_id" class="form-select @error('jurusan_id') is-invalid @enderror">
                @foreach ($jurusans as $jurusan)
                    @if ($jurusan->id == (old('jurusan_id') ?? $mahasiswa->jurusan_id ?? ''))
                    <option value="{{ $jurusan->id }}" selected>{{ $jurusan->nama }}</option>
                    @else
                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                    @endif    
                @endforeach
            </select>
            @error('jurusan_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endif
</div>

<div class="row mb-3">
    <label for="dosen_id" class="col-md-3 col-form-label text-md-end">Dosen Pengajar</label>
    @if (isset($dosen))
        <div class="col-md-4 d-flex align-items-center">
            <div>{{ $dosen->nama }}</div>
        </div>
        <input type="hidden" name="dosen_id" id="dosen_id" value="{{ $dosen->id }}">
    @else
    <div class="col-md-4">
        <select name="dosen_id" id="dosen_id" class="form-select @error('dosen_id') is-invalid @enderror">
            @foreach ($dosens as $dosen)
                @if ($dosen->id == (old('dosen_id') ?? $matakuliah->dosen->nama ?? ''))
                <option value="{{ $dosen->id }}" selected>{{ $dosen->nama }}</option>
                @else
                <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                @endif    
            @endforeach
        </select>
        @error('dosen_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    @endif
</div>

<div class="row mb-3">
    <label for="jumlah_sks" class="col-md-3 col-form-label text-md-end">Jumlah SKS</label>
    <div class="col-md-4">
        <select name="jumlah_sks" id="jumlah_sks" class="form-select @error('jumlah_sks') is-invalid @enderror">
            @for ($i = 1; $i <= 6; $i++)
                @if ($i == (old('jumlah_sks') ?? $matakuliah->jumlah_sks ?? ''))
                    <option value="{{ $i }}" selected>{{ $i }}</option>
                @else
                    <option value="{{ $i }}">{{ $i }}</option>
                @endif
            @endfor
        </select>
        @error('jumlah_sks')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- hidden form --}}
@isset($matakulliah)
    <input type="hidden" name="temp_url" id="temp_url" value="{{ old('temp_url') ?? url()->previous().'#row-'.$matakuliah->id }}">
@else
    <input type="hidden" name="temp_url" value="{{ old('temp_url') ?? url()->previous() }}">
@endisset

<div class="row mb-3">
    <div class="col-md-6 offset-md-3">
        <button type="submit" class="btn btn-primary">{{ $tombol }}</button>
    </div>
</div>