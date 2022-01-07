@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row col-lg-10 g-0 bg-light px-2 py-2">
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
                    <p>Berdasarkan hasil perhitungan dengan Metode SAW dan TOPSIS, dapat disimpulkan bahwa calon siswa terbaik adalah V_ yaitu ____ dengan nilai _</p>
                </div>
            </div>
        </div>
        
        {{-- Nilai Preferensi (Ranking) --}}
        <div class="">
            <div class="mx-2 mt-2 mb-4 border rounded-2">
                {{-- Header --}}
                <div class="mx-3">
                    <div class="pt-3 d-flex justify-content-between">
                        <h5 class="my-0 align-self-center text-dark inliner">Nilai Preferensi (Ranking)</h5>
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
                            {{-- @foreach ($kriteria->pembobotan_kriteria as $p) --}}
                                <tr>
                                    {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                    {{-- <td>{{ $p['pilihan'] }}</td>
                                    <td>{{ $p['bobot'] }}</td> --}}
                                </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <hr><hr>

        {{-- Data Calon Siswa --}}
        {{-- Table 1 --}}
        <div class="">
            <div class="mx-2 my-2 border rounded-2">
                {{-- Header --}}
                <div class="mx-3">
                    <div class="pt-3 text-center">
                        <h5 class="my-0 text-dark inliner">Data Calon Siswa</h5>
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

        {{-- Persamaan matriks keputusan X (rating keputusan) --}}
        {{-- Table 2 --}}
        {{-- @foreach ($kriterias as $kriteria) --}}
            <div class="">
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
                                {{-- @foreach ($kriteria->pembobotan_kriteria as $p) --}}
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        {{-- <td>{{ $p['pilihan'] }}</td>
                                        <td>{{ $p['bobot'] }}</td> --}}
                                    </tr>
                                {{-- @endforeach --}}
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
                                {{-- @foreach ($kriteria->pembobotan_kriteria as $p) --}}
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        {{-- <td>{{ $p['pilihan'] }}</td>
                                        <td>{{ $p['bobot'] }}</td> --}}
                                    </tr>
                                {{-- @endforeach --}}
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
                                {{-- @foreach ($kriteria->pembobotan_kriteria as $p) --}}
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        {{-- <td>{{ $p['pilihan'] }}</td>
                                        <td>{{ $p['bobot'] }}</td> --}}
                                    </tr>
                                {{-- @endforeach --}}
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
                            <h6 class="my-0 text-dark inliner">Solusi Ideal Positif (A+)</h6>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="mt-2 mx-3 bg-light table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    {{-- <th scope="col">No</th> --}}
                                    <th scope="col">A1+</th>
                                    <th scope="col">A2+</th>
                                    <th scope="col">A3+</th>
                                    <th scope="col">A4+</th>
                                    <th scope="col">A5+</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($kriteria->pembobotan_kriteria as $p) --}}
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        {{-- <td>{{ $p['pilihan'] }}</td>
                                        <td>{{ $p['bobot'] }}</td> --}}
                                    </tr>
                                {{-- @endforeach --}}
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
                            <h6 class="my-0 text-dark inliner">Solusi Ideal Negatif (A-)</h6>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="mt-2 mx-3 bg-light table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    {{-- <th scope="col">No</th> --}}
                                    <th scope="col">A1-</th>
                                    <th scope="col">A2-</th>
                                    <th scope="col">A3-</th>
                                    <th scope="col">A4-</th>
                                    <th scope="col">A5-</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($kriteria->pembobotan_kriteria as $p) --}}
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        {{-- <td>{{ $p['pilihan'] }}</td>
                                        <td>{{ $p['bobot'] }}</td> --}}
                                    </tr>
                                {{-- @endforeach --}}
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
                            <h6 class="my-0 text-dark inliner">Jarak Terbobot Alternatif Solusi Ideal Positif (S1+)</h6>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="mt-2 mx-3 bg-light table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    {{-- <th scope="col">No</th> --}}
                                    <th scope="col">D1+</th>
                                    <th scope="col">D2+</th>
                                    <th scope="col">D3+</th>
                                    <th scope="col">D4+</th>
                                    <th scope="col">D5+</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($kriteria->pembobotan_kriteria as $p) --}}
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        {{-- <td>{{ $p['pilihan'] }}</td>
                                        <td>{{ $p['bobot'] }}</td> --}}
                                    </tr>
                                {{-- @endforeach --}}
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
                            <h6 class="my-0 text-dark inliner">Jarak Terbobot Alternatif Solusi Ideal Negatif (S1-)</h6>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="mt-2 mx-3 bg-light table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    {{-- <th scope="col">No</th> --}}
                                    <th scope="col">D1-</th>
                                    <th scope="col">D2-</th>
                                    <th scope="col">D3-</th>
                                    <th scope="col">D4-</th>
                                    <th scope="col">D5-</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($kriteria->pembobotan_kriteria as $p) --}}
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        {{-- <td>{{ $p['pilihan'] }}</td>
                                        <td>{{ $p['bobot'] }}</td> --}}
                                    </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}

        {{-- Nilai Preferensi (Ranking) --}}
        {{-- Table 9 --}}
        {{-- @foreach ($kriterias as $kriteria) --}}
            <div class="">
                <div class="mx-2 my-2 border rounded-2">
                    {{-- Header --}}
                    <div class="mx-3">
                        <div class="pt-3 text-center">
                            <h6 class="my-0 text-dark inliner">Nilai Preferensi (Ranking)</h6>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="mt-2 mx-3 bg-light table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">Id/Kode</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($kriteria->pembobotan_kriteria as $p) --}}
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        {{-- <td>{{ $p['pilihan'] }}</td>
                                        <td>{{ $p['bobot'] }}</td> --}}
                                    </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>
@endsection
