<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiSiswa;
use App\Models\Kriteria;
use App\Models\SawTopsis;
use App\Models\Kuota;
use Illuminate\Support\Facades\Auth;

class HasilController extends Controller
{
    // static function init(){
    //     $nilai_siswa = NilaiSiswa::all();
    //     $kriteria = Kriteria::all();
    // }

    private $maxX, $minX, $normalisasi_matriks_r, $normalisasi_matriks_terbobot_y, $solusi_ideal_positif, $solusi_ideal_negatif, $jarak_terbobot_a_positif, $jarak_terbobot_a_negatif, $nilai_preferensi, $hasil_perangkingan = array();
    private $nilai_siswa, $kriteria, $saw_topsis;

    private function main(){
        $this->data();
        if($this->nilai_siswa->count()>1 && $this->kriteria->count()){  
            $this->hitungMaxX();
            $this->hitungMinX();
            $this->normalisasiMatriksR();
            //TOPSIS
            $this->normalisasiMatriksTerbobotY();
            $this->hitungSolusiIdealPositif();
            $this->hitungSolusiIdealNegatif();
            $this->hitungJarakTerbobotAPositif();
            $this->hitungJarakTerbobotANegatif();
            $this->hitungNilaiPreferensi();
            $this->transposer();
            $this->rounder();
            $this->storeHasilPerhitungan();
            $this->sortPerangkingan();
            // dd("max",$this->maxX, "normalisasi matriks r",$this->normalisasi_matriks_r, "normalisasi matriks terbobot y",$this->normalisasi_matriks_terbobot_y, "solusi ideal positif",$this->solusi_ideal_positif, "solusi ideal negatif",$this->solusi_ideal_negatif, "jarak terbobot alternatif positif",$this->jarak_terbobot_a_positif, "jarak terbobot alternatif negatif",$this->jarak_terbobot_a_negatif, "nilai preferensi",$this->nilai_preferensi);
        }else{
            return redirect('/hasilperhitungan')->with('failed', 'Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
        // dd($this->nilai_preferensi);
    }

    public function store(Request $request){
        $rules = [
            'kuota' => 'required',
        ];

        $validated = $request->validate($rules);
        Kuota::truncate();
        Kuota::create($validated);
        return redirect('/hasilperhitungan')->with('success', 'Kuota berhasil ditambahkan');
    }

    public function index(){
        $this->main();
        return view('konten.hasil perhitungan.index',[
            'active' => 4,
            'title' => 'Hasil Perhitungan',
            'user' => Auth::user(),
            'kuota' => Kuota::all(),
            'nilai_siswas' => NilaiSiswa::all(),
            'jml_kriteria' => count(Kriteria::all()),
            'hasil_perangkingan' => $this->hasil_perangkingan,
            'normalisasi_matriks_r' => $this->normalisasi_matriks_r,
            'normalisasi_matriks_terbobot_y' => $this->normalisasi_matriks_terbobot_y,
            'solusi_ideal_positif' => $this->solusi_ideal_positif,
            'solusi_ideal_negatif' => $this->solusi_ideal_negatif,
            'jarak_terbobot_a_positif' => $this->jarak_terbobot_a_positif,
            'jarak_terbobot_a_negatif' => $this->jarak_terbobot_a_negatif,
            'nilai_preferensi' => $this->nilai_preferensi
        ]);
    }

    public function print(){
        $this->main();
        return view('konten.hasil perhitungan.print',[
            'active' => 4,
            'title' => 'Cetak Hasil Perhitungan',
            'user' => Auth::user(),
            'kuota' => Kuota::all(),
            'nilai_siswas' => NilaiSiswa::all(),
            'hasil_perangkingan' => $this->hasil_perangkingan,
            'normalisasi_matriks_r' => $this->normalisasi_matriks_r,
            'normalisasi_matriks_terbobot_y' => $this->normalisasi_matriks_terbobot_y,
            'solusi_ideal_positif' => $this->solusi_ideal_positif,
            'solusi_ideal_negatif' => $this->solusi_ideal_negatif,
            'jarak_terbobot_a_positif' => $this->jarak_terbobot_a_positif,
            'jarak_terbobot_a_negatif' => $this->jarak_terbobot_a_negatif,
            'nilai_preferensi' => $this->nilai_preferensi
        ]);
    }

    private function data(){
        $this->nilai_siswa = NilaiSiswa::all();
        $this->kriteria = Kriteria::all();
        $this->saw_topsis = SawTopsis::all();
    }

    function transpose($array){
        array_unshift($array, null);
        return call_user_func_array('array_map', $array);
    }
    
    function rounded($numbers){
        return array_map(function($v) { return round($v, 3); }, $numbers);
    }

    //transpose array/matriks
    private function transposer(){
        $this->normalisasi_matriks_r = $this->transpose($this->normalisasi_matriks_r);
        $this->normalisasi_matriks_terbobot_y = $this->transpose($this->normalisasi_matriks_terbobot_y);
    }

    //pembulatan bilangan 2 angka desimal
    private function rounder(){
        $x = count($this->normalisasi_matriks_r);
        for ($i=0 ; $i<$x ; $i++) { 
            $this->normalisasi_matriks_r[$i] = $this->rounded($this->normalisasi_matriks_r[$i]);
        }

        $y = count($this->normalisasi_matriks_terbobot_y);
        for ($i=0 ; $i<$y ; $i++) { 
            $this->normalisasi_matriks_terbobot_y[$i] = $this->rounded($this->normalisasi_matriks_terbobot_y[$i]);
        }
        
        $this->solusi_ideal_positif = $this->rounded($this->solusi_ideal_positif);
        $this->solusi_ideal_negatif = $this->rounded($this->solusi_ideal_negatif);
        $this->jarak_terbobot_a_positif = $this->rounded($this->jarak_terbobot_a_positif);
        $this->jarak_terbobot_a_negatif = $this->rounded($this->jarak_terbobot_a_negatif);
        $this->nilai_preferensi = $this->rounded($this->nilai_preferensi);
    }

    private function storeHasilPerhitungan(){
        $nilai_siswa = $this->nilai_siswa;
        $kriteria = $this->kriteria;
        $saw_topsis = $this->saw_topsis;

        SawTopsis::truncate();
        $x = 0;

        foreach ($nilai_siswa as $ns){
            $saw_topsis_id = $ns->id;
            SawTopsis::create([
                'id' => $saw_topsis_id,
                'nama' => $nilai_siswa[$x]->nama,
                'normalisasi_matriks_r' => $this->normalisasi_matriks_r[$x],
                'normalisasi_matriks_y' => $this->normalisasi_matriks_terbobot_y[$x],
                'nilai_preferensi' => $this->nilai_preferensi[$x],
            ]);
            $x++;
        }
        // dd($this->saw_topsis);
    }

    private function sortPerangkingan(){
        $data_sorted = SawTopsis::orderBy('nilai_preferensi','desc')->get();
        $this->hasil_perangkingan = $data_sorted;
        // dd($data_sorted);
    }

    //SAW
    private function hitungMaxX(){
        //Array dynamic hitung max x
        $pilihan_by_id = array(array());
        $jml_kriteria = count(Kriteria::all());
        $max_x = array();

        if($this->nilai_siswa->count()>1){
            foreach($this->nilai_siswa as $ns){
                for($i=0;$i<$jml_kriteria;$i++){
                    $pilihan_by_id[$i][] = $ns['pilihan'][$i];
                    $max_x[$i] = max($pilihan_by_id[$i]);
                }
            };

            $this->maxX = $max_x;
            // dd($this->maxX);
        }else {
            // dd('Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
    }

    private function hitungMinX(){
        //Array dynamic hitung max x
        $pilihan_by_id = array(array());
        $jml_kriteria = count(Kriteria::all());
        $min_x = array();

        if($this->nilai_siswa->count()>1){
            foreach($this->nilai_siswa as $ns){
                for($i=0;$i<$jml_kriteria;$i++){
                    $pilihan_by_id[$i][] = $ns['pilihan'][$i];
                    $min_x[$i] = min($pilihan_by_id[$i]);
                }
            };

            $this->minX = $min_x;
            // dd($this->minX);
        }else {
            // dd('Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
    }

    private function normalisasiMatriksR(){
        $jml_kriteria = count(Kriteria::all());
        $jml_nilai_siswa = count(NilaiSiswa::all());
        $kriteria = Kriteria::all()->toArray();

        $pilihan_by_id = array(array());
        $normalisasi_matriks_r = array(array());

        $pilihan_benefit = array();
        $benefit = 'Benefit';
        
        $pilihan_cost = array();
        $cost = 'Cost';

        if($this->nilai_siswa->count()>1){  
            foreach($this->nilai_siswa as $ns){
                for($i=0;$i<$jml_kriteria;$i++){
                    $pilihan_by_id[$i][] = $ns['pilihan'][$i];
                }
            }

            for($p=0;$p<$jml_kriteria;$p++){
                if($kriteria[$p]['jenis']=="Benefit"){
                    $pilihan_benefit[$p] = $pilihan_by_id[$p];
                }
            }
            for($p=0;$p<$jml_kriteria;$p++){
                if($kriteria[$p]['jenis']=="Cost"){
                    $pilihan_cost[$p] = $pilihan_by_id[$p];
                }
            }

            $b = 0;
            $c = 0;
            foreach($pilihan_benefit as $key=>$value){
                for($j=0;$j<$jml_nilai_siswa;$j++){
                    $normalisasi_matriks_r[$key][$j] = $pilihan_by_id[$key][$j]/$this->maxX[$key];
                    $b++;
                }
            }
            foreach($pilihan_cost as $key=>$value){
                for($j=0;$j<$jml_nilai_siswa;$j++){
                    $normalisasi_matriks_r[$key][$j] = $this->minX[$key]/$pilihan_by_id[$key][$j];
                    $c++;
                }
            }
            ksort($normalisasi_matriks_r);
            $this->normalisasi_matriks_r = $normalisasi_matriks_r;
            // dd($this->normalisasi_matriks_r);
        }else {
            echo('Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
    }

    //TOPSIS
    private function normalisasiMatriksTerbobotY(){
        // dd($this->kriteria);
        $jml_kriteria = count(Kriteria::all());
        $jml_nilai_siswa = count(NilaiSiswa::all());
        $normalisasi_matriks_r = $this->normalisasi_matriks_r;
        // dd($normalisasi_matriks_r);

        if($this->nilai_siswa->count()>1){
            for($i=0;$i<$jml_kriteria;$i++){
                $bobot[$i] = $this->kriteria[$i]->bobot_kriteria;
            }
            for($i=0;$i<$jml_kriteria;$i++){
                for($j=0;$j<$jml_nilai_siswa;$j++){
                    $normalisasi_matriks_terbobot_y[$i][$j] = $normalisasi_matriks_r[$i][$j]*$bobot[$i];
                }
            }
        }

        $this->normalisasi_matriks_terbobot_y = $normalisasi_matriks_terbobot_y;
    }

    private function hitungSolusiIdealPositif(){
        $solusi_ideal_positif = array();
        $jml_kriteria = count(Kriteria::all());

        if($this->nilai_siswa->count()>1){
            for($i=0;$i<$jml_kriteria;$i++){
                $solusi_ideal_positif[$i] = max($this->normalisasi_matriks_terbobot_y[$i]);
            }
            $this->solusi_ideal_positif = $solusi_ideal_positif;
        }else {
            echo('Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
    }

    private function hitungSolusiIdealNegatif(){
        $solusi_ideal_negatif = array();
        $jml_kriteria = count(Kriteria::all());

        if($this->nilai_siswa->count()>1){
            for($i=0;$i<$jml_kriteria;$i++){
                $solusi_ideal_negatif[$i] = min($this->normalisasi_matriks_terbobot_y[$i]);
            }
            $this->solusi_ideal_negatif = $solusi_ideal_negatif;
        }else {
            echo('Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
    }

    private function hitungJarakTerbobotAPositif(){
        $normalisasi_matriks_terbobot_y = $this->normalisasi_matriks_terbobot_y;
        $solusi_ideal_positif = $this->solusi_ideal_positif;
        
        for ($i=0; $i < $this->nilai_siswa->count(); $i++) {
            $total_kuadrat = 0;
            for($j=0;$j<count($solusi_ideal_positif);$j++){
                $total_kuadrat += pow(($solusi_ideal_positif[$j]-$normalisasi_matriks_terbobot_y[$j][$i]),2);
            }
            $this->jarak_terbobot_a_positif[]= sqrt($total_kuadrat);
        }
        // dd($this->jarak_terbobot_a_positif);
    }

    
    private function hitungJarakTerbobotANegatif(){
        $normalisasi_matriks_terbobot_y = $this->normalisasi_matriks_terbobot_y;
        $solusi_ideal_negatif = $this->solusi_ideal_negatif;
        
        for ($i=0; $i < $this->nilai_siswa->count(); $i++) {
            $total_kuadrat = 0;
            for($j=0;$j<count($solusi_ideal_negatif);$j++){
                $total_kuadrat += pow(($normalisasi_matriks_terbobot_y[$j][$i])-$solusi_ideal_negatif[$j],2);
            }
            $this->jarak_terbobot_a_negatif[]= sqrt($total_kuadrat);
        }
    }

    private function hitungNilaiPreferensi(){
        for ($i=0; $i < $this->nilai_siswa->count(); $i++) { 
            $this->nilai_preferensi[$i] = $this->jarak_terbobot_a_negatif[$i]/($this->jarak_terbobot_a_negatif[$i]+$this->jarak_terbobot_a_positif[$i]);
        }
    }
}
