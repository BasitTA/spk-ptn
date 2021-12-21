@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-block col-lg-10 px-3 py-4">
        <div class="border rounded-3 px-3 py-3">
            {{-- Header --}}
            <div class="mb-3">
                <h3 class="mb-0">{{ $siswas->nama }}</h3>
                <a href="/siswa" class="text-decoration-none">Data Siswa ></a>
                <a href="" class="text-decoration-none"> {{ $siswas->id }}</a>
            </div>

            {{-- Form --}}
            <div class="">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control form-control-sm" id="nama" placeholder="{{ $siswas->nama }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control form-control-sm" id="jk" placeholder="{{ $siswas->jk }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control form-control-sm" id="tempat_lahir" placeholder="{{ $siswas->tempat_lahir }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="text" class="form-control form-control-sm" id="tanggal_lahir" placeholder="{{ $siswas->tanggal_lahir }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control form-control-sm text-secondary" id="alamat" rows="3"
                        disabled>{{ $siswas->alamat }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
