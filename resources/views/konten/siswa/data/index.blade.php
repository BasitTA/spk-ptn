@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="col-lg-10 px-3 bg-light py-3 g-0">

        {{-- Alert berhasil --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Fitur Pencarian --}}
        <div class="row">
            <div class="col-md-6">
                <form action="/siswa">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari.." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-success btn-sm" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Data Siswa --}}
        <div class="border bg-white mb-3 rounded-3">
            <div class="pt-3 mx-3 justify-content-between d-flex">
                <h5 class="my-0 align-self-center">Data Siswa</h5>
                <a href="siswa/siswabaru" type="button" class="align-self-center btn btn-sm btn-success">Tambah Data</a>
            </div>
            @if ($siswas->count())
                <div class="mt-3 mx-3 table-responsive">
                    <table class="table table-striped">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">JK</th>
                                <th scope="col">Tempat Lahir</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($siswas as $siswa)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->jk }}</td>
                                    <td>{{ $siswa->tempat_lahir }}</td>
                                    <td>{{ $siswa->tanggal_lahir }}</td>
                                    <td>
                                        <a href="/siswa/{{ $siswa->id }}">L</a>
                                        <a href="/siswa/{{ $siswa->id }}/edit">E</a>
                                        <form class="d-inline" action="/siswa/{{ $siswa->id }}-{{ $siswa->nilai_siswa_id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data?')">D</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center fs-4">Belum ada data yang diinput</p>
            @endif
        </div>
    </div>
@endsection
