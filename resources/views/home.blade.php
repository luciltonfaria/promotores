<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Promotor BStars</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery">
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="assets/images/favicon.svg">

    <!-- ************* CSS Files ************* -->
    <link rel="stylesheet" href="assets/fonts/remix/remixicon.css">
    <link rel="stylesheet" href="assets/css/main.min.css">

    <!-- ************* Vendor Css Files ************* -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="assets/vendor/overlay-scroll/OverlayScrollbars.min.css">
  </head>

  <body>

    <!-- Page wrapper starts -->
    <div class="page-wrapper">

         <!-- App header starts -->
         @include('partials.header')
        <!-- App header ends -->


      <!-- Main container starts -->
      <div class="main-container">

            <!-- Sidebar wrapper starts -->
            @include('partials.sidebar')
            <!-- Sidebar wrapper ends -->

        <!-- App container starts -->
        <div class="app-container">

          <!-- App hero header starts -->
          <div class="app-hero-header d-flex align-items-center">

            <!-- Breadcrumb starts -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                <a href="{{ url('/home') }}">Home</a>

              </li>
              <li class="breadcrumb-item text-primary" aria-current="page">
                Dashboard
              </li>
            </ol>
            <!-- Breadcrumb ends -->


          </div>
          <!-- App Hero header ends -->

          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-xxl-12 col-sm-12">
                <div class="card mb-3 bg-3">
                  <div class="card-body">
                    <div class="mh-230">
                      <div class="py-4 px-3 text-white">
                          {{-- No seu arquivo Blade --}}
                          @auth
                            <h6>{{ getGreeting() }}</h6>
                            <h2>{{ Auth::user()->name }}</h2>
                          @endauth  
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <!-- Row ends -->

                      <!-- Row starts -->
                      <div class="row gx-3">

                        <div class="col-xxl-12 col-sm-12">
                          <div class="card mb-3">
                            <div class="card-header">
                              <h5 class="card-title">Visão Geral</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Row ends -->

                      <!-- Row starts -->
                       <div class="card mb-3">
                            <div class="card-header">
                              <h5 class="card-title">Painel Geral</h5>
                            </div>
                            <div class="card-body">

                              <!-- Row start -->
                              <div class="row g-3">
                                <div class="col-sm-6 col-12">
                                  <div class="border rounded-2 d-flex align-items-center flex-row p-2">
                                    <div class="me-2">
                                      <div id="sparkline1"></div>
                                    </div>
                                    <div class="m-0">
                                      <div class="d-flex align-items-center">
                                        <h4 class="m-0 fw-bold">4900</h4>
                                        <div class="ms-2 text-primary d-flex">
                                          <small>20%</small> <i class="ri-arrow-right-up-line ms-1 fw-bold"></i>
                                        </div>
                                      </div>
                                      <small>Clientes</small>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                  <div class="border rounded-2 d-flex align-items-center flex-row p-2">
                                    <div class="me-2">
                                      <div id="sparkline2"></div>
                                    </div>
                                    <div class="m-0">
                                      <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bold">750</div>
                                        <div class="ms-2 text-danger d-flex">
                                          <small>26%</small> <i class="ri-arrow-right-down-line ms-1 fw-bold"></i>
                                        </div>
                                      </div>
                                      <small class="text-dark">Cadastrados no mês</small>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                  <div class="border rounded-2 d-flex align-items-center flex-row p-2">
                                    <div class="me-2">
                                      <div id="sparkline3"></div>
                                    </div>
                                    <div class="m-0">
                                      <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bold">$560</div>
                                        <div class="ms-2 text-primary d-flex">
                                          <small>28%</small> <i class="ri-arrow-right-up-line ms-1 fw-bold"></i>
                                        </div>
                                      </div>
                                      <small class="text-dark">Depositos no mês</small>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                  <div class="border rounded-2 d-flex align-items-center flex-row p-2">
                                    <div class="me-2">
                                      <div id="sparkline4"></div>
                                    </div>
                                    <div class="m-0">
                                      <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bold">$390</div>
                                        <div class="ms-2 text-primary d-flex">
                                          <small>30%</small> <i class="ri-arrow-right-up-line ms-1 fw-bold"></i>
                                        </div>
                                      </div>
                                      <small class="text-dark">Saques no mes</small>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- Row ends -->


                            </div>


                          </div>
                              <!-- Row starts -->
                                <div class="row gx-3">
                                    <div class="col-xxl-12 col-sm-12">
                                      <div class="card mb-3">
                                        <div class="card-header">
                                          <h5 class="card-title">Visão Geral</h5>
                                        </div>

                                    <div class="card-body">
                                        <!-- Row start -->
                                          <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nome</th>
                                                        <th>Email</th>
                                                        <th>Saldo Total</th>
                                                        <th>Criado em</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($lastThirtyUsers as $user)
                                                        <tr>
                                                            <td>{{ $user->user_id }}</td>
                                                            <td>{{ $user->username }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ number_format($user->debit_base, 2, ',', '.') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($user->created)->format('d/m/Y H:i') }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5">Nenhum usuário encontrado.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                          </div>  
                                    </div>      
                              </div>  
                            </div>




                                </div>
                              <!-- Row ends -->
                        </div>



                      </div>

          <!-- App footer starts -->
          <div class="app-footer bg-white">
            <span>BicoStars 2024</span>
          </div>
          <!-- App footer ends -->

        </div>
        <!-- App container ends -->

      </div>
      <!-- Main container ends -->

    </div>
    <!-- Page wrapper ends -->

    <!-- *************
			************ JavaScript Files *************
		************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/moment.min.js"></script>

    <!-- *************
			************ Vendor Js Files *************
		************* -->

    <!-- Overlay Scroll JS -->
    <script src="assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
    <script src="assets/vendor/overlay-scroll/custom-scrollbar.js"></script>

    <!-- Apex Charts -->
    <!-- Apex Charts -->
    <script src="assets/vendor/apex/apexcharts.min.js"></script>
    <script src="assets/vendor/apex/custom/home/patients.js"></script>
    <script src="assets/vendor/apex/custom/home/treatment.js"></script>
    <script src="assets/vendor/apex/custom/home/available-beds.js"></script>
    <script src="assets/vendor/apex/custom/home/earnings.js"></script>
    <script src="assets/vendor/apex/custom/home/gender-age.js"></script>
    <script src="assets/vendor/apex/custom/home/claims.js"></script>

    <!-- Raty JS -->
    <script src="assets/vendor/rating/raty.js"></script>
    <script src="assets/vendor/rating/raty-custom.js"></script>

    <!-- Custom JS files -->
    <script src="assets/js/custom.js"></script>
  </body>

</html>