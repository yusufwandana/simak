<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <div class="row justify-content-center" style="">
        <img src="{{ asset('public/template/assets/img/brand/logo.png') }}" class="" width="60%" alt="...">
      </div>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{ asset('public/image/profile/' . auth()->user()->avatar) }}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">{{ auth()->user()->name }}</h6>
            </div>
            <a href="" class="dropdown-item" data-toggle="modal" data-target="#changeProfile">
              <i class="ni ni-single-02"></i>
              <span>Profile saya</span>
            </a>
            <a href="" class="dropdown-item" data-toggle="modal" data-target="#changePw">
              <i class="ni ni-lock-circle-open"></i>
              <span>Ubah password</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="/simak/logout" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="">
                <img src="{{asset('public/template/assets/img/brand/blue.png')}}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        @if (auth()->user()->role == 'admin')
        <hr class="my-2">
        <h6 class="navbar-heading text-muted">Menu Admin</h6>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class=" nav-link " href="/simak/dashboard/{{ auth()->user()->role }}"><i class="ni ni-tv-2 text-primary"></i> Dashboard</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link collapse" href="#subPages" data-toggle="collapse" aria-expanded="true"><i class="ni ni-app text-primary"></i>Kelola Data</a>
              <div id="subPages" class="collapse">
                  <ul class="navbar-nav ml-3">
                  </ul>
              </div>
          </li> --}}
          <li class="nav-item">
            <a href="/simak/dosen" class="nav-link"><i class="ni ni-circle-08 text-warning"></i> Dosen</a>
          </li>
          <li class="nav-item">
            <a href="/simak/mahasiswa" class="nav-link"><i class="ni ni-single-02 text-info"></i> Mahasiswa</a>
          </li>
          <li class="nav-item">
            <a href="/simak/jurusan" class="nav-link"><i class="ni ni-spaceship text-blue"></i> Jurusan</a>
          </li>
          <li class="nav-item">
            <a href="/simak/matkul" class="nav-link"><i class="ni ni-books text-success"></i> Mata Kuliah</a>
          </li>
          <li class="nav-item">
            <a href="/simak/ruangan" class="nav-link"><i class="ni ni-building text-yellow"></i> Ruangan</a>
          </li>
          <li class="nav-item">
            <a href="/simak/semester" class="nav-link"><i class="ni ni-hat-3 text-default"></i> Semester</a>
          </li>
          <li class="nav-item">
            <a class=" nav-link " href="/simak/jadwal">
              <i class="ni ni-calendar-grid-58 text-danger"></i>Atur Jadwal
            </a>
          </li>
          {{-- <li class="nav-item">
            <a class=" nav-link " href="{{ route('absen.rekap') }}">
              <i class="ni ni-calendar-grid-58 text-danger"></i>Rekap Absen
            </a>
          </li> --}}
        </ul>
        @endif
        @if (auth()->user()->role == 'dosen')
          @php
          $a = url()->full();
          $b = explode('/', $a);
          $url = $b[4];
          // dd($url);
          @endphp
        <hr class="my-2">
        <h6 class="navbar-heading text-muted">Menu Dosen</h6>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class=" nav-link" href="/simak/dashboard/{{ auth()->user()->role }}">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="/simak/absen">
              <i class="ni ni-bullet-list-67 text-info"></i>Absen
            </a>
          </li>
          <li class="nav-item">
            <a class=" nav-link " href="{{ route('absen.rekap') }}">
              <i class="ni ni-chart-bar-32 text-yellow"></i>Rekap Absen
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="/simak/lihatjadwal">
              <i class="ni ni-calendar-grid-58 text-red"></i>Lihat Jadwal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="/simak/nilai">
              <i class="ni ni-planet text-primary"></i>Input Nilai
            </a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link " href="/simak/nilai">
              <i class="ni ni-diamond text-red"></i>Lihat Nilai
            </a>
          </li> --}}          
        </ul>
        @endif
        @if (auth()->user()->role == 'mahasiswa')
        <hr class="my-2">
        <h6 class="navbar-heading text-muted">Menu Mahasiswa</h6>
        <ul class="navbar-nav">
          <li class="nav-item class">
            <a class="nav-link" href="/simak/dashboard/{{ auth()->user()->role }}">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class=" nav-link " href="/simak/Kehadiran/{{ auth()->user()->role }}">
              <i class="ni ni-tv-2 text-primary"></i> Kehadiran
            </a>
          </li>
          <li class="nav-item">
            <a class=" nav-link " href="/simak/KRS/{{ auth()->user()->role }}">
              <i class="ni ni-tv-2 text-primary"></i> KRS
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="/simak/nilai">
              <i class="ni ni-planet text-primary"></i>Nilai
            </a>
          </li>
        </ul>
        @endif
        <hr class="my-2">
      </div>
    </div>
  </nav>