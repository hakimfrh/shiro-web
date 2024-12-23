<div class="sidebar pe-4 pb-3">
    <style>
        .sidebar .navbar .navbar-nav .nav-link:hover,
        .sidebar .navbar .navbar-nav .nav-link.active {
            color: var(--primary);
            /* Warna teks merah */
            background: #ffffff;
            /* Latar belakang putih */
            border-color: var(--primary);
            /* Border warna merah */
        }

        /* Definisikan variabel primary sebagai warna merah */
        :root {
            --primary: #B8001F;
            /* Warna merah */
        }
    </style>
    <nav class="navbar bg-light navbar-light">
        <a href="\dashboard" class="navbar-brand mx-4 mb-3">
            <h3 style="color: #384B70;"><i class="fa fa-hashtag me-2"></i>Shiroo</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('dashmin/img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="/dashboard" class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"style="background-color: #384B70; color: white;"></i>Dashboard
            </a>
            <a href="{{ route('detect-koi') }}"
                class="nav-item nav-link {{ Request::is('detect-koi') ? 'active' : '' }}">
                <i class="fa fa-fish me-2" style="background-color: #384B70; color: white;"></i>Jenis Ikan KOI
            </a>
            <a href="{{ route('grafik') }}" class="nav-item nav-link {{ Request::is('grafik') ? 'active' : '' }}">
                <i class="fa fa-chart-line me-2" style="background-color: #384B70; color: white;"></i>Grafik
            </a>
            <a href="/dashboard/controls"
                class="nav-item nav-link {{ Request::is('dashboard/controls') ? 'active' : '' }}">
                <i class="fa fa-table me-2" style="background-color: #384B70; color: white;"></i>Rekap Data
            </a>
            
            
            <!-- <a href="/logout" class="nav-item nav-link">
                <i class='bx bx-log-out me-2' style="background-color: #384B70; color: white;"></i>Logout
            </a> -->
        </div>
    </nav>
</div>