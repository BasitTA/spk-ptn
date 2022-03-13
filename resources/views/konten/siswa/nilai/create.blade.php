@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-block col-lg-10 px-4 py-4">
        {{-- Alert berhasil --}}
        @if (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="border rounded-3 px-3 py-3">
            {{-- Header --}}
            <div class="mb-3">
                <h3 class="mb-0">Tambah Nilai Siswa</h3>
                <a href="/nilaisiswa" class="text-decoration-none">Nilai Siswa ></a>
                <a href="/nilaisiswa/nilaibaru" class="text-decoration-none"> Nilai Baru</a>
            </div>

            {{-- FORM NILAI SISWA BARU --}}
            <form method="post" action="/nilaisiswa/nilaibaru">
                @csrf
                {{-- FORM NAMA SISWA --}}
                <div class="mb-3">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <select name="nilai_siswa_id" id="nilai_siswa_id" class="form-control form-control-sm @error('nilai_siswa_id') is-invalid @enderror" required>
                            <option hidden disabled selected value="">-- Pilih Nama Siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->nilai_siswa_id }}" @if(old('nilai_siswa_id') == '{{ $siswa->nilai_siswa_id }}') selected="selected" @endif>{{ $siswa->nama }} ({{ $siswa->tanggal_lahir }})</option>
                            @endforeach
                        </select>

                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- FORM PENILAIAN --}}
                @foreach ($kriterias as $kriteria)
                    <div class="mb-3">
                        <label for="kriteria" class="form-label">{{ $kriteria->nama }} ({{ $kriteria->kode }})</label>
                        <div class="form-group">
                            @foreach ($kriteria['pembobotan_kriteria'] as $pembobotan)
                                <div class="ms-3 form-check form-check-inline">
                                    <input name="{{ $kriteria->kode }}" id="kriteria" class="form-check-input @error('{{ $kriteria->kode }}') is-invalid @enderror" type="radio" value="{{ $pembobotan['bobot'] }}" required>
                                    <label class="form-check-label" for="{{ $kriteria->kode }}">{{ $pembobotan['pilihan'] }}</label>
                                </div>
                                @error('{{ $kriteria->kode }}')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endforeach
                            <br>
                        </div>
                    </div>
                @endforeach
                
                {{-- @foreach ($kriterias as $kriteria)
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="kriteria" class="form-label">{{ $kriteria->nama }}
                                (<strong><i>{{ $kriteria->kode }}</i></strong>)</label>
                            <select class="form-control form-control-sm" id="kriteria" name="kriteria" required>
                                <option hidden disabled selected value>-- Pilih Nilai --</option> --}}
                {{-- <option>{{ $kriterias[0]['pembobotan_kriteria'][0]['pilihan']}}</option> --}}
                {{-- @foreach ($kriteria['pembobotan_kriteria'] as $pembobotan)
                                    <option>{{ $pembobotan['pilihan'] }}</option>
                                @endforeach --}}
                {{-- nanti ganti ke radio buttonn biar lebih efisien --}}
                {{-- </select>
                        </div>
                    </div>
                @endforeach --}}


                <button class="btn btn-sm btn-success">
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
