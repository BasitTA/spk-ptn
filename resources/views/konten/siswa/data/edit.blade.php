@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-block col-lg-10 px-3 py-4">
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
                <h3 class="mb-0">Ubah Data Siswa</h3>
                <a href="/siswa" class="text-decoration-none">Data Siswa ></a>
                <a href="/siswa/{{ $siswa->id }}/edit" class="text-decoration-none"> {{ $siswa->id }}</a>
            </div>

            {{-- Form --}}
            <form class="mx-0 my-0" method="post" action="/siswa/{{ $siswa->id }}">
                @method('put')
                @csrf
                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input value="{{ old('nama', $siswa->nama) }}" type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" required>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div class="mb-3">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control form-control-sm @error('jk') is-invalid @enderror" required>
                        <option selected hidden value="{{ old('jk', $siswa->jk) }}">{{ $siswa->jk }}</option>
                        @foreach ($jk as $jk)
                            <option value="{{ old('jk', $jk) }}">{{ $jk }}</option>
                        @endforeach
                    </select>
                    @error('jk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Tempat Lahir --}}
                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" type="text" class="form-control form-control-sm @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                    @error('tempat_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Tanggal Lahir --}}
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" type="text" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control form-control-sm @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Alamat" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-sm btn-success">Simpan Data</button>
            </form>
        </div>
    </div>
@endsection
