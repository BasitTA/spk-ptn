<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model{

    use HasFactory;

    protected $guarded = ['id'];

    protected$casts = [
        'pembobotan_kriteria' => 'array'
    ];

    // static $data_kriterias = [
    //     [
    //         "kode" => "C1",
    //         "nama" => "Bacaan Quran",
    //         "pembobotan_kriteria" => [
    //             [
    //                 "pilihan" => "90-100",
    //                 "bobot" => "4" 
    //             ],
    //             [
    //                 "pilihan" => "80-89",
    //                 "bobot" => "3" 
    //             ],
    //             [
    //                 "pilihan" => "65-79",
    //                 "bobot" => "2" 
    //             ],
    //             [
    //                 "pilihan" => "0-64",
    //                 "bobot" => "1" 
    //             ],
    //         ],
    //     ],
    //     [
    //         "kode" => "C2",
    //         "nama" => "Hafalan Quran",
    //         "pembobotan_kriteria" => [
    //             [
    //                 "pilihan" => "90-100",
    //                 "bobot" => "4" 
    //             ],
    //             [
    //                 "pilihan" => "80-89",
    //                 "bobot" => "3" 
    //             ],
    //             [
    //                 "pilihan" => "65-79",
    //                 "bobot" => "2" 
    //             ],
    //             [
    //                 "pilihan" => "0-64",
    //                 "bobot" => "1" 
    //             ],
    //         ],
    //     ],
    //     [
    //         "kode" => "C3",
    //         "nama" => "Bacaan Shalat",
    //         "pembobotan_kriteria" => [
    //             [
    //                 "pilihan" => "90-100",
    //                 "bobot" => "4" 
    //             ],
    //             [
    //                 "pilihan" => "80-89",
    //                 "bobot" => "3" 
    //             ],
    //             [
    //                 "pilihan" => "65-79",
    //                 "bobot" => "2" 
    //             ],
    //             [
    //                 "pilihan" => "0-64",
    //                 "bobot" => "1" 
    //             ],
    //         ],
    //     ],
    //     [
    //         "kode" => "C4",
    //         "nama" => "Tes Kepribadian",
    //         "pembobotan_kriteria" => [
    //             [
    //                 "pilihan" => "90-100",
    //                 "bobot" => "4" 
    //             ],
    //             [
    //                 "pilihan" => "80-89",
    //                 "bobot" => "3" 
    //             ],
    //             [
    //                 "pilihan" => "65-79",
    //                 "bobot" => "2" 
    //             ],
    //             [
    //                 "pilihan" => "0-64",
    //                 "bobot" => "1" 
    //             ],
    //         ],
    //     ],
    //     [
    //         "kode" => "C5",
    //         "nama" => "Penghasilan Orang Tua",
    //         "pembobotan_kriteria" => [
    //             [
    //                 "pilihan" => "< 1 JT",
    //                 "bobot" => "4" 
    //             ],
    //             [
    //                 "pilihan" => "1 JT - < 4.2 JT",
    //                 "bobot" => "3" 
    //             ],
    //             [
    //                 "pilihan" => "4.2 JT - 10 JT",
    //                 "bobot" => "2" 
    //             ],
    //             [
    //                 "pilihan" => "> 10 JT",
    //                 "bobot" => "1" 
    //             ],
    //         ],
    //     ],
    //     [
    //         "kode" => "C6",
    //         "nama" => "Status",
    //         "pembobotan_kriteria" => [
    //             [
    //                 "pilihan" => "Yatim & Piatu",
    //                 "bobot" => "4" 
    //             ],
    //             [
    //                 "pilihan" => "Yatim",
    //                 "bobot" => "3" 
    //             ],
    //             [
    //                 "pilihan" => "Piatu",
    //                 "bobot" => "2" 
    //             ],
    //             [
    //                 "pilihan" => "Orang Tua Lengkap",
    //                 "bobot" => "1" 
    //             ],
    //         ],
    //     ],
        // [
        //     "nama" => "Basit",
        //     "c1" => "91",
        //     "c2" => "90",
        //     "c3" => "82",
        //     "c4" => "88",
        //     "c5" => "93",
        //     "c6" => "87",
        // ],
        // [
        //     "nama" => "Bunga",
        //     "c1" => "81",
        //     "c2" => "90",
        //     "c3" => "86",
        //     "c4" => "80",
        //     "c5" => "87",
        //     "c6" => "89",
        // ],
        // [
        //     "nama" => "Abdul",
        //     "c1" => "71",
        //     "c2" => "80",
        //     "c3" => "87",
        //     "c4" => "89",
        //     "c5" => "90",
        //     "c6" => "92",
        // ],
    // ];

    // public static function all(){
    //     return self::$data_kriterias;
    // } 
}
