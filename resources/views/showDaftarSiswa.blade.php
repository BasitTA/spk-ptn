@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="col-lg-10">
        <h2>{{ $students['name'] }}</h2>
        <h5>{{ $students['gender'] }}</h5>
        <h5>{{ $students['place_of_birth'] }}</h5>
        {{-- <h5>{{ $students['date_of_birth'] }}</h5>
        <h5>{{ $students['address'] }}</h5> --}}

        <a href="/">Kembali</a>
    </div>
@endsection