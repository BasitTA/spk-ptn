<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\NilaiSiswa;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index(){
        return view('konten.siswa.nilai.index',[
            'active' => 2,
            'title' => 'Nilai Siswa',
            'user' => Auth::user(),
            'siswas' => Siswa::latest()->get(),
            'nilai_siswas' => NilaiSiswa::latest()->filter(request(['search']))->get()
        ]);
    }
    
    public function create(){
        return view('konten.siswa.nilai.create',[
            'active' => 2,
            'title' => 'Nilai Baru',
            'user' => Auth::user(),
            'siswas' => Siswa::orderBy('nama')->get(),
            'kriterias' => Kriteria::all()
        ]);
    }
    
    public function store(Request $request){
        $nilai_siswa_id = $request->nilai_siswa_id;
        $pilihan = "$request->C1, $request->C2, 
        $request->C3, $request->C4, 
        $request->C5, $request->C6";
        $int_pilihan = array_map('intval', explode(',',$pilihan));
        $nama = Siswa::where('nilai_siswa_id', $nilai_siswa_id)->first()->nama;
        
        //Memvalidasi data baru yg diisi (apakah data sudah ada sebelumnya)
        $data_exist = NilaiSiswa::where('id','=',$nilai_siswa_id)->exists();
        
        if($data_exist){
            return back()->withInput()->with('failed', 'Data sudah ada, silahkan input data yang berbeda!');
        }else {
            NilaiSiswa::create([
                'id' => $nilai_siswa_id,
                'nama' => $nama,
                'pilihan' => $int_pilihan
            ]);
            return redirect('/nilaisiswa')->with('success', 'Data baru berhasil ditambahkan');
        }
    }

    public function destroy(Request $request){
        NilaiSiswa::destroy($request->id);
        return redirect('/nilaisiswa')->with('success', 'Data berhasil dihapus');
    }

    public function edit(NilaiSiswa $id){
        $tanggal_lahir = Siswa::where('nilai_siswa_id',$id->id)->first()->tanggal_lahir;

        return view('konten.siswa.nilai.edit',[
            'active' => 2,
            'title' => 'Ubah Nilai Siswa',
            'user' => Auth::user(),
            'nilai_siswa' => $id,
            'tanggal_lahir' => $tanggal_lahir,
            'siswas' => Siswa::orderBy('nama')->get(),
            'kriterias' => Kriteria::all()
        ]);
    }

    public function update(Request $request){
        $id = $request->id;
        $nama = $request->nama;
        $pilihan = "$request->C1, $request->C2, 
        $request->C3, $request->C4, 
        $request->C5, $request->C6";

        //Ubah string ke bentuk integer
        $int_pilihan = array_map('intval', explode(',',$pilihan));

        NilaiSiswa::where('id', $id)->update([
            'id' => $id,
            'nama' => $nama,
            'pilihan' => $int_pilihan
        ]);

        return redirect('/nilaisiswa')->with('success', 'Data berhasil diupdate');
    }

    public function print(){
        return view('konten.siswa.nilai.print',[
            'active' => 2,
            'title' => 'Cetak Nilai Siswa',
            'user' => Auth::user(),
            'siswas' => Siswa::latest()->get(),
            'nilai_siswas' => NilaiSiswa::latest()->filter(request(['search']))->get()
        ]);
    }
}
