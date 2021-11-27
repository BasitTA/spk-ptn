@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <h2>{{ $siswas["nama"] }}</h2>
    <h5>{{ $siswas["jk"] }}</h5>
    <h5>{{ $siswas["ttl"] }}</h5>
    <h5>{{ $siswas["alamat"] }}</h5>

    <a href="/">Kembali</a>
@endsection