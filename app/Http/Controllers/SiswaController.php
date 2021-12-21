<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiSiswa;
use App\Models\Kriteria;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(){
        return view('konten/siswa/siswa',[
            "title" => "Siswa",
            "siswas" => Siswa::latest()->filter(request(['search']))->get(),
            "nilai_siswas" => NilaiSiswa::latest()->get()
        ]);
    }

    public function create(){
        return view('konten.siswa.create',[
            "title" => "Siswa Baru",
            "jk" => [
                0 => "L",
                1 => "P"
            ],
        ]);
    }

    public function show(Siswa $id){
        return view('konten/siswa/detailSiswa',[
            "title" => "Calon Siswa",
            "siswas" => $id
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nama' => 'required|min:3|max:255',
            'jk' => 'required',
            'tempat_lahir' => 'required|min:3|max:255',
            'tanggal_lahir' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:500',
        ]);

        Siswa::create($validated);

        return redirect('/')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function createNilaiSiswa(){
        return view('konten/siswa/tambahNilaiSiswa',[
            "title" => "Tambah Nilai Siswa",
            "siswas" => Siswa::orderBy('nama')->get(),
            "kriterias" => Kriteria::all()
        ]);
    }
}
