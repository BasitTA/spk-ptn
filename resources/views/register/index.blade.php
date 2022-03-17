@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row justify-content-center col-lg-10 g-0">
        <main class="form-registration col-lg-5 px-4 mt-3">
            <h1 class="h3 mb-3 fw-normal text-center">Form Pendaftaran</h1>
            <form action="/register" method="post">
                @csrf
                <div class="form-floating">
                    <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror"
                        id="name" placeholder="Nama" required value="{{ old('name') }}">
                    <label for="name">Nama</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" required value="{{ old('email') }}">
                    <label for="email">Email</label>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating ">
                    <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password"
                    placeholder="Kata Sandi" required>
                    <label for="password">Kata Sandi</label>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="hidden" name="level" class="form-control @error('level') is-invalid @enderror" id="level" placeholder="Level" required value="user" readonly="true">
                    {{-- <label for="level">Pengguna</label> --}}
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button class="w-100 btn btn-lg btn-success mt-3" type="submit">Daftar</button>
            </form>
            <small class="d-block text-center">Sudah Terdaftar? <a href="/login">Masuk</a></small>
        </main>
    </div>
@endsection
