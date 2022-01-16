<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiSiswa;
use App\Models\Kriteria;
use App\Models\SawTopsis;

class HasilController extends Controller
{
    // static function init(){
    //     $nilai_siswa = NilaiSiswa::all();
    //     $kriteria = Kriteria::all();
    // }

    protected $maksX, $normalisasi_matriks_r, $normalisasi_matriks_terbobot_y, $solusi_ideal_positif, $solusi_ideal_negatif, $jarak_terbobot_a_positif, $jarak_terbobot_a_negatif, $nilai_preferensi = array();
    protected $nilai_siswa, $kriteria, $saw_topsis;

    function data(){
        $this->nilai_siswa = NilaiSiswa::all();
        $this->kriteria = Kriteria::all();
    }


    function transpose($array){
        array_unshift($array, null);
        return call_user_func_array('array_map', $array);
    }
    
    function rounded($numbers){
        return array_map(function($v) { return round($v, 2); }, $numbers);
    }

    //transpose array/matriks
    function transposer(){
        $this->normalisasi_matriks_r = $this->transpose($this->normalisasi_matriks_r);
        $this->normalisasi_matriks_terbobot_y = $this->transpose($this->normalisasi_matriks_terbobot_y);
    }

    //pembulatan bilangan 2 angka desimal
    function rounder(){
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


    function main(){
        $this->data();
        if($this->nilai_siswa->count() && $this->kriteria->count()){  
            $this->hitungMaksX();
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
            // dd("maks",$this->maksX, "normalisasi matriks r",$this->normalisasi_matriks_r, "normalisasi matriks terbobot y",$this->normalisasi_matriks_terbobot_y, "solusi ideal positif",$this->solusi_ideal_positif, "solusi ideal negatif",$this->solusi_ideal_negatif, "jarak terbobot alternatif positif",$this->jarak_terbobot_a_positif, "jarak terbobot alternatif negatif",$this->jarak_terbobot_a_negatif, "nilai preferensi",$this->nilai_preferensi);
        }else{
            echo('Data nilai siswa masih kosong');
        }

        // dd($this->nilai_preferensi);
    }

    //SAW
    function hitungMaksX(){
        //p = pilihan
        $p1 = $p2 = $p3 = $p4 = $p5 = $p6 = array();

        if($this->nilai_siswa->count()>1){
            // dd($this->nilai_siswa->count());
            foreach($this->nilai_siswa as $ns){
                $p1[] = $ns['pilihan'][0];
                $p2[] = $ns['pilihan'][1];
                $p3[] = $ns['pilihan'][2];
                $p4[] = $ns['pilihan'][3];
                $p5[] = $ns['pilihan'][4];
                $p6[] = $ns['pilihan'][5];
            };

            $this->maksX = [
                max($p1),
                max($p2),
                max($p3),
                max($p4),
                max($p5),
                max($p6)
            ];

            // dd($this->maksX);
        }else {
            echo('Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
    }

    function normalisasiMatriksR(){
        $normalisasi_matriks_r1 = $normalisasi_matriks_r2= $normalisasi_matriks_r3= $normalisasi_matriks_r4= $normalisasi_matriks_r5= $normalisasi_matriks_r6 = array();
    
        // dd($this->maksX);
        if($this->nilai_siswa->count()>1){
            // dd($this->nilai_siswa->count());
            foreach($this->nilai_siswa as $ns){
                $kriteria1[] = $ns['pilihan'][0];
                $kriteria2[] = $ns['pilihan'][1];
                $kriteria3[] = $ns['pilihan'][2];
                $kriteria4[] = $ns['pilihan'][3];
                $kriteria5[] = $ns['pilihan'][4];
                $kriteria6[] = $ns['pilihan'][5];
            };
            // dd($kriteria1);

            foreach($kriteria1 as $k1){
                $normalisasi_matriks_r1[] = $k1/$this->maksX[0];
            }
            foreach($kriteria2 as $k2){
                $normalisasi_matriks_r2[] = $k2/$this->maksX[1];
            }
            foreach($kriteria3 as $k3){
                $normalisasi_matriks_r3[] = $k3/$this->maksX[2];
            }
            foreach($kriteria4 as $k4){
                $normalisasi_matriks_r4[] = $k4/$this->maksX[3];
            }
            foreach($kriteria5 as $k5){
                $normalisasi_matriks_r5[] = $k5/$this->maksX[4];
            }
            foreach($kriteria6 as $k6){
                $normalisasi_matriks_r6[] = $k6/$this->maksX[5];
            }

            $this->normalisasi_matriks_r = [
                $normalisasi_matriks_r1,
                $normalisasi_matriks_r2,
                $normalisasi_matriks_r3,
                $normalisasi_matriks_r4,
                $normalisasi_matriks_r5,
                $normalisasi_matriks_r6
            ];
            // dd($this->normalisasi_matriks_r);
        }else {
            echo('Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
    }

    //TOPSIS
    function normalisasiMatriksTerbobotY(){

        $normalisasi_matriks_terbobot_y1 = $normalisasi_matriks_terbobot_y2 = $normalisasi_matriks_terbobot_y3 = $normalisasi_matriks_terbobot_y4 = $normalisasi_matriks_terbobot_y5 = $normalisasi_matriks_terbobot_y6 = array();
        $bobot = [
            $this->kriteria[0]->bobot_kriteria,
            $this->kriteria[1]->bobot_kriteria,
            $this->kriteria[2]->bobot_kriteria,
            $this->kriteria[3]->bobot_kriteria,
            $this->kriteria[4]->bobot_kriteria,
            $this->kriteria[5]->bobot_kriteria,
        ];

        $normalisasi_matriks_r1 = $this->normalisasi_matriks_r[0];
        $normalisasi_matriks_r2 = $this->normalisasi_matriks_r[1];
        $normalisasi_matriks_r3 = $this->normalisasi_matriks_r[2];
        $normalisasi_matriks_r4 = $this->normalisasi_matriks_r[3];
        $normalisasi_matriks_r5 = $this->normalisasi_matriks_r[4];
        $normalisasi_matriks_r6 = $this->normalisasi_matriks_r[5];
        
        if($this->nilai_siswa->count()>1){
            foreach($normalisasi_matriks_r1 as $normalisasi_matriks_r1){
                $normalisasi_matriks_terbobot_y1[] = $normalisasi_matriks_r1*$bobot[0];
            }
            foreach($normalisasi_matriks_r2 as $normalisasi_matriks_r2){
                $normalisasi_matriks_terbobot_y2[] = $normalisasi_matriks_r2*$bobot[1];
            }
            foreach($normalisasi_matriks_r3 as $normalisasi_matriks_r3){
                $normalisasi_matriks_terbobot_y3[] = $normalisasi_matriks_r3*$bobot[2];
            }
            foreach($normalisasi_matriks_r4 as $normalisasi_matriks_r4){
                $normalisasi_matriks_terbobot_y4[] = $normalisasi_matriks_r4*$bobot[3];
            }
            foreach($normalisasi_matriks_r5 as $normalisasi_matriks_r5){
                $normalisasi_matriks_terbobot_y5[] = $normalisasi_matriks_r5*$bobot[4];
            }
            foreach($normalisasi_matriks_r6 as $normalisasi_matriks_r6){
                $normalisasi_matriks_terbobot_y6[] = $normalisasi_matriks_r6*$bobot[5];
            }

            $this->normalisasi_matriks_terbobot_y = [
                $normalisasi_matriks_terbobot_y1,
                $normalisasi_matriks_terbobot_y2,
                $normalisasi_matriks_terbobot_y3,
                $normalisasi_matriks_terbobot_y4,
                $normalisasi_matriks_terbobot_y5,
                $normalisasi_matriks_terbobot_y6,
            ];
        }
            // dd($this->normalisasi_matriks_terbobot_y);
    }

    function hitungSolusiIdealPositif(){
        $solusi_ideal_positif1 = $solusi_ideal_positif2 = $solusi_ideal_positif3 = $solusi_ideal_positif4 = $solusi_ideal_positif5 = $solusi_ideal_positif6 = array();
        $solusi_ideal_positif = array();

        if($this->nilai_siswa->count()>1){

            $solusi_ideal_positif1 = max($this->normalisasi_matriks_terbobot_y[0]);
            $solusi_ideal_positif2 = max($this->normalisasi_matriks_terbobot_y[1]);
            $solusi_ideal_positif3 = max($this->normalisasi_matriks_terbobot_y[2]);
            $solusi_ideal_positif4 = max($this->normalisasi_matriks_terbobot_y[3]);
            $solusi_ideal_positif5 = max($this->normalisasi_matriks_terbobot_y[4]);
            $solusi_ideal_positif6 = max($this->normalisasi_matriks_terbobot_y[5]);

            $this->solusi_ideal_positif = [
                $solusi_ideal_positif1,
                $solusi_ideal_positif2,
                $solusi_ideal_positif3,
                $solusi_ideal_positif4,
                $solusi_ideal_positif5,
                $solusi_ideal_positif6,
            ];

            // dd($this->solusi_ideal_positif);
        }else {
            echo('Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
    }
    function hitungSolusiIdealNegatif(){

        $solusi_ideal_negatif1 = $solusi_ideal_negatif2 = $solusi_ideal_negatif3 = $solusi_ideal_negatif4 = $solusi_ideal_negatif5 = $solusi_ideal_negatif6 = array();
        $solusi_ideal_negatif = array();

        if($this->nilai_siswa->count()>1){

            $solusi_ideal_negatif1 = min($this->normalisasi_matriks_terbobot_y[0]);
            $solusi_ideal_negatif2 = min($this->normalisasi_matriks_terbobot_y[1]);
            $solusi_ideal_negatif3 = min($this->normalisasi_matriks_terbobot_y[2]);
            $solusi_ideal_negatif4 = min($this->normalisasi_matriks_terbobot_y[3]);
            $solusi_ideal_negatif5 = min($this->normalisasi_matriks_terbobot_y[4]);
            $solusi_ideal_negatif6 = min($this->normalisasi_matriks_terbobot_y[5]);

            $this->solusi_ideal_negatif = [
                $solusi_ideal_negatif1,
                $solusi_ideal_negatif2,
                $solusi_ideal_negatif3,
                $solusi_ideal_negatif4,
                $solusi_ideal_negatif5,
                $solusi_ideal_negatif6,
            ];

            // dd($this->solusi_ideal_negatif);
        }else {
            echo('Data tidak cukup, masukkan minimal 2 data nilai siswa');
        }
    }

    function hitungJarakTerbobotAPositif(){
        $normalisasi_matriks_terbobot_y = $this->normalisasi_matriks_terbobot_y;
        $solusi_ideal_positif = $this->solusi_ideal_positif;
        // $jarak_terbobot_a_positif1 = $jarak_terbobot_a_positif2 =$jarak_terbobot_a_positif3 = $jarak_terbobot_a_positif4 = $jarak_terbobot_a_positif5 = $jarak_terbobot_a_positif6 = null;
        
        // dd($normalisasi_matriks_terbobot_y, $solusi_ideal_positif);
        for ($i=0; $i < $this->nilai_siswa->count(); $i++) {
            $this->jarak_terbobot_a_positif[] = sqrt(pow(($solusi_ideal_positif[0]-$normalisasi_matriks_terbobot_y[0][$i]),2)+
            pow(($solusi_ideal_positif[1]-$normalisasi_matriks_terbobot_y[1][$i]),2)+
            pow(($solusi_ideal_positif[2]-$normalisasi_matriks_terbobot_y[2][$i]),2)+
            pow(($solusi_ideal_positif[3]-$normalisasi_matriks_terbobot_y[3][$i]),2)+
            pow(($solusi_ideal_positif[4]-$normalisasi_matriks_terbobot_y[4][$i]),2)+
            pow(($solusi_ideal_positif[5]-$normalisasi_matriks_terbobot_y[5][$i]),2));
        }
        // dd($this->jarak_terbobot_a_positif);
    }
    function hitungJarakTerbobotANegatif(){
        $normalisasi_matriks_terbobot_y = $this->normalisasi_matriks_terbobot_y;
        $solusi_ideal_negatif = $this->solusi_ideal_negatif;

        for ($i=0; $i < $this->nilai_siswa->count(); $i++) {     
            $this->jarak_terbobot_a_negatif[] = sqrt(pow(($normalisasi_matriks_terbobot_y[0][$i]-$solusi_ideal_negatif[0]),2)+
            pow(($normalisasi_matriks_terbobot_y[1][$i]-$solusi_ideal_negatif[1]),2)+
            pow(($normalisasi_matriks_terbobot_y[2][$i]-$solusi_ideal_negatif[2]),2)+
            pow(($normalisasi_matriks_terbobot_y[3][$i]-$solusi_ideal_negatif[3]),2)+
            pow(($normalisasi_matriks_terbobot_y[4][$i]-$solusi_ideal_negatif[4]),2)+
            pow(($normalisasi_matriks_terbobot_y[5][$i]-$solusi_ideal_negatif[5]),2));
        }

        // dd($this->jarak_terbobot_a_negatif);
    }

    function hitungNilaiPreferensi(){
        for ($i=0; $i < $this->nilai_siswa->count(); $i++) { 
            $this->nilai_preferensi[$i] = $this->jarak_terbobot_a_negatif[$i]/($this->jarak_terbobot_a_negatif[$i]+$this->jarak_terbobot_a_positif[$i]);
        }
    }

    public function index(){
        $this->main();
        return view('konten.hasil perhitungan.index',[
            'title' => 'Hasil Perhitungan',
            'nilai_siswas' => NilaiSiswa::all(),
            'normalisasi_matriks_r' => $this->normalisasi_matriks_r,
            'normalisasi_matriks_terbobot_y' => $this->normalisasi_matriks_terbobot_y,
            'solusi_ideal_positif' => $this->solusi_ideal_positif,
            'solusi_ideal_negatif' => $this->solusi_ideal_negatif,
            'jarak_terbobot_a_positif' => $this->jarak_terbobot_a_positif,
            'jarak_terbobot_a_negatif' => $this->jarak_terbobot_a_negatif,
            'nilai_preferensi' => $this->nilai_preferensi
        ]);
    }
}
