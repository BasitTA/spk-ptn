<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\NilaiSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request){
        return view('konten.kriteria.create',[
            'active' => 3,
            'title' => 'Tambah Kriteria Baru',
            'user' => Auth::user(),
            'jenis' => [
                0 => 'Benefit',
                1 => 'Cost'
            ],
            'jml_pilihan' => 4,
            'jml_kriteria_baru' => 1,
            'jml_kriteria' => count(Kriteria::all()),
            'kriterias' => Kriteria::all()
        ]);
    }

    public function edit(Kriteria $id){
        return view('konten.kriteria.edit',[
            'active' => 3,
            'title' => 'Ubah Kriteria',
            'pilihan_jenis' => [
                0 => 'Benefit',
                1 => 'Cost'
            ],
            'user' => Auth::user(),
            'kriterias' => Kriteria::all(),
            'jml_pilihan' => 4,
        ]);
    }

    public function store(Request $request){
        $kriterias = Kriteria::all();
        $jml_pembobotan_kriteria=4;
        $jml_id = count($kriterias);
        $pilihan = [];
        $bobot = [];
        $kriteria = [];
        // dd(count($request->nama));
        if($request->nama == null ){
            return redirect('/kriteria/kriteriabaru')->with('failed', 'Data kosong silahkan input data terlebih dahulu');
            // return back()->withInput()->with('failed', 'Data sudah ada, silahkan input data yang berbeda!');
        }else {
            // dd(count($request->nama));
            for($a=0;$a<count($request->nama);$a++){
                //pilihan
                for($b=0;$b<$jml_pembobotan_kriteria;$b++){
                    $pilihan[$a][$b] = $request->pilihan[$b][$a]; 
                }
                //bobot
                for($b=0;$b<$jml_pembobotan_kriteria;$b++){
                    $bobot[$a][$b] = (int)$request->bobot[$b][$a]; 
                }
                $kode[$a] =  $request->kode[$a];
                $nama[$a] =  $request->nama[$a];
                $jenis[$a] =  $request->jenis[$a];
                $bobot_kriteria[$a] =  $request->bobot_kriteria[$a];
            }
    
            $arr = [[]];
    
            for($a=0;$a<count($request->nama);$a++){
                for($b=0;$b<$jml_pembobotan_kriteria;$b++){
                    //Merubah pilihan dan bobot ke dalam sebuah array
                    $arr[$a][$b] = [
                        "pilihan" => $pilihan[$a][$b],
                        "bobot" => $bobot[$a][$b],
                    ];
                }
                $json[$a] =  ($arr[$a]);
                // $json_decode[$a] = htmlspecialchars(json_encode($arr[$a]), ENT_QUOTES, 'UTF-8');
                //kriteria
                $kriteria[$a] = [
                    'kode' => $kode[$a],
                    'nama' => $nama[$a],
                    'jenis' => $jenis[$a],
                    'bobot_kriteria' => (float)$bobot_kriteria[$a],
                    'pembobotan_kriteria' => $json[$a]
                ];
            }
            $newKriteria = new Kriteria;
    
            for($a=0;$a<count($request->nama);$a++){
                $newKriteria->id = $jml_id+1;
                $newKriteria->kode = $kode[$a];
                $newKriteria->nama = $nama[$a];
                $newKriteria->jenis = $jenis[$a];
                $newKriteria->bobot_kriteria = (float)$bobot_kriteria[$a];
                $newKriteria->pembobotan_kriteria = $kriteria[$a]['pembobotan_kriteria'];
                $newKriteria->save();
            }
            NilaiSiswa::truncate();
            return redirect('/kriteria')->with('success', 'Data berhasil diubah');
        }

        return redirect('/kriteria')->with('success', 'Data berhasil diubah');
    }

    public function update(Request $request, Kriteria $id){
        // dd($kriteria);
        
        $kriterias = Kriteria::all();
        $jml_pembobotan_kriteria=4;
        $jml_kriteria=count($kriterias);

        $pilihan = [];
        $bobot = [];
        $kriteria = [];

        // dd($request->id);

        for($a=0;$a<$jml_kriteria;$a++){
            //pilihan
            for($b=0;$b<$jml_pembobotan_kriteria;$b++){
                $pilihan[$a][$b] = $request->pilihan[$b][$a]; 
            }
            //bobot
            for($b=0;$b<$jml_pembobotan_kriteria;$b++){
                $bobot[$a][$b] = (int)$request->bobot[$b][$a]; 
            }
            
            $id[$a] = $request->id[$a];
            $kode[$a] =  $request->kode[$a];
            $nama[$a] =  $request->nama[$a];
            $jenis[$a] =  $request->jenis[$a];
            $bobot_kriteria[$a] =  $request->bobot_kriteria[$a];
        }

        $arr = [[]];

        for($a=0;$a<$jml_kriteria;$a++){
            for($b=0;$b<$jml_pembobotan_kriteria;$b++){
                //Merubah pilihan dan bobot ke dalam sebuah array
                $arr[$a][$b] = [
                    "pilihan" => $pilihan[$a][$b],
                    "bobot" => $bobot[$a][$b],
                ];
            }
            $json[$a] =  ($arr[$a]);
            // $json_decode[$a] = htmlspecialchars(json_encode($arr[$a]), ENT_QUOTES, 'UTF-8');
            //kriteria
            $kriteria[$a] = [
                'id' => (int)$id[$a],
                'kode' => $kode[$a],
                'nama' => $nama[$a],
                'jenis' => $jenis[$a],
                'bobot_kriteria' => (float)$bobot_kriteria[$a],
                'pembobotan_kriteria' => $json[$a]
            ];
        }

        for($a=0;$a<$jml_kriteria;$a++){
            $kriterias[$a]->kode = $kode[$a];
            $kriterias[$a]->nama = $nama[$a];
            $kriterias[$a]->jenis = $jenis[$a];
            $kriterias[$a]->bobot_kriteria = (float)$bobot_kriteria[$a];
            $kriterias[$a]->pembobotan_kriteria = $kriteria[$a]['pembobotan_kriteria'];
            $kriterias[$a]->save();
        }

        return redirect('/kriteria')->with('success', 'Data berhasil diubah');
    }
}
