<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $matakuliahs = Matakuliah::with('dosen', 'jurusan')->orderBy('nama')->paginate(10);
        return view('matakuliah.index', ['matakuliahs' => $matakuliahs]);
    }

    public function daftarkanMahasiswa(Matakuliah $matakuliah): View
    {
        $mahasiswas = Mahasiswa::where('jurusan_id', $matakuliah->jurusan_id)->orderBy('nama')->get();
        $mahasiswas_sudah_terdaftar = $matakuliah->mahasiswas->pluck('id')->all();

        return view('matakuliah.daftarkan-mahasiswa', [
            'matakuliah' => $matakuliah,
            'mahasiswas' => $mahasiswas,
            'mahasiswas_sudah_terdaftar' => $mahasiswas_sudah_terdaftar,
        ]);
    }

    public function prosesDaftarkanMahasiswa(Request $request, Matakuliah $matakuliah): RedirectResponse
    {
        $mahasiswa_jurusan = Mahasiswa::where('jurusan_id', $matakuliah->jurusan_id)->pluck('id')->toArray();
        $validateData = $request->validate([
            'mahasiswa.*' => 'distinct|in:'.implode(',', $mahasiswa_jurusan),
        ]);

        $matakuliah->mahasiswas()->sync($validateData['mahasiswa'] ?? []);
        Alert::success('berhasil', "Terdapat ".count($validateData['mahasiswa'] ?? [])." mahasiswa yang mengambil $matakuliah->nama");

        return redirect(route('matakuliahs.show', [
            'matakuliah' => $matakuliah->id
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
      $jurusans = Jurusan::orderBy('nama')->get();
      $dosens = Dosen::orderBy('nama')->get();
      return view('matakuliah.create', [
        'jurusans' => $jurusans,
        'dosens' => $dosens
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'kode' => 'required|alpha_num|size:5|unique:matakuliahs,kode',
            'nama' => 'required',
            'dosen_id' => 'required|exists:App\Models\Dosen,id',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
            'jumlah_sks' => 'required|digits_between:1,6',
        ]);
        

        Matakuliah::create($validateData);
        Alert::success('Berhasil', "Mata kuliah $request->nama berhasil ditambahkan");
        return redirect($request->temp_url);
        // return redirect(route('matakuliahs.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Matakuliah $matakuliah)
    {
        $mahasiswas = $matakuliah->mahasiswas->sortBy('nama');
        return view('matakuliah.show', [
            'matakuliah' => $matakuliah,
            'mahasiswas' => $mahasiswas,
        ]);
    }


    public function buatMatakuliah(Dosen $dosen): View
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('matakuliah.create', [
            'dosen' => $dosen,
            'jurusans' => $jurusans,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matakuliah $matakuliah): View
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        $dosens = Dosen::orderBy('nama')->get();

        return view('matakuliah.edit', [
            'matakuliah' => $matakuliah,
            'jurusans' => $jurusans,
            'dosens' => $dosens,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matakuliah $matakuliah): RedirectResponse
    {
        $validateData = $request->validate([
            'kode' => 'required|alpha_num|size:5|unique:matakuliahs,kode,'.$matakuliah->id,
            'nama' => 'required',
            'dosen_id' => 'required|exists:App\Models\Dosen,id',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
            'jumlah_sks' => 'required|digits_between:1,6',
        ]);

        if ( ($matakuliah->mahasiswas()->count() > 0) AND ($matakuliah->jurusan_id != $request->jurusan_id) ){
            Alert::error('Update gagal', "Jurusan tidak bisa diubah!");
            return back()->withInput();
        }

        $matakuliah->update($validateData);
        Alert::success('berhasil', "Data matakuliah $request->nama berhasil diperbaharui");
        // return redirect($request->temp_url);
        return redirect(route('matakuliahs.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        Alert::success('Berhasil', "Matakuliah $matakuliah->name berhasil di hapus");
        return redirect(route('matakuliahs.index'));
    }
}
