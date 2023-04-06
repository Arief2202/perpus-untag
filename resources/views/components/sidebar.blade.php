<div class="sidebar {{Auth::user()->openSideBar == '0' ? 'close' : ''}}">
    <div class="openclose-button">
        <i class='bx bx-chevron-right toggle'></i>
    </div>

    <ul class="nav-links"> 
        
        {{-- ============== TOP SIDE BAR ============= --}}     
        <li>
        <div class="profile-details">
            <div class="profile-content">
                <img class="fotoProfil" alt="Foto Profil">
            </div>
            <div class="name-job">
            <div class="profile_name">{{ Auth::user()->name }}</div>
            <div class="job">
                {{Auth::user()->role == 0 ? 'Guest' : ''}}
                {{Auth::user()->role == 1 ? 'Admin' : ''}}
                {{Auth::user()->role == 2 ? 'Super Admin' : ''}}
                {{Auth::user()->role != 0 && Auth::user()->role != 1 && Auth::user()->role != 2 ? 'Unknown' : ''}}
            </div>
            </div>
        </div>        
        </li>

        {{-- ============== MID (KOMPONEN) SIDE BAR ============= --}} 

        
        {{-- ============== Contoh Dropdown ============= --}} 

        
        {{-- <li>
            <div class="iocn-link">
                <a href="/dosen">
                    <i class='bx bx-collection'></i>
                    <span class="link_name">Dosen</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Dosen</a></li>
                <li><a href="/dosen">Profile Dosen</a></li>
                <li><a href="/dosen/profile">Beban Dosen</a></li>
            </ul>
        </li> --}}

        {{-- ============== Contoh Standart ============= --}} 

        
        {{-- <li>
            <a href="/">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/">Dashboard</a></li>
            </ul>
        </li> --}}

        
        {{-- ============== Active Component Sidebar ============= --}} 
        
        <li class="">
            <a href="/">
                <i class='bx bx-home-alt icon'></i>
                <span class="link_name">Home</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/">Home</a></li>
            </ul>
        </li>

        {{-- @if(Auth::user()->role == 1 || Auth::user()->role == 2 ||) --}}
        <li class="{{Request::segment(2) == ''? 'active' : ''}}">
            <a href="/dashboard">
                <i class='bx bx-chart icon'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/dashboard">Dashboard</a></li>
            </ul>
        </li>
        {{-- @endif --}}

        @if(Auth::user()->role == 1)
        <li class="{{Request::segment(2) == 'master'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-user icon'></i>
                    <span class="link_name">Master</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Master</a></li>
                <li><a href="/dashboard/master/biaya">Biaya</a></li>
                <li><a href="/dashboard/master/pejabat">Pejabat</a></li>
                <li><a href="/dashboard/master/sumber">Sumber</a></li>
                <li><a href="/dashboard/master/terbit">Terbit</a></li>
                <li><a href="/dashboard/master/tipe">Tipe</a></li>
                <li><a href="/dashboard/master/jenis-pengadaan">Jenis Pengadaan</a></li>
                <li><a href="/dashboard/master/jenis-koleksi">Jenis Koleksi</a></li>
                <li><a href="/dashboard/master/klasifikasi">Klasifikasi</a></li>
                <li><a href="/dashboard/master/bahasa">Bahasa</a></li>
                <li><a href="/dashboard/master/lokasi-rak">Lokasi Rak</a></li>
                <li><a href="/dashboard/master/lokasi-buku">Lokasi Buku</a></li>
                <li><a href="/dashboard/master/status-jurusan">Status Jurusan</a></li>
                <li><a href="/dashboard/master/kode-surat">Kode Surat</a></li>
                <li><a href="/dashboard/master/kode-ta">Kode TA</a></li>
                <li><a href="/dashboard/master/divisi">Divisi</a></li>
                <li><a href="/dashboard/master/mahasiswa">Mahasiswa</a></li>
                <li><a href="/dashboard/master/max-pinjam">Max Pinjam</a></li>
            </ul>
        </li>
        @endif

        @if(Auth::user()->role == 2)
            <li class="{{Request::segment(2) == 'anggota'? 'active' : ''}}">
                <a href="/dashboard/anggota">
                    <i class='bx bx-chart icon'></i>
                    <span class="link_name">Anggota</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/dashboard/anggota">Anggota</a></li>
                </ul>
            </li>
        @endif

        @if(Auth::user()->role == 1)
        <li class="{{Request::segment(2) == 'administrasi'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-user icon'></i>
                    <span class="link_name">Administrasi</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Administrasi</a></li>
                <li><a href="/dashboard/administrasi/pelayanan-mhs-luar">Pelayanan MHS Luar</a></li>
                <li><a href="/dashboard/administrasi/studi-literatur">Studi Literatur</a></li>
                <li><a href="/dashboard/administrasi/penerimaan-tugas-akhir">Penerimaan Tugas Akhir</a></li>
                <li><a href="/dashboard/administrasi/bebas-perpustakaan">Bebas Perpustakaan</a></li>
                <li><a href="/dashboard/administrasi/surat-masuk">Surat Masuk</a></li>
                <li><a href="/dashboard/administrasi/surat-keluar">Surat Keluar</a></li>
            </ul>
        </li>
        @endif

        @if(Auth::user()->role == 1)
        <li class="{{Request::segment(2) == 'pengadaan'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-log-in-circle icon'></i>
                    <span class="link_name">Pengadaan</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Pengadaan</a></li>
                {{-- <li><a href="/dashboard/pengadaan/buku">Buku</a></li>
                <li><a href="/dashboard/pengadaan/non-buku">Non Buku</a></li>
                <li><a href="/dashboard/pengadaan/tugas-akhir">Tugas Akhir</a></li>
                <li><a href="/dashboard/pengadaan/weeding">Weeding</a></li> --}}
            </ul>
        </li>
        @endif

        @if(Auth::user()->role == 1)
        <li class="{{Request::segment(2) == 'pengolahan'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bxs-cog icon'></i>
                    <span class="link_name">Pengolahan</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Pengolahan</a></li>
                <li><a href="/dashboard/pengolahan/buku">Buku</a></li>
                <li><a href="/dashboard/pengolahan/non-buku">Non Buku</a></li>
                <li><a href="/dashboard/pengolahan/tugas-akhir">Tugas Akhir</a></li>
                <li><a href="/dashboard/pengolahan/weeding">Weeding</a></li>
            </ul>
        </li>
        @endif

        
        @if(Auth::user()->role == 1)
        <li class="{{Request::segment(2) == 'sirkulasi'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-refresh icon' ></i>
                    <span class="link_name">Sirkulasi</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Sirkulasi</a></li>
                <li><a href="/dashboard/sirkulasi/buku">Buku</a></li>
                <li><a href="/dashboard/sirkulasi/anggota">Anggota</a></li>
                <li><a href="/dashboard/sirkulasi/tugas-akhir">Tugas Akhir</a></li>
            </ul>
        </li>
        @endif
        
        @if(Auth::user()->role == 1)
        <li class="{{Request::segment(2) == 'laporan'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bx-clipboard icon'></i>
                    <span class="link_name">Laporan</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Laporan</a></li>
                <li><a href="/dashboard/laporan/administrasi">Administrasi</a></li>
                <li><a href="/dashboard/laporan/pengolahan">Pengolahan</a></li>
                <li><a href="/dashboard/laporan/sirkulasi">Sirkulasi</a></li>
            </ul>
        </li>
        @endif

        

        {{-- ============== LOGOUT DAN BOTTOM SIDE BAR ================ --}}
        <li>
            <div class="sidebar-footer">
                <span class='bx bx-moon moon'></span>
                <span class="link_name">Dark mode</span>
                <ul class="sub-menu blank">
                    <li><a class="link_name">Dark Mode</a></li>
                </ul>
                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </div>        
        </li>
        
        <li>        
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                        class="logout-footer">
                <i class='bx bx-log-out icon'></i>
                <span class="link_name">Logout</span>
                <ul class="sub-menu logout-button">
                    Logout
                </ul>
                </x-responsive-nav-link>
            </form>   
        </li>

        

        {{-- ============== END LOGOUT DAN BOTTOM SIDE BAR ============== --}}
    </ul>
</div>