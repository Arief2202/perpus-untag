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

        {{-- <li class="{{Request::segment(2) == ''? 'active' : ''}}">
            <a href="/dashboard">
                <i class='bx bx-chart icon'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/dashboard">Dashboard</a></li>
            </ul>
        </li> --}}

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
                {{-- <li><a href="/dashboard/pengolahan/non-buku">Non Buku</a></li>
                <li><a href="/dashboard/pengolahan/tugas-akhir">Tugas Akhir</a></li> --}}
                <li><a href="/dashboard/pengolahan/cetak-label">Cetak Label</a></li>
            </ul>
        </li>
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