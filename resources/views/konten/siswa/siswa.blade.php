@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="col-lg-10 px-3 bg-light py-3 g-0">
        {{-- Daftar Siswa --}}
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username"
                aria-describedby="button-addon2">
            <button class="btn btn-success btn-sm" type="button" id="button-addon2">Button</button>
        </div>

        <div class="border bg-white mb-3 rounded-3">
            <div class="pt-3 mx-3 justify-content-between d-flex">
                <h5 class="my-0 align-self-center">Daftar Siswa</h5>
                <a type="button" class="align-self-center btn btn-sm btn-success">Tambah Data</a>
            </div>

            <a class="ms-3" href="#">Daftar Siswa ></a>
            <div class="mt-3 mx-3 table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">JK</th>
                            <th scope="col">TTL</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($siswas as $siswa)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->jk }}</td>
                                <td>{{ $siswa->ttl }}</td>
                                <td>
                                    <a class="" href="/siswa/detailSiswa/{{ $siswa->id }}">Lihat</a>
                                    <a class="">Edit</a>
                                    <a class="">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Nilai Siswa --}}
        <div class="bg-light border rounded-3">
            <div class="pt-3 mx-3 justify-content-between d-flex">
                <h5 class="my-0 align-self-center">Nilai Siswa</h5>
                <a href="/siswa/nilaisiswa" type="button" class="align-self-center btn btn-sm btn-success">Tambah Data</a>
            </div>
            <a class="ms-3" href="#">Nilai Siswa ></a>
            <div class="mt-3 mx-3 bg-light table-responsive">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">C1</th>
                            <th scope="col">C2</th>
                            <th scope="col">C3</th>
                            <th scope="col">C4</th>
                            <th scope="col">C5</th>
                            <th scope="col">C6</th>
                            <th scope="col">Aksi</th>
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
                                <td>
                                    <a href="">Edit</a>
                                    <a href="">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
