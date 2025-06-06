<!-- Popper.js (Diperlukan untuk Bootstrap 5) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<!-- Bootstrap 5 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

>
<div class="main-sidebar">
        <aside id="sidebar-wrapper">
                <div class="sidebar-brand mt-3  ">
                        <p style="font-family: 'Times New Roman', Times, serif; font-weight:bold; font-size:20px ">SMAN
                                1 PARMAKSIAN
                        </p>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                        <a href="#">{{ strtoupper(substr(config(''), 0, 2)) }}SMA</a>
                </div>
                <ul class="sidebar-menu">
                        @if (Auth::check() && Auth::user()->roles == 'admin')
                        <li class="{{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('admin.dashboard') }}"><i class="fas fa-columns"></i>
                                        <span>Dashboard</span></a></li>

                        <li class="{{ request()->routeIs('jurusan.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('jurusan.index') }}"><i class="fas fa-book"></i>
                                        <span>Jurusan</span></a></li>

                        <li class="{{ request()->routeIs('mapel.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('mapel.index') }}"><i class="fas fa-book"></i> <span>Mata
                                                Pelajaran</span></a></li>

                        <li class="{{ request()->routeIs('guru.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('guru.index') }}"><i class="fas fa-user"></i>
                                        <span>Guru</span></a></li>

                        <li class="{{ request()->routeIs('kelas.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('kelas.index') }}"><i class="far fa-building"></i>
                                        <span>Kelas</span></a></li>

                        <li class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('siswa.index') }}"><i class="fas fa-users"></i>
                                        <span>Siswa</span></a></li>

                        <li class="{{ request()->routeIs('jadwal.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('jadwal.index') }}"><i class="fas fa-calendar"></i>
                                        <span>Jadwal</span></a></li>

                        <li class="{{ request()->routeIs('user.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('user.index') }}"><i class="fas fa-user"></i>
                                        <span>User</span></a></li>

                        <li class="{{ request()->routeIs('pengumuman.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('pengumuman.index') }}"><i class="fas fa-calendar"></i>
                                        <span>Pengumuman</span></a>
                        </li>

                        <li class="{{ request()->routeIs('galeri.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('galeri.index') }}"><i class="fas fa-image"></i>
                                        <span>Galeri</span></a></li>

                        {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-"></i> <span>Guest</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ route('pages.guest.index')}}">Galeri
                                                        Utama</a></li>
                                        <li><a class="dropdown-item" href="{{ route('home')}}">Tambah Galeri</a></li>
                                </ul>
                        </li> --}}


                        <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-calendar"></i> <span>Guest</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item"
                                                        href="{{ route('pages.guest.home.index') }}">G-Home</a></li>
                                        <li><a class="dropdown-item"
                                                        href="{{ route('pages.guest.tentang.index') }}">G-Tentang</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                        href="{{ route('pages.guest.fasilitas.index') }}">G-Fasilitas</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                        href="{{ route('pages.guest.galeri.index') }}">G-Galeri</a></li>
                                        <li><a class="dropdown-item"
                                                        href="{{ route('pages.guest.alumni.index') }}">G-Alumni</a>
                                        </li>
                                </ul>
                        </li>











                        @elseif (Auth::check() && Auth::user()->roles == 'guru')
                        <li class="{{ request()->routeIs('guru.dashboard.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('guru.dashboard') }}"><i class="fas fa-columns"></i>
                                        <span>Dashboard</span></a></li>
                        <li class="menu-header">Master Data</li>
                        <li class="{{ request()->routeIs('materi.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('materi.index') }}"><i class="fas fa-book"></i>
                                        <span>Materi</span></a></li>
                        <li class="{{ request()->routeIs('tugas.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('tugas.index') }}"><i class="fas fa-list"></i>
                                        <span>Tugas</span></a></li>
                        <li class="{{ request()->routeIs('pengumuman.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('guru.pengumuman') }}"><i class="fas fa-list"></i>
                                        <span>Pengumuman</span></a></li>
                        <li class="{{ request()->routeIs('galeri.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('guru.galeri') }}"><i class="fas fa-list"></i>
                                        <span>Galeri</span></a></li>
                        <li class="{{ request()->routeIs('kuis.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('pages.guru.kuis.index') }}"><i class="fas fa-list"></i>
                                        <span>Kuis</span></a></li>

                        @elseif (Auth::check() && Auth::user()->roles == 'siswa')
                        <li class="{{ request()->routeIs('siswa.dashboard.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('siswa.dashboard') }}"><i class="fas fa-columns"></i>
                                        <span>Dashboard</span></a></li>
                        <li class="{{ request()->routeIs('materi.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('siswa.materi') }}"><i class="fas fa-book"></i>
                                        <span>Materi</span></a></li>
                        <li class="{{ request()->routeIs('tugas.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('siswa.tugas') }}"><i class="fas fa-list"></i>
                                        <span>Tugas</span></a></li>
                        <li class="{{ request()->routeIs('pengumuman.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('siswa.pengumuman') }}"><i class="fas fa-list"></i>
                                        <span>Pengumuman</span></a></li>
                        <li class="{{ request()->routeIs('galeri.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('siswa.galeri') }}"><i class="fas fa-list"></i>
                                        <span>Galeri</span></a></li>
                        <li class="{{ request()->routeIs('kuis.*') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('siswa.quiz')}}"><i class="fas fa-list"></i>
                                        <span>Kuis</span></a></li>
                        @endif



                </ul>
        </aside>
</div>