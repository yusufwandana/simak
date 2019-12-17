<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">@yield('head')</a>        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body mx-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                  </div>
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
      </div>
    </nav>

    {{--  Edit profile --}}
  <div class="modal fade" id="changeProfile" tabindex="-1" role="dialog" aria-labelledby="changeProfileLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="/simak/changepp" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="changeProfileLabel">
                        Ubah profile 
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="col-md order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow mb-3">
                        <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                            <a href="{{ asset('public/image/profile/' . auth()->user()->avatar) }}" target="_blank">
                                <div>
                                  <img src="{{ asset('public/image/profile/' . auth()->user()->avatar) }}" style="width:150%; border:#000 solid 1px;">
                                </div>
                            </a>
                            </div>
                          </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

                        </div>
                        <div class="card-body pt-0 pt-md-2">
                        <div class="row">
                            <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center mt-md-3">
                
                            </div>
                            </div>
                        </div>
                        <div class="text-center">
                          <h3>
                            {{ auth()->user()->name }}<span class="font-weight-light"></span>
                          </h3>
                          <div class="h5 font-weight-300">
                          <i class="ni location_pin mr-2"></i>{{ auth()->user()->email }}
                          </div>
                          <input type="hidden" name="id" id="id" value="{{ auth()->user()->id }}">
                          <div class="form-group mt-4">
                              <strong>Pilih foto</strong>
                            <input type="file" class="" name="gambar" id="input-foto" placeholder="Masukkan ambar">                            
                          </div>
                          <button type="submit" class="btn btn-primary btn-sm float-right">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>


  {{--  Change pw --}}
  <div class="modal fade" id="changePw" tabindex="-1" role="dialog" aria-labelledby="changePwLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <form action="/simak/ubahpw" method="post">
              @csrf
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="changePwLabel">
                          Ubah password 
                      </h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="password_lama">Password lama</label>
                          <input type="password" class="form-control" placeholder="Masukan password lama.." name="password_lama" id="password_lama">
                      </div>
                      <div class="form-group">
                          <label for="password_baru">Password baru</label>
                          <input type="password" class="form-control" placeholder="Masukan password baru.." name="password_baru" id="password_baru">
                      </div>
                      <div class="form-group">
                          <label for="konfirm_password">Konfirmasi password baru</label>
                          <input type="password" class="form-control" placeholder="Masukan konfirmasi password.." name="konfirm_password" id="konfirm_password">
                      </div>
                      <button type="submit" class="btn btn-primary btn-sm float-right">Save changes</button>
                  </div>
              </div>
          </form>
      </div>
    </div>