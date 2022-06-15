<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Auth;

class KriteriaController extends Controller
{
    public function index(){
        return view('konten.kriteria.index',[
            'active' => 3,
            'title' => 'Data Kriteria',
            'user' => Auth::user(),
            'kriterias' => Kriteria::all()
        ]);
    }

    public function create(){
        return view('konten.kriteria.create',[
            'active' => 1,
            'title' => 'Kriteria Baru',
            'user' => Auth::user(),
            'kriterias' => Kriteria::all()
        ]);
    }

    public function store(Request $request){
        $pembobotan_kriteria = [
            ['pilihan'=>$request->pilihan, //Contoh: Nilai 80-100, 70-78, 60-69, <60
             'bobot'=>$request->bobot], //Contoh: 4, 3, 2, 1
            // [$request->pilihan1, $request->bobot],
        ];

        $data_baru = [
            // ['id','=', $request->id],
            ['kode','=', $request->kode],
            ['nama','=', $request->nama],
            ['jenis','=', $request->jenis],
            ['bobot_kriteria','=', $request->bobot_kriteria],
            ['pembobotan_kriteria','=', $pembobotan_kriteria]
        ];

        $kriteria = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'bobot_kriteria' => $request->bobot_kriteria,
            'pembobotan_kriteria' => $pembobotan_kriteria,
        ];

        //Memvalidasi data baru yg diisi (apakah data sudah ada sebelumnya)
        $data_exist = Kriteria::where($data_baru)->exists(); 

        if($data_exist){
            return back()->withInput()->with('failed', 'Data sudah ada, silahkan input data yang berbeda!');
        }else {
            Kriteria::create($kriteria);
            return redirect('/kriteria')->with('success', 'Data baru berhasil ditambahkan');
        }
    }

    // public function update(Request $request, Kriteria $id){
    //     $rules = ([
    //         'kode' => 'required',
    //         'nama' => 'required|min:3|max:255',
    //         'jenis' => 'required',
    //         'bobot_kriteria' => 'required',
    //         'pembobotan_kriteria' => 'required',
    //     ]);
        
    //     $validated = $request->validate($rules);

    //     //Memvalidasi data baru yg diisi (apakah data sudah ada sebelumnya)
    //     $data_exist = Kriteria::where($validated)->exists();

    //     $data = [
    //         ['id','=', $request->id],
    //         ['kode','=', $request->kode],
    //         ['nama','=', $request->nama],
    //         ['jenis','=', $request->jenis],
    //         ['bobot_kriteria','=', $request->bobot_kriteria],
    //         ['pembobotan_kriteria','=', $request->pembobotan_kriteria]
    //     ];

    //     //Kalo data sama dengan data sebelum diedit maka akan terupdate
    //     $same_data = Kriteria::where($data)->exists();

    //     if($data_exist && $same_data){
    //         return back()->withInput()->with('failed', 'Data sudah ada, silahkan input data yang berbeda!');
    //     }else {
    //         Kriteria::where('id', $id->id)
    //                 ->update($validated);
    //         return redirect('/kriteria')->with('success', 'Data berhasil diubah');
    //     }
    // }
}
