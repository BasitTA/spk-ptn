@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')

@if ($nilai_siswas->count()>1)
    <div class="row col-lg-10 g-0 bg-light px-2 py-2">
        
        {{-- ADMIN ONLY --}}    
        {{-- Kuota --}}
            <div class="">
                <div class="mx-2 my-2 border rounded-2">
                    <div class="mx-2 my-2">
                        <h5 for="kuota" class="form-label mx-2">Jumlah Kuota</h5>
                        <div class="px-2 col-md-4">Kuota Penerimaan Terkini: <strong class="text-success h6">{{ $kuota[0]->kuota ?? 0 }}</strong></div>
                    </div>
                    @if (auth()->user()->level=="admin")
                        <form class="mx-2" method="post" action="/hasilperhitungan">
                            @csrf
                            {{-- Jumlah Kuota --}}
                            <div class="px-2 col-md-4 d-flex">
                                <input value="{{ old('kuota') }}" type="number" min="0" class="form-control form-control-sm @error('kuota') is-invalid @enderror" id="kuota" name="kuota" placeholder="Jumlah Kuota" required>
                                <button type="submit" class="ms-2 btn btn-sm btn-success">Simpan</button>
                            </div>
                            @error('kuota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                    @endif
                </div>
            </div>

        @if($kuota[0]->kuota ?? 0 > 0)
        {{-- Kesimpulan --}}
            <div class="">
                <div class="mx-2 my-2 border rounded-2">
                    {{-- Header --}}
                    <div class="mx-3">
                        <div class="pt-3 d-flex justify-content-between">
                            <h5 class="my-0 align-self-center text-dark inliner">Kesimpulan</h5>
                        </div>
                    </div>
                    {{-- Deskriptif --}}
                    <div class="mt-2 mx-3 bg-light">
                        <p>Berdasarkan hasil perhitungan dengan Metode SAW dan TOPSIS, dapat disimpulkan bahwa calon siswa terbaik adalah <strong>{{ $hasil_perangkingan[0]->nama }}</strong> dengan nilai <strong>{{ $hasil_perangkingan[0]->nilai_preferensi }}</strong></p>
                    </div>
                </div>
            </div>
            
            {{-- Nilai Preferensi (Ranking) --}}
            <div class="">
                <div class="mx-2 mt-2 mb-4 border rounded-2">
                    {{-- Header --}}
                    <div class="mx-3">
                        <div class="pt-3 d-flex justify-content-between">
                            <h5 class="my-0 align-self-center text-dark inliner">Hasil Perangkingan</h5>
                            <a href="cetakhasilperhitungan" type="button" class="btn btn-sm btn-primary"><i class="bi bi-printer"></i> Cetak</a>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="mt-2 mx-3 bg-light table-responsive">
                        <table class="table">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasil_perangkingan as $hp)
                                    @if($loop->iteration <= $kuota[0]->kuota ?? 0)
                                        <tr>
                                    @else
                                        <tr class="table-secondary">
                                    @endif
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $hp->nama }}</td>
                                            <td>{{ $hp->nilai_preferensi }}</td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mx-3">
                        <p>*Data pada tabel di atas yang berwarna abu-abu berarti di luar dari kuota penerimaan (belum dapat diterima)</p>
                    </div>
                </div>
            </div>


            <hr>

            {{-- Data Calon Siswa --}}
            {{-- Table 1 --}}
            {{-- <div class="">
                <div class="mx-2 my-2 border rounded-2"> --}}
                    {{-- Header --}}
                    {{-- <div class="mx-3">
                        <div class="pt-3 text-center">
                            <h5 class="my-0 text-dark inliner">Data Calon Siswa</h5>
                        </div>
                    </div> --}}
                    {{-- Table --}}
                    {{-- <div class="mt-2 mx-3 bg-light table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">C1</th>
                                    <th scope="col">C2</th>
                                    <th scope="col">C3</th>
                                    <th scope="col">C4</th>
                                    <th scope="col">C5</th>
                                    <th scope="col">C6</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai_siswas as $ns)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $ns->nama }}</td>
                                        @foreach ($ns->pilihan as $pilihan)
                                            <td>{{ $pilihan }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

            {{-- Persamaan matriks keputusan X (rating keputusan) --}}
            {{-- Table 2 --}}
            {{-- @foreach ($kriterias as $kriteria) --}}
                <div class="">
                    <h4 class="text-start mx-3 mb-3">Perhitungan Metode SAW dan TOPSIS</h4>
                    <div class="mx-2 my-2 border rounded-2">
                        {{-- Header --}}
                        <div class="mx-3">
                            <div class="pt-3 text-center">
                                <h6 class="my-0 text-dark inliner">Persamaan Matriks Keputusan X (rating keputusan)</h6>
                            </div>
                        </div>
                        {{-- Table --}}
                        <div class="mt-2 mx-3 bg-light table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">C1</th>
                                        <th scope="col">C2</th>
                                        <th scope="col">C3</th>
                                        <th scope="col">C4</th>
                                        <th scope="col">C5</th>
                                        <th scope="col">C6</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilai_siswas as $ns)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $ns->nama }}</td>
                                        @foreach ($ns->pilihan as $pilihan)
                                            <td>{{ $pilihan }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            {{-- Normalisasi Matriks Keputusan R --}}
            {{-- Table 3 --}}
            {{-- @foreach ($kriterias as $kriteria) --}}
                <div class="col-lg-6 col-md-6">
                    <div class="mx-2 my-2 border rounded-2">
                        {{-- Header --}}
                        <div class="mx-3">
                            <div class="pt-3 text-center">
                                <h6 class="my-0 text-dark inliner">Normalisasi Matriks Keputusan R</h6>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="mt-2 mx-3 bg-light table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">C1</th>
                                        <th scope="col">C2</th>
                                        <th scope="col">C3</th>
                                        <th scope="col">C4</th>
                                        <th scope="col">C5</th>
                                        <th scope="col">C6</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0 ?>
                                    @foreach ($nilai_siswas as $ns)
                                    <tr>
                                        {{-- {{ dd($normalisasi_matriks_r) }} --}}
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $ns->nama }}</td>
                                        @for ($i = 0; $i < 6 ; $i++)
                                            <td>{{ $normalisasi_matriks_r[$x][$i] }}</td>
                                        @endfor
                                        <?php $x++ ?>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            {{-- Normalisasi Matriks Terbobot Y --}}
            {{-- Table 4 --}}
            {{-- @foreach ($kriterias as $kriteria) --}}
                <div class="col-lg-6 col-md-6">
                    <div class="mx-2 my-2 border rounded-2">
                        {{-- Header --}}
                        <div class="mx-3">
                            <div class="pt-3 text-center">
                                <h6 class="my-0 text-dark inliner">Normalisasi Matriks Terbobot Y</h6>
                            </div>
                        </div>
                        {{-- Table --}}
                        <div class="mt-2 mx-3 bg-light table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">C1</th>
                                        <th scope="col">C2</th>
                                        <th scope="col">C3</th>
                                        <th scope="col">C4</th>
                                        <th scope="col">C5</th>
                                        <th scope="col">C6</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0 ?>
                                    @foreach ($nilai_siswas as $ns)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $ns->nama }}</td>
                                            @for ($i = 0; $i < 6 ; $i++)
                                                <td>{{ $normalisasi_matriks_terbobot_y[$x][$i] }}</td>
                                            @endfor
                                            <?php $x++ ?>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            {{-- Solusi Ideal Positif (A+) --}}
            {{-- Table 5 --}}
            {{-- @foreach ($kriterias as $kriteria) --}}
                <div class="col-lg-6 col-md-6">
                    <div class="mx-2 my-2 border rounded-2">
                        {{-- Header --}}
                        <div class="mx-3">
                            <div class="pt-3 text-center">
                                <h6 class="my-0 text-dark inliner">Solusi Ideal Positif (A <sup>+</sup>)</h6>
                            </div>
                        </div>
                        {{-- Table --}}
                        <div class="mt-2 mx-3 bg-light table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">A1 <sup>+</sup></th>
                                        <th scope="col">A2 <sup>+</sup></th>
                                        <th scope="col">A3 <sup>+</sup></th>
                                        <th scope="col">A4 <sup>+</sup></th>
                                        <th scope="col">A5 <sup>+</sup></th>
                                        <th scope="col">A6 <sup>+</sup></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($solusi_ideal_positif as $s_i_p)
                                            <td>{{ $s_i_p }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            {{-- Solusi Ideal Negatif (A-) --}}
            {{-- Table 6 --}}
            {{-- @foreach ($kriterias as $kriteria) --}}
                <div class="col-lg-6 col-md-6">
                    <div class="mx-2 my-2 border rounded-2">
                        {{-- Header --}}
                        <div class="mx-3">
                            <div class="pt-3 text-center">
                                <h6 class="my-0 text-dark inliner">Solusi Ideal Negatif (A <sup>-</sup>)</h6>
                            </div>
                        </div>
                        {{-- Table --}}
                        <div class="mt-2 mx-3 bg-light table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        {{-- <th scope="col">No</th> --}}
                                        <th scope="col">A1 <sup>-</sup></th>
                                        <th scope="col">A2 <sup>-</sup></th>
                                        <th scope="col">A3 <sup>-</sup></th>
                                        <th scope="col">A4 <sup>-</sup></th>
                                        <th scope="col">A5 <sup>-</sup></th>
                                        <th scope="col">A6 <sup>-</sup></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($solusi_ideal_negatif as $s_i_n)
                                            <td>{{ $s_i_n }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            {{-- Jarak Terbobot Alternatif Solusi Ideal Positif (S1+) --}}
            {{-- Table 7 --}}
            {{-- @foreach ($kriterias as $kriteria) --}}
                <div class="col-lg-6 col-md-6">
                    <div class="mx-2 my-2 border rounded-2">
                        {{-- Header --}}
                        <div class="mx-3">
                            <div class="pt-3 text-center">
                                <h6 class="my-0 text-dark inliner">Jarak Terbobot Alternatif Solusi Ideal Positif (Di <sup>+</sup>)</h6>
                            </div>
                        </div>
                        {{-- Table --}}
                        <div class="mt-2 mx-3 bg-light table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">Di <sup>+</sup></th>
                                        <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jarak_terbobot_a_positif as $j_t_a_p)
                                        <tr>
                                            <th scope="row">D{{ $loop->iteration }} <sup>+</sup></td>
                                            <td>{{ $j_t_a_p }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            {{-- Jarak Terbobot Alternatif Solusi Ideal Negatif (S1-) --}}
            {{-- Table 8 --}}
            {{-- @foreach ($kriterias as $kriteria) --}}
                <div class="col-lg-6 col-md-6">
                    <div class="mx-2 my-2 border rounded-2">
                        {{-- Header --}}
                        <div class="mx-3">
                            <div class="pt-3 text-center">
                                <h6 class="my-0 text-dark inliner">Jarak Terbobot Alternatif Solusi Ideal Negatif (Di <sup>-</sup>)</h6>
                            </div>
                        </div>
                        {{-- Table --}}
                        <div class="mt-2 mx-3 bg-light table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">Di <sup>-</sup></th>
                                        <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jarak_terbobot_a_negatif as $j_t_a_n)
                                        <tr>
                                            <th scope="row">D{{ $loop->iteration }} <sup>-</sup></td>
                                            <td>{{ $j_t_a_n }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            {{-- Nilai Preferensi (Unranked) --}}
            {{-- Table 9 --}}
            {{-- @foreach ($kriterias as $kriteria) --}}
                <div class="">
                    <div class="mx-2 my-2 border rounded-2">
                        {{-- Header --}}
                        <div class="mx-3">
                            <div class="pt-3 text-center">
                                <h6 class="my-0 text-dark inliner">Nilai Preferensi</h6>
                            </div>
                        </div>
                        {{-- Table --}}
                        <div class="mt-2 mx-3 bg-light table-responsive">
                            <table class="table table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Nama Siswa</th>
                                        <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x=0 ?>
                                    @foreach ($nilai_siswas as $n_s)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $n_s->nama }}</td>
                                            <td>{{ $nilai_preferensi[$x] }}</td>
                                            <?php $x++ ?>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}
        @else
            <h5 class="d-flex my-5 justify-content-center">Harap masukkan jumlah kuota siswa yang akan diterima</h5>
        @endif
    </div>
@else
    <div class="row col-lg-10 g-0 bg-light px-2 py-2">
        {{-- Kesimpulan --}}
        <div class="">
            <div class="mx-2 my-2 border bg-white rounded-2">
                {{-- Header --}}
                <div class="mx-3">
                    <div class="pt-3 d-flex justify-content-between">
                        <h5 class="my-0 align-self-center text-dark inliner">Kesimpulan</h5>
                    </div>
                </div>
                {{-- Deskriptif --}}
                <div class="my-5 mx-3 ">
                   <p class="text-danger text-center fs-3">Data terlalu sedikit, silahkan tambahkan nilai siswa</p>
                </div>
            </div>
        </div>
    </div>

@endif
@endsection

{{-- <script type="text/javascript">
    window.print();
</script> --}}