@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row col-lg-10 g-0 bg-secondary">
        {{-- Table 1 --}}
        @foreach ($kriterias as $kriteria)
            <div class="col-lg-6 col-md-6 bg-secondary">
                <div class="bg-light mx-2 mt-1">
                    {{-- Header --}}
                    <div class="ms-3">
                        <div class="pt-3">
                            <h5 class="text-dark inliner">{{ $kriteria['nama'] }} (<i>{{ $kriteria['kode'] }}</i>)</h5>
                            <button type="button" class="btn btn-sm btn-warning">Ubah Data</button>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="mt-1 mx-3 bg-light table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Pilihan</th>
                                    <th scope="col">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria['pembobotan_kriteria'] as $p)
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
