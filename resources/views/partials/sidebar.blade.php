@auth
    {{-- Sidebar/Navbar-Left --}}
    <nav class="mx-0 align-items-start justify-content-center collapse navbar-collapse col-md-3 col-lg-2 pt-3"
        id="navbarRight">
        <ul class="mx-0 navbar-nav flex-column d-flex justify-content-center ">
            {{-- <li class="mx-0 nav-item pb-0">
                <p class="truncate smaller-font text-uppercase mx-0 me-1 px-2"><i class="bi bi-person-circle"></i><small class="text-capitalize smaller-font"> {{ $user->name }} ({{ $user->level }})</small></p>
            </li> --}}
            <li class="mx-0 nav-item pb-2">
                <a class="nav-link text-dark mx-0 px-2 {{ ($active === 1) ? 'active' : '' }}" href="/siswa"><i class="bi bi-file-earmark-text"></i> Data Siswa</a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link text-dark mx-0 px-2 {{ ($active === 2) ? 'active' : '' }}" href="/nilaisiswa"><i class="bi bi-bar-chart-line"></i> Nilai Siswa</a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link text-dark mx-0 px-2 {{ ($active === 3) ? 'active' : '' }}" href="/kriteria"><i class="bi bi-clipboard-check"></i> Data Kriteria</a>
            </li>
            <li class="nav-item pb-2">
                <a class="nav-link text-dark mx-0 px-2 {{ ($active === 4) ? 'active' : '' }}" href="/hasilperhitungan"><i class="bi bi-award"></i> Hasil Perhitungan</a>
            </li>
        </ul>
    </nav>

    {{-- <script>
        $(".nav li").on("click", function() {
          $(".nav li").removeClass("active");
          $(this).addClass("active");
        });
    
    </script> --}}
@endauth
