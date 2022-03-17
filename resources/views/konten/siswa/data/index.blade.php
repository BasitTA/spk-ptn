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
                <div>
                    {{-- ADMIN ONLY --}}
                    @if (auth()->user()->level=="admin")
                        <a href="siswa/siswabaru" type="button" class="align-self-center btn btn-sm btn-success"><i class="bi bi-plus-lg"></i> Tambah</a>
                    @endif
                    <a href="cetakdatasiswa" type="button" class="align-self-center btn btn-sm btn-primary"><i class="bi bi-printer"></i> Cetak</a>
                </div>
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
                                        <a class="align-middle" href="/siswa/{{ $siswa->id }}"><i class="text-primary bi bi-eye-fill"></i></a>
                                        {{-- ADMIN ONLY --}}
                                        @if (auth()->user()->level=="admin")
                                        <a class="align-middle" href="/siswa/{{ $siswa->id }}/edit"><i class="text-warning bi bi-pencil-square"></i></a>
                                            <form class="d-inline" action="/siswa/{{ $siswa->id }}-{{ $siswa->nilai_siswa_id }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="px-0 btn btn-link" onclick="return confirm('Apakah anda yakin untuk menghapus data?')"><i class="text-danger bi bi-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="my-5 text-danger text-center fs-3">Belum ada data yang diinput, silahkan tambah data</p>
            @endif
        </div>
    </div>
@endsection
