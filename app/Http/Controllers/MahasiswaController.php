<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mahasiswas = Mahasiswa::with('jurusan')->orderBy('nama')->paginate(10);
        return view('mahasiswa.index', ['mahasiswas' => $mahasiswas]);
    }

    public function ambilMatakuliah(Mahasiswa $mahasiswa): View
    {
        $matakuliahs = Matakuliah::where('jurusan_id', $mahasiswa->jurusan_id)->orderBy('nama')->get();
        $matakuliahs_sudah_diambil = $mahasiswa->matakuliahs->pluck('id')->all();

        return view('mahasiswa.ambil-matakuliah',[
            'mahasiswa' => $mahasiswa,
            'matakuliahs' => $matakuliahs,
            'matakuliahs_sudah_diambil' => $matakuliahs_sudah_diambil,
        ]);
    }

    public function prosesAmbilMatakuliah(Request $request, Mahasiswa $mahasiswa)
    {
        $matakuliah_jurusan = Matakuliah::where('jurusan_id', $mahasiswa->jurusan_id)->pluck('id')->toArray();

        $validateData = $request->validate([
            'matakuliah.*' => 'distinct|in:'.implode(',', $matakuliah_jurusan),
        ]);

        $mahasiswa->matakuliahs()->sync($validateData['matakuliah'] ?? []);

        Alert::success('berhasil', "Terdapat ".count($validateData['matakuliah'] ?? [])."mata kuliah yang diambil $mahasiswa->nama");

        return redirect(route('mahasiswas.show', [
            'mahasiswa' => $mahasiswa->id
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('mahasiswa.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim' => 'required|alpha_num|size:8|unique:mahasiswas,nim',
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);

        // kode untuk cek limit tiap kelas berapa mahasiswa
        $daya_tampung = Jurusan::find($request->jurusan_id)->daya_tampung;
        $total_mahasiswa = Mahasiswa::where('jurusan_id', $request->jurusan_id)->count();

        if($total_mahasiswa >= $daya_tampung){
            Alert::error('Pendaftaran Gagal', 'Sudah melebihi limit kelas jurusan');

            return back()->withInput();
        }

        Mahasiswa::create($validateData);
        Alert::success('berhasil', "Mahasiswa $request->nama berhasil dibuat");
        return redirect($request->temp_url);
        // return redirect(route('mahasiswas.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa): View
    {
        $matakuliahs = $mahasiswa->matakuliahs->sortBy('nama');
        
        return view('mahasiswa.show',[
            'mahasiswa' => $mahasiswa,
            'matakuliahs' => $matakuliahs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa): View
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
            'jurusans' => $jurusans,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validateData = $request->validate([
            'nim' => 'required|alpha_num|size:8|unique:mahasiswas,nim,'.$mahasiswa->id,
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);

        if ( ($mahasiswa->matakuliahs()->count() > 0) AND $mahasiswa->jurusan_id != $request->jurusan_id ){
            Alert::error('Update gagal', "jurusan tidak bisa diubah!");
            return back()->withinput();
        }

        $mahasiswa->update($validateData);
        Alert::success('Berhasil', "data mahasiswa $request->nama telah diperbaharui");
        return redirect($request->temp_url);
        // return redirect(route('mahasiswas.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        Alert::success('Berhasil', "Data mahasiswa $mahasiswa->nama berhasil di hapus");
        return redirect(route('mahasiswas.index'));
    }
}
