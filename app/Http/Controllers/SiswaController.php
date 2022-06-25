<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiSiswa;
use App\Models\Kriteria;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index(){
        return view('konten.siswa.data.index',[
            'active' => 1,
            'title' => 'Data Siswa',
            'user' => Auth::user(),
            'siswas' => Siswa::latest()->filter(request(['search']))->get(),
            'nilai_siswas' => NilaiSiswa::latest()->get()
        ]);
    }

    public function create(){
        return view('konten.siswa.data.create',[
            'active' => 1,
            'title' => 'Siswa Baru',
            'user' => Auth::user(),
            'jk' => [
                0 => 'L',
                1 => 'P'
            ],
        ]);
    }

    public function show(Siswa $id){
        return view('konten.siswa.data.show',[
            'active' => 1,
            'title' => 'Calon Siswa',
            'user' => Auth::user(),
            'siswas' => $id
        ]);
    }

    public function store(Request $request){
        //Generate id nilai siswa random
        $nilai_siswa_id = random_int(0,999);

        //Generate id nilai siswa baru jika sudah ada
        if($nilai_siswa_id==NilaiSiswa::where('id','=', $nilai_siswa_id)->exists()){
            $nilai_siswa_id = random_int(0,9999);
        }

        //Memasukkan variabel baru ke dalam request
        $request->merge([
            'nilai_siswa_id' => $nilai_siswa_id,
        ]);

        $data_baru = [
            ['nama','=', $request->nama],
            ['jk','=', $request->jk],
            ['tempat_lahir','=', $request->tempat_lahir],
            ['tanggal_lahir','=', $request->tanggal_lahir],
            ['alamat','=', $request->alamat]
        ];

        dd($data_baru);

        $rules = [
            'nilai_siswa_id' => 'required',
            'nama' => 'required|min:3|max:255',
            'jk' => 'required',
            'tempat_lahir' => 'required|min:3|max:255',
            'tanggal_lahir' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:500',
        ];

        $validated = $request->validate($rules);

        //Memvalidasi data baru yg diisi (apakah data sudah ada sebelumnya)
        $data_exist = Siswa::where($data_baru)->exists(); 

        if($data_exist){
            return back()->withInput()->with('failed', 'Data sudah ada, silahkan input data yang berbeda!');
        }else {
            Siswa::create($validated);
            return redirect('/siswa')->with('success', 'Data baru berhasil ditambahkan');
        }
    }

    public function destroy(Request $request){
        Siswa::destroy($request->id);
        NilaiSiswa::destroy($request->nilai_siswa_id); //belum berhasil ngapus nilai siswa
        return redirect('/siswa')->with('success', 'Data berhasil dihapus');
    }

    public function edit(Siswa $id){
        return view('konten.siswa.data.edit',[
            'active' => 1,
            'title' => 'Ubah Data Siswa',
            'user' => Auth::user(),
            'siswa' => $id,
            // dd($id->nama),
            'jk' => [
                0 => 'L',
                1 => 'P'
            ],
        ]);
    }

    public function update(Request $request, Siswa $id){
        $rules = ([
            'nama' => 'required|min:3|max:255',
            'jk' => 'required',
            'tempat_lahir' => 'required|min:3|max:255',
            'tanggal_lahir' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:500',
        ]);
        
        $validated = $request->validate($rules);

        //Memvalidasi data baru yg diisi (apakah data sudah ada sebelumnya)
        $data_exist = Siswa::where($validated)->exists();

        $data = [
            ['nama',$request->nama],
            ['jk',$request->jk],
            ['tempat_lahir',$request->tempat_lahir],
            ['tanggal_lahir',$request->tanggal_lahir],
            ['alamat',$request->alamat],
        ];

        //Kalo data sama dengan data sebelum diedit maka akan terupdate
        $same_data = Siswa::where($data)->exists();

        if($data_exist && $same_data){
            return back()->withInput()->with('failed', 'Data sudah ada, silahkan input data yang berbeda!');
        }else {
            Siswa::where('id', $id->id)
                    ->update($validated);
            NilaiSiswa::where('id', $id->nilai_siswa_id)
                    ->update([
                        'nama' => $request->nama,
                    ]);
            return redirect('/siswa')->with('success', 'Data berhasil diubah');
        }
    }

    public function print(){
        return view('konten.siswa.data.print',[
            'active' => 1,
            'title' => 'Cetak Data Siswa',
            'user' => Auth::user(),
            'siswas' => Siswa::latest()->filter(request(['search']))->get(),
            'nilai_siswas' => NilaiSiswa::latest()->get()
        ]);
    }
}
