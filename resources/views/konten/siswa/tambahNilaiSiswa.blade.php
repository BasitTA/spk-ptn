@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-block col-lg-10 px-4 py-4">
        {{-- Header --}}
        <div class="mb-3">
            <h3 class="mb-0">Tambah Nilai Siswa</h3>
            <a href="/siswa" class="text-decoration-none">Data Siswa ></a>
            <a href="/siswa/nilaisiswa" class="text-decoration-none"> Tambah Nilai Siswa ></a>
        </div>

        <form action="">
            {{-- FORM NAMA SISWA --}}
            <div class="mb-3">
                <div class="form-group">
                    <label for="name-selection" class="form-label">Nama Siswa</label>
                    <select class="form-control form-control-sm" id="name-selection">
                        <option value="" disabled selected hidden>-- Pilih Nama Siswa --</option>
                        @foreach ($siswas as $siswa)
                            <option>{{ $siswa->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- FORM PENILAIAN --}}
            @foreach ($kriterias as $kriteria)
                <div class="mb-3">
                    <div class="form-group">
                        <label for="c1-selection" class="form-label">{{ $kriteria->nama }}
                            (<strong><i>{{ $kriteria->kode }}</i></strong>)</label>
                        <select class="form-control form-control-sm" id="c1-selection">
                            <option value="" disabled selected hidden>-- Pilih Nilai --</option>
                            {{-- <option>{{ $kriterias[0]['pembobotan_kriteria'][0]['pilihan']}}</option> --}}
                            @foreach ($kriteria['pembobotan_kriteria'] as $pembobotan)
                                <option>{{ $pembobotan['pilihan'] }}</option>
                            @endforeach
                            {{-- nanti ganti ke radio buttonn biar lebih efisien --}}
                        </select>
                    </div>
                </div>
            @endforeach

            <button class="btn btn-sm btn-success">
                Simpan
            </button>
        </form>

        <a href="/">Kembali</a>
    </div>
@endsection
