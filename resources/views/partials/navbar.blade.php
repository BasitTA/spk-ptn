{{-- Navbar-Top --}}
<div style="background-color:#17252a;" class="sticky-top navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="d-flex align-items-center form-inline navbar-brand ps-2" href="/siswa">
            <img style="width: 35px; height:35px;" src="{{asset('img/logo.png') }}" alt=""> 
            <p class="ps-2 my-0">SPK Siswa</p> 
        </a>
        {{-- Btn Navbar-small screen --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRight"
            aria-controls="navbarRight" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth
            <div class="collapse navbar-collapse justify-content-end" id="navbarRight">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form class="my-0" action="/logout" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm text-light"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <div class="collapse navbar-collapse justify-content-end" id="navbarRight">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    </li>
                </ul>
            </div>

        @endauth
    </div>
</div>
