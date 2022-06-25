<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
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
            'jml_pilihan' => 4,
            'jml_kriteria_baru' => 1,
            'kriterias' => Kriteria::all()
        ]);
    }

    public function edit(Kriteria $id){
        return view('konten.kriteria.edit',[
            'active' => 3,
            'title' => 'Ubah Kriteria',
            'user' => Auth::user(),
            'kriterias' => Kriteria::all(),
            'jml_pilihan' => 4,
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

    public function update(Request $request, Kriteria $id){
        // dd($kriteria);
        
        $kriterias = Kriteria::all();
        $jml_pembobotan_kriteria=4;
        $jml_kriteria=6;

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

            // $pembobotan_kriteria_array[$a] = array($pembobotan_kriteria[$a]);
            // Data Untuk di Upload
            // $data[$a] = [
            //     ['id','=', $kriteria[$a]['id']],
            //     ['kode','=',  $kriteria[$a]['kode']],
            //     ['nama','=', $kriteria[$a]['nama']],
            //     ['jenis','=', $kriteria[$a]['jenis']],
            //     ['bobot_kriteria','=', (float)$kriteria[$a]['bobot_kriteria']],
            //     ['pembobotan_kriteria','=', json_encode($kriteria[$a]['pembobotan_kriteria'])]
            // ];
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
        // dd($kriterias);
        // dd($kode, $nama, $jenis, $json, $pilihan, $bobot);
        // dd($kriteria);

        // dd(Kriteria::all());
        // dd($data);

// dd("done");
        //Untuk memvalidasi data yg diinput
        // $validated = Validator::make($data, [
        //     'id' => 'required',
        //     'kode' => 'required',
        //     'nama' => 'required|min:3|max:255',
        //     'jenis' => 'required',
        //     'bobot_kriteria' => 'required',
        //     'pembobotan_kriteria' => 'required',
        // ]);


        return redirect('/kriteria')->with('success', 'Data berhasil diubah');
        // $data = $data_exist;
        
        // if($data_exist && $same_data){
        //     return redirect('/kriteria')->with('success', 'Data berhasil diubah');
        //     return back()->withInput()->with('failed', 'Data sudah ada, silahkan input data yang berbeda!');
        // }else {
        //     Kriteria::update($data);
        //     return redirect('/kriteria')->with('success', 'Data berhasil diubah');
        // }
    }
}
