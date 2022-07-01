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
        // dd(Kriteria::all()->count());
        return view('konten.siswa.nilai.index',[
            'active' => 2,
            'title' => 'Nilai Siswa',
            'user' => Auth::user(),
            'siswas' => Siswa::latest()->get(),
            'kriteria' => Kriteria::all()->count(),
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
        $kriterias = Kriteria::all();
        $nilai_siswa_id = $request->nilai_siswa_id;

        foreach($kriterias as $k){
            $pilihan[] = (int)$request->kriteria[$k->id];
        }
        // dd ($request->kriteria[$k->id]);
        // $pilihan = "";
        // $pilihan = "$request->C1, $request->C2, 
        // $request->C3, $request->C4, 
        // $request->C5, $request->C6";
        // $pilihan = "7, 1, 2, 3";
        // dd($pilihan);
        // $int_pilihan = array_map('intval', explode(',',$pilihan));
        // dd($int_pilihan);
        $nama = Siswa::where('nilai_siswa_id', $nilai_siswa_id)->first()->nama;
        
        //Memvalidasi data baru yg diisi (apakah data sudah ada sebelumnya)
        $data_exist = NilaiSiswa::where('id','=',$nilai_siswa_id)->exists();
        
        if($data_exist){
            return back()->withInput()->with('failed', 'Data sudah ada, silahkan input data yang berbeda!');
        }else {
            NilaiSiswa::create([
                'id' => $nilai_siswa_id,
                'nama' => $nama,
                'pilihan' => $pilihan
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
        // dd($id);
        // dd(count($id['pilihan']));
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
        
        $kriterias = Kriteria::all();
        // dd($request);
        foreach($kriterias as $k){
            $pilihan[] = (int)$request->kriteria[$k->id];
        }
        $id = $request->id;
        $nama = $request->nama;
        // dd($pilihan);

        //Ubah string ke bentuk integer
        // $int_pilihan = array_map('intval', explode(',',$pilihan));

        NilaiSiswa::where('id', $id)->update([
            'id' => $id,
            'nama' => $nama,
            'pilihan' => $pilihan
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
