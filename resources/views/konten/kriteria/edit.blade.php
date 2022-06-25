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

        <div class="px-3 py-3">
            {{-- Header --}}
            <div class="mb-3">
                <h3 class="mb-0">Ubah Kriteria</h3>
                <a href="/kriteria" class="text-decoration-none">Kriteria ></a>
                <a href="/kriteria/edit" class="text-decoration-none"> Ubah Kriteria</a>
            </div>
        </div>
        
        
        <form class="" method="post" action="/kriteria">
            @method('put')
            @csrf
            <button type="submit" class="mx-3 mb-2 btn btn-sm btn-warning">Simpan Kriteria</button>
            
            <div class="row px-3" id="content">
                <?php $a = 0 ?>
                @foreach($kriterias as $kriteria)
                    <div class="col-lg-4">
                        <div class="border rounded-3 mb-3">
                            <h6 class="rounded-3 g-0 bg-secondary text-light py-2 text-center">{{$kriteria->kode}}</h6>
                            <div class="px-3">
                                <div class="d-flex row mb-3">
                                    {{-- ID --}}
                                    <input value="{{ $kriteria->id }}" name="id[]" type="hidden" class="form-control form-control-sm @error('id') is-invalid @enderror" id="id" required>
                                    {{-- Kode --}}
                                    <input value="{{ $kriteria->kode }}" name="kode[]" type="hidden" class="form-control form-control-sm @error('kode') is-invalid @enderror" id="kode" required>
                                    
                                    {{-- Nama Kriteria --}}
                                    <div class="g-0 mx-2 col-11">
                                        <label for="nama" class="form-label">Nama Kriteria</label>
                                        <input value="{{ old('nama.'.$a, $kriteria->nama) }}" name="nama[]" type="text" class="disabled form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    {{-- Jenis Kriteria --}}
                                    <div class="col-4">
                                        <label for="jenis" class="form-label">Jenis Kriteria</label>
                                        <input value="{{ old('jenis.'.$a, $kriteria->jenis) }}" name="jenis[]" type="text" class="disabled form-control form-control-sm @error('jenis') is-invalid @enderror" id="jenis" required>
                                        @error('jenis')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- Bobot Kriteria --}}
                                    <div class="col-7">
                                        <label for="bobot_kriteria" class="form-label">Bobot Kriteria</label>
                                        <input value="{{ old('bobot_kriteria.'.$a, $kriteria->bobot_kriteria) }}" name="bobot_kriteria[]" type="text" class="disabled form-control form-control-sm @error('bobot_kriteria') is-invalid @enderror" id="bobot_kriteria" required>
                                        @error('bobot_kriteria')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- {{-- Pembobotan Kriteria --}}
                                <div>
                                    <h5>Pembobotan Kriteria</h5>
                                </div> -->
                                <div class="row g-0">
                                    {{-- Label Pilihan --}}
                                    <div class="col-6 pe-3">
                                        <label for="pilihan" class="form-label">Pilihan</label>
                                    </div>
                                    {{-- Label Bobot Per Kriteria--}}
                                    <div class="col-4">
                                        <label for="bobot" class="form-label">Bobot</label>
                                    </div>
                                    
                                    <?php $b = 0 ?>
                                    @foreach($kriteria->pembobotan_kriteria as $pembobotan_kriteria)
                                        {{-- Pilihan --}}
                                        <div class="col-6 pe-3 mb-2">
                                            <div class="d-flex">
                                                <div class="pe-2">
                                                    {{ $loop->iteration }}
                                                </div>
                                                <input value="{{ old('pilihan.'.$b.'.'.$a, $pembobotan_kriteria['pilihan']) }}" name="pilihan[{{$b}}][]" type="text" class="disabled form-control form-control-sm @error('pilihan') is-invalid @enderror" id="pilihan" required>
                                            </div>
                                            @error('pilihan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- Bobot Per Kriteria --}}
                                        <div class="col-4 mb-2">
                                            <input value="{{ old('bobot.'.$b.'.'.$a, $pembobotan_kriteria['bobot']) }}" name="bobot[{{$b}}][]" type="text" class="disabled form-control form-control-sm @error('bobot') is-invalid @enderror" id="bobot" required>
                                            @error('bobot')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <?php $b++ ?>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $a++ ?>
                @endforeach
            </div>
        </form>
    </div>
@endsection
