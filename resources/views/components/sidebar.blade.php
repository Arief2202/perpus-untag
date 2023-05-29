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
            <div class="job">{{Auth::user()->keanggotaan->nama_keanggotaan}}</div>
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

        {{-- <li class="{{Request::segment(2) == ''? 'active' : ''}}">
            <a href="/dashboard">
                <i class='bx bx-chart icon'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/dashboard">Dashboard</a></li>
            </ul>
        </li> --}}

        @if(Auth::user()->keanggotaan_id == 2)
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
                <li><a href="/dashboard/pengolahan/cetak-label">Cetak Label</a></li>
            </ul>
        </li>
        <li class="{{Request::segment(2) == 'sirkulasi'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bxs-cog icon'></i>
                    <span class="link_name">Sirkulasi</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Sirkulasi</a></li>
                <li><a href="/dashboard/sirkulasi/aktif">Peminjaman Aktif</a></li>
                <li><a href="/dashboard/sirkulasi/history">History Peminjaman</a></li>
            </ul>
        </li>
        <li class="{{Request::segment(2) == 'keanggotaan'? 'active' : ''}}">
            <div class="iocn-link">
                <a href="#">
                    <i class='bx bxs-cog icon'></i>
                    <span class="link_name">Keanggotaan</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Keanggotaan</a></li>
                <li><a href="/dashboard/keanggotaan/daftar-keanggotaan">Daftar Keanggotaan</a></li>
                <li><a href="/dashboard/keanggotaan/daftar-akun">Daftar Akun</a></li>
            </ul>
        </li>
        @endif
        @if(Auth::user()->keanggotaan_id == 3)
            <li class="{{Request::segment(3) == 'peminjaman-terkini'? 'active' : ''}}">
                <a href="/dashboard/user/peminjaman-terkini">
                    <i class='bx bx-chart icon'></i>
                    <span class="link_name">Peminjaman Terkini</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/dashboard/user/peminjaman-terkini" >Peminjaman Terkini</a></li>
                </ul>
            </li>
            <li class="{{Request::segment(3) == 'history-peminjaman'? 'active' : ''}}">
                <a href="/dashboard/user/history-peminjaman">
                    <i class='bx bx-chart icon'></i>
                    <span class="link_name">History Peminjaman</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/dashboard/user/history-peminjaman">History Peminjaman</a></li>
                </ul>
            </li>
            <li class="{{Request::segment(3) == 'account'? 'active' : ''}}">
                <a href="/dashboard/user/account">
                    <i class='bx bx-chart icon'></i>
                    <span class="link_name">Akun Saya</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/dashboard/user/account">Akun Saya</a></li>
                </ul>
            </li>

            {{-- <li class="{{Request::segment(2) == 'sirkulasi'? 'active' : ''}}">
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
            </li> --}}
        @endif

        
        {{-- @if(Auth::user()->role == 1)
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
        @endif --}}
        

        

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