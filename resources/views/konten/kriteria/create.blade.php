@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-block col-lg-10 px-3 py-4">

        {{-- Alert gagal --}}
        @if (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="border rounded-3 px-3 py-3">
            {{-- Header --}}
            <div class="mb-3">
                <h3 class="mb-0">Tambah Kriteria Baru</h3>
                <a href="/kriteria" class="text-decoration-none">Kriteria ></a>
                <a href="/kriteria/kriteriabaru" class="text-decoration-none"> Kriteria Baru</a>
            </div>

            {{-- Form --}}
            <form class="mx-0 my-0" method="post" action="/kriteria/kriteriabaru">
                @csrf
                {{-- Kode --}}
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input value="{{ 'C' }}" type="text" class="disabled form-control form-control-sm @error('kode') is-invalid @enderror" id="kode" name="kode" required>
                    @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kriteria</label>
                    <input value="{{ old('nama') }}" type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" required>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Jenis --}}
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Kriteria</label>
                    <select name="jenis" id="jenis" class="form-control form-control-sm @error('jenis') is-invalid @enderror" required>
                        <option hidden disabled selected value="">-- Pilih Jenis Kriteria --</option>
                            <option value="Benefit">Benefit</option>
                            <option value="Cost">Cost</option>
                    </select>
                    @error('jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                {{-- Bobot Kriteria --}}
                <div class="mb-3">
                    <label for="bobot_kriteria" class="form-label">Bobot Kriteria</label>
                    <input value="{{ old('bobot_kriteria') }}" type="number" min="0.01" max="1" step="0.01" class="form-control form-control-sm @error('bobot_kriteria') is-invalid @enderror" id="bobot_kriteria" name="bobot_kriteria" placeholder="Bobot Kriteria" required>
                    @error('bobot_kriteria')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Pembobotan Kriteria --}}
                <div class="mb-3">
                    <label for="pembobotan_kriteria" class="form-label">Pembobotan Kriteria</label>
                    <div class="input-group">
                        <input value="{{ old('pilihan') }}" type="text" class="form-control form-control-sm @error('pilihan') is-invalid @enderror" id="pilihan" name="pilihan" placeholder="Pilihan" required>
                        <input value="{{ old('bobot') }}" type="text" class="ms-1 form-control form-control-sm @error('bobot') is-invalid @enderror" id="bobot" name="bobot" placeholder="Bobot" required>
                    </div>
                    @error('pilihan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    @error('bobot')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-sm btn-success">Tambah</button>
            </form>
        </div>
    </div>
@endsection
