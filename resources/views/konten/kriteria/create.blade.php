@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="d-block col-lg-10 px-3 py-4 justify-content-start">
        <div class="px-3 pt-3 mb-2">
            {{-- Header --}}
            <div class="">
                <div class="mb-2">
                    <h3 class="mb-0">Tambah Kriteria Baru</h3>
                    <a href="/kriteria" class="text-decoration-none">Kriteria ></a>
                    <a href="/kriteria/kriteriabaru" class="text-decoration-none"> Tambah Kriteria Baru</a>
                </div>
                <!-- <div>
                    <input class="btn btn-sm btn-success" type="button" value="+" onClick="addRow()">
                    <input class="btn btn-sm btn-danger" type="button" value="-" onClick="removeRow()">
                </div> -->
            </div>
        </div>
        
        <form class="" method="post" action="/kriteria/kriteriabaru">
            @csrf
            <button type="submit" onclick="return confirm('Jika terjadi penambahan data kriteria, maka nilai siswa harus diinputkan kembali. Apakah Anda yakin ingin menghapus nilai yang ada?')" class="mx-3 mb-2 btn btn-sm btn-warning">Simpan Kriteria Baru</button>
            
            {{-- Alert gagal --}}
            @if (session()->has('failed'))
                <div class="mx-3 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row px-3" id="content">
                <?php $jml_kriteria=$jml_kriteria+1?>
                <div class="col-lg-4">
                    <div class="border rounded-3 px-3 py-3 mb-3">
                        <div class="row g-3 mb-3">
                            {{-- Kode --}}
                            <div class="col-3">
                                <label for="kode" class="form-label">Kode</label>
                                <input value="C{{ $jml_kriteria }}" name="kode[]" type="text" class="form-control form-control-sm @error('kode') is-invalid @enderror" id="kode" readonly required>
                                @error('kode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
            
                            {{-- Nama Kriteria --}}
                            <div class="col-9">
                                <label for="nama" class="form-label">Nama Kriteria</label>
                                <input value="{{ old('nama') }}" name="nama[]" type="text" class="disabled form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" required>
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
                                <select name="jenis[]" id="jenis[]" class="form-control form-control-sm @error('jenis[]') is-invalid @enderror" required>
                                    <option hidden disabled selected value="">-- Pilih Jenis Kriteria --</option>
                                    @foreach ($jenis as $jenis)
                                        <option value="{{ $jenis }}">{{ $jenis }}</option>
                                    @endforeach
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- Bobot Kriteria --}}
                            <div class="col-8">
                                <label for="bobot_kriteria" class="form-label">Bobot Kriteria</label>
                                <input value="{{ old('bobot_kriteria') }}" name="bobot_kriteria[]" type="text" class="disabled form-control form-control-sm @error('bobot_kriteria') is-invalid @enderror" id="bobot_kriteria" required>
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
                            <?php $counter = $jml_pilihan ?>
                            @for($i=0;$i<$jml_pilihan;$i++)
                                {{-- Pilihan --}}
                                <div class="col-6 pe-3 mb-2">
                                    <div class="d-flex">
                                        <div class="pe-2">
                                            {{ $i+1 }}
                                        </div>
                                        <input value="{{ old('pilihan') }}" name="pilihan[]" type="text" class="disabled form-control form-control-sm @error('pilihan') is-invalid @enderror" id="pilihan" required>
                                    </div>
                                    @error('pilihan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Bobot Per Kriteria --}}
                                <div class="col-4 mb-2">
                                    <input value="{{ old('bobot') ?? $counter }}" name="bobot[]" type="text" class="form-control form-control-sm @error('bobot') is-invalid @enderror" id="bobot" readonly required>
                                    @error('bobot')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <?php $counter-- ?>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


<script>
    function addRow() {
        <?php $jml_kriteria=$jml_kriteria+1?>
        const div = document.createElement('div');
        div.className = 'col-lg-4';
        div.setAttribute("id", "kriteria");
        div.innerHTML = `
            <div class="border rounded-3 px-3 py-3 mb-3">
                <div class="row g-3 mb-3">
                    {{-- Kode --}}
                    <div class="col-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input value="C{{ $jml_kriteria }}" name="kode[]" type="text" class="disabled form-control form-control-sm @error('kode') is-invalid @enderror" id="kode" required>
                        @error('kode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    {{-- Nama Kriteria --}}
                    <div class="col-9">
                        <label for="nama" class="form-label">Nama Kriteria</label>
                        <input value="{{ old('nama') }}" name="nama[]" type="text" class="disabled form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" required>
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
                        <input value="{{ old('jenis') }}" name="jenis[]" type="text" class="disabled form-control form-control-sm @error('jenis') is-invalid @enderror" id="jenis" required>
                        @error('jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- Bobot Kriteria --}}
                    <div class="col-8">
                        <label for="bobot_kriteria" class="form-label">Bobot Kriteria</label>
                        <input value="{{ old('bobot_kriteria') }}" name="bobot_kriteria[]" type="text" class="disabled form-control form-control-sm @error('bobot_kriteria') is-invalid @enderror" id="bobot_kriteria" required>
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
                    @for($i=0;$i<$jml_pilihan;$i++)
                        {{-- Pilihan --}}
                        <div class="col-6 pe-3 mb-2">
                            <div class="d-flex">
                                <div class="pe-2">
                                    {{ $i+1 }}
                                </div>
                                <input value="{{ old('pilihan') }}" name="pilihan[]" type="text" class="disabled form-control form-control-sm @error('pilihan') is-invalid @enderror" id="pilihan" required>
                            </div>
                            @error('pilihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- Bobot Per Kriteria --}}
                        <div class="col-4 mb-2">
                            <input value="{{ old('bobot') }}" name="bobot[]" type="text" class="disabled form-control form-control-sm @error('bobot') is-invalid @enderror" id="bobot" required>
                            @error('bobot')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endfor
                </div>
            </div>
        `;

        document.getElementById('content').appendChild(div);
    }

    function removeRow(){
        var newElement = document.getElementById('content');
        newElement.removeChild(newElement.lastChild);
    }

</script>