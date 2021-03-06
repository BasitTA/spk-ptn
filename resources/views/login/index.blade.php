@extends('layouts.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row justify-content-center col-lg-10 g-0">

        {{-- Alert berhasil --}}
        @if (session()->has('success'))
            <div class="col-lg-8 alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Alert gagal --}}
        @if (session()->has('loginError'))
            <div class="col-lg-8 alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- FORM LOGIN --}}
        <main class="form-signin col-lg-5 px-4 mt-3">
            <h1 class="h3 mb-3 fw-normal text-center">Silahkan Masuk</h1>
            <form action="/login" method="post">
                @csrf
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                    <label for="email">Email</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Kata Sandi" required>
                    <label for="password">Kata Sandi</label>
                </div>
                <button class="w-100 btn btn-lg btn-success" type="submit">Masuk</button>
            </form>
            <small class="d-block text-center">Belum terdaftar? <a href="/register">Daftar Sekarang</a></small>
        </main>
    </div>
@endsection
