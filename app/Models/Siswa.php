<?php

namespace App\Models;

class Siswa{
    private static $data_siswas = [
        [
            "id" => "1",
            "nama" => "Basit",
            "jk" => "L",
            "ttl" => "Tangerang, 16/06/2003",
            "alamat" => "Jl. Makmur Sentosa, Indonesia"
        ],
        [
            "id" => "2",
            "nama" => "Bunga",
            "jk" => "P",
            "ttl" => "Jakarta, 15/04/2003",
            "alamat" => "Jl. Makmur Sejahtera, Indonesia"
        ],
        [
            "id" => "3",
            "nama" => "Abdul",
            "jk" => "L",
            "ttl" => "Bekasi, 16/06/2003",
            "alamat" => "Jl. Suka Maju, Indonesia"
        ],
    ];

    public static function all(){
        return collect(self::$data_siswas);
    }

    public static function find($id){
        $siswa = static::all();
        return $siswa->firstwhere('id', $id);
    }
}
