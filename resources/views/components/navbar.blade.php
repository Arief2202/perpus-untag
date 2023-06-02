<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bx bxs-map-pin d-flex align-items-center"><span>Graha Wiyata Untag Surabaya - Jl. Semolowaru 45 Surabaya</span></i>
                <i class="bx bxs-phone d-flex align-items-center ms-4"><span>+62 31-5921516</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="http://jurnal.untag-sby.ac.id/">E-Jurnal</a>
                <a href="http://repository.untag-sby.ac.id/">Repository</a>
                <a href="https://ulisys.untag-sby.ac.id/">ULISYS</a>
                <a href="https://instagram.com/perpusuntagsby/?hl=en">Instagram</a>
            </div>
            </div>
        </section>
        <!-- ======= Header ======= -->
        <header id="header" class="d-flex align-items-center">
            @if(Request::segment(1) == 'dashboard')
            <button id="sidebarCollapse" class="float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
            @endif
            <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.html"><img src="/main_display/img/logo.png"></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="/main_display/img/logo.png" alt=""></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link @yield('navHomeClass')" href="/">Home</a></li>

                    <li class="dropdown"><a class="nav-link @yield('navProfilClass')" href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="/profil/fasilitas">Fasilitas</a></li>
                            <li><a href="/profil/struktur-organisasi">Struktur Organisasi</a></li>
                            <li><a href="/profil/visi-misi">Visi Misi</a></li>
                            <li><a href="/profil/badan-perpustakaan-untag-surabaya">Badan Perpustakaan Untag Sby</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link @yield('navInformasiClass')" href="#"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="/informasi/pengumuman">Pengumuman</a></li>
                            <li><a href="/informasi/berita">Berita</a></li>
                            <li><a href="/informasi/keanggotaan">Keanggotaan</a></li>
                            <li><a href="/informasi/jam-operasional">Jam Operasional</a></li>
                            <li><a href="/informasi/layanan">Layanan</a></li>
                            <li><a href="/informasi/kerjasama">Kerjasama</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link @yield('navProsedurClass')" href="#"><span>Prosedur</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="/prosedur/layanan-fotocopy-skripsi">Layanan Fotocopy Skripsi</a></li>
                            <li><a href="/prosedur/alur-kerja-proses-buku">Alur Kerja Proses Buku</a></li>
                            <li><a href="/prosedur/prosedur-pemesanan-buku">Prosedur Pemesanan Buku Yang Akan Dipinjam</a></li>
                            <li><a href="/prosedur/prosedur-pengembalian-buku">Prosedur Pengembalian Buku</a></li>
                            <li><a href="/prosedur/prosedur-peminjaman-buku">Prosedur Peminjaman Buku</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link @yield('navAksesClass')" href="/akses-informasi">Akses Informasi</a></li>
                    <li><a class="nav-link @yield('navUnduhanClass')" href="/unduhan">Unduhan</a></li>
                    <li><a class="nav-link @yield('navKontakClass')" href="/kontak">Kontak</a></li>
                    @if(Auth::user())<li><a class="nav-link @yield('navDashboardClass')" href="/dashboard">Dashboard</a></li>@endif
                    @if(!Auth::user())<li><button class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></button>
                    @else<li><form method="POST" action="{{ route('logout') }}">@csrf<button class="nav-link">Logout</a></button></form>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->

        <!-- Modal -->
        <div class="modal fade mt-5" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('login') }}" method="POST">@csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModal">Login</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>