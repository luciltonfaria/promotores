<!-- resources/views/partials/header.blade.php -->
<div class="app-header d-flex align-items-center">
    <!-- Toggle buttons starts -->
    <div class="d-flex">
        <button class="toggle-sidebar">
            <i class="ri-menu-line"></i>
        </button>
        <button class="pin-sidebar">
            <i class="ri-menu-line"></i>
        </button>
    </div>
    <!-- Toggle buttons ends -->

    <!-- App brand starts -->
    <div class="app-brand ms-3">
        <a href="{{ url('/') }}" class="d-lg-block d-none">
            <img src="{{ asset('assets/images/logomarca_header.png') }}" class="logo" alt="Medicare Admin Template">
        </a>
        <a href="{{ url('/') }}" class="d-lg-none d-md-block">
            <img src="{{ asset('assets/images/logo-sm.svg') }}" class="logo" alt="Medicare Admin Template">
        </a>
    </div>
    <!-- App brand ends -->

    <!-- App header actions starts -->
    <div class="header-actions">
        <!-- Verifica se o usuário está autenticado -->
        @if(Auth::check())
            <!-- Header user settings starts -->
            <div class="dropdown ms-2">
                <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-box">
                        {{ substr(Auth::user()->name, 0, 2) }}<span class="status busy"></span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow-lg">
                    <div class="px-3 py-2">
                        <span class="small">{{ Auth::user()->role ?? 'User' }}</span>
                        <h6 class="m-0">{{ Auth::user()->name }}</h6>
                    </div>
                    <div class="mx-3 my-2 d-grid">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Header user settings ends -->
        @else
            <!-- Redireciona o usuário para a página de login se não estiver autenticado -->
            <script>
                window.location.href = "{{ route('login') }}";
            </script>
        @endif
    </div>
    <!-- App header actions ends -->
</div>
