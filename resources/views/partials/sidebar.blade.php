{{-- Sidebar/Navbar-Left --}}
<nav class="align-items-start collapse navbar-collapse col-md-3 col-lg-2 bg-dark pt-3 justify-content-center"
    id="navbarRight">
    <ul class="navbar-nav flex-column">
        <li class="nav-item ms-2 pb-2">
            <a class="nav-link text-white {{ ($title === "Data Siswa") ? 'active' : '' }}" href="/siswa">Data Siswa</a>
        </li>
        <li class="nav-item ms-2 pb-2">
            <a class="nav-link text-white {{ ($title === "Data Kriteria") ? 'active' : '' }}" href="/kriteria">Data Kriteria</a>
        </li>
        <li class="nav-item ms-2 pb-2">
            <a class="nav-link text-white {{ ($title === "Hasil Perhitungan") ? 'active' : '' }}" href="/hasilperhitungan">Hasil Perhitungan</a>
        </li>
    </ul>
</nav>
