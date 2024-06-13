<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $dosens = Dosen::with('jurusan')->orderBy('nama')->paginate(5);
        return view('dosen.index', ['dosens' => $dosens]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('dosen.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nid' => 'required|alpha_num|size:8|unique:dosens,nid',
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);

        Dosen::create($validateData);
        Alert::success('Berhasil', "Dosen $request->nama berhasil ditambahkan");
        return redirect($request->temp_url);
        // return redirect(route('dosens.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen): View
    {
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        //
    }
}
