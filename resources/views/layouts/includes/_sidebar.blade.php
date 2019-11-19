<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="/simak2019/dashboard/{{ auth()->user()->role }}">
        <img src="{{ asset('public/template/assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
      </a>
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
            <a href="/simak2019/logout" class="dropdown-item">
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
        <ul class="navbar-nav">
          <li class="nav-item">
          <a class=" nav-link active " href="/simak2019/dashboard/{{ auth()->user()->role }}">
            <i class="ni ni-tv-2 text-info"></i> Dashboard
          </a>
          </li>
          @if (auth()->user()->role == 'admin')
          <li class="nav-item">
            <a class="nav-link collapse" href="#subPages" data-toggle="collapse" aria-expanded="true"><i class="ni ni-app text-primary"></i>Kelola Data</a>
              <div id="subPages" class="collapse">
                  <ul class="navbar-nav ml-3">
                    <li class="nav-item"><a href="/simak2019/dosen" class="nav-link"><i class="ni ni-circle-08 text-warning"></i> Dosen</a></li>
                    <li class="nav-item"><a href="/simak2019/mahasiswa" class="nav-link"><i class="ni ni-single-02 text-info"></i> Mahasiswa</a></li>
                    <li class="nav-item"><a href="/simak2019/jadwal" class="nav-link"><i class="ni ni-calendar-grid-58 text-danger"></i> Jadwal</a></li>
                    <li class="nav-item"><a href="/simak2019/jurusan" class="nav-link"><i class="ni ni-spaceship text-blue"></i> Jurusan</a></li>
                    <li class="nav-item"><a href="/simak2019/matkul" class="nav-link"><i class="ni ni-books text-success"></i> Mata Kuliah</a></li>
                    <li class="nav-item"><a href="/simak2019/ruangan" class="nav-link"><i class="ni ni-building text-yellow"></i> Ruangan</a></li>
                    <li class="nav-item"><a href="/simak2019/semester" class="nav-link"><i class="ni ni-hat-3 text-default"></i> Semester</a></li>
                    <li class="nav-item"></li>
                  </ul>
                </div>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link " href="/simak2019/mapel">
              <i class="ni ni-planet text-red"></i>Mapel
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./examples/tables.html">
              <i class="ni ni-bullet-list-67 text-red"></i> Tables
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>