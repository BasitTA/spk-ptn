@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row col-lg-10 g-0 bg-light px-2 py-2">
        {{-- Table 1 --}}
        @foreach ($kriterias as $kriteria)
            <div class="col-lg-6 col-md-6">
                <div class="mx-2 my-2 border rounded-2">
                    {{-- Header --}}
                    <div class="mx-3">
                        <div class="pt-3 d-flex justify-content-between">
                            <h5 class="my-0 align-self-center text-dark inliner">{{ $kriteria->nama }}
                                (<i>{{ $kriteria->kode }}</i>)</h5>
                            <a href="" type="button" class="align-self-center btn btn-sm btn-warning">Ubah Data</a>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="mt-2 mx-3 bg-light table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Pilihan</th>
                                    <th scope="col">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria->pembobotan_kriteria as $p)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $p['pilihan'] }}</td>
                                        <td>{{ $p['bobot'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
