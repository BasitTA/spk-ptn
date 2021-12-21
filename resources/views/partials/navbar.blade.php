{{-- Navbar-Top --}}
<nav class="sticky-top navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="/siswa">SPK Siswa Baru</a>
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
</nav>
