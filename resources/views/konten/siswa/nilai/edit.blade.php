@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-block col-lg-10 px-4 py-4">
        {{-- Header --}}
        <div class="mb-3">
            <h3 class="mb-0">Ubah Nilai Siswa</h3>
            <a href="/nilaisiswa" class="text-decoration-none">Nilai Siswa ></a>
            <a href="/nilaisiswa/{{ $nilai_siswa->id }}/edit" class="text-decoration-none"> {{ $nilai_siswa->nama }}</a>
        </div>

        {{-- FORM NILAI SISWA BARU --}}
        <form method="post" action="/nilaisiswa/{{ $nilai_siswa->id }}">
            @method('put')
            @csrf
            {{-- FORM NAMA SISWA --}}
            <div class="mb-3">
                <div class="form-group">
                    {{-- nama siswa --}}
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input value="{{ $nilai_siswa->nama}}" name="nama" id="nama" class="form-control form-control-sm" required hidden>
                    
                    {{-- ID nilai siswa --}}
                    <input value="{{ $nilai_siswa->id }}" name="id" id="id" hidden>
                    
                    {{-- nama & tgl lahir bayangan --}}
                    <input value="{{ $nilai_siswa->nama}} ({{ $tanggal_lahir }})" name="nama" id="nama" class="form-control form-control-sm" required disabled>
                </div>
            </div>

            {{-- FORM PENILAIAN --}}
            @foreach ($kriterias as $kriteria)
                <div class="mb-3">
                    <label for="kriteria" class="form-label">{{ $kriteria->nama }} ({{ $kriteria->kode }})</label>
                    <div class="form-group">
                        @foreach ($kriteria['pembobotan_kriteria'] as $pembobotan)
                            <div class="ms-3 form-check form-check-inline">
                                <input name="kriteria[{{ $kriteria->id }}]" id="{{ $kriteria->kode}}" class="form-check-input" type="radio" value="{{ $pembobotan['bobot']}}" {{ old('$kriteria->kode', $nilai_siswa['pilihan'][($kriteria->id)-1] ?? null) == $pembobotan['bobot'] ? 'checked' : ''}} required>
                                <label class="form-check-label" for="{{ $kriteria->kode }}">{{ $pembobotan['pilihan'] }}</label>
                            </div>
                        @endforeach
                        <br>
                    </div>
                </div>
            @endforeach

            <button class="btn btn-sm btn-success">
                Simpan
            </button>
        </form>
    </div>
@endsection
