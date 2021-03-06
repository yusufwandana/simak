<div class="col-xl-6 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-6">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img alt="Image placeholder" class="rounded-circle" src="{{ asset('image/profile/' . auth()->user()->avatar) }}">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    {{-- <div>
                                        <span class="heading">22</span>
                                        <span class="description">Friends</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">Photos</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">Comments</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}<span class="font-weight-light">, 27</span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ $mahasiswa->nim }}
                            </div>
                            <div class="h5 mt-2">
                                <i class="ni business_briefcase-24 mr-2"></i>Semester {{ $mahasiswa->semester->semester}}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>STMIK DHARMA NEGARA BANDUNG
                            </div>

                        </div>
                    </div>
                </div>
            </div>
