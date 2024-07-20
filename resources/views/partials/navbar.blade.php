<nav class="navbar navbar-expand-md bg-dark sticky-top border-bottom" data-bs-theme="dark">
<div class="container">
    <a class="navbar-brand d-md-none" href="#">
        <svg class="bi" width="24" height="24"><use xlink:href="#aperture"/></svg>
    Petualangan Ceria
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLabel">Aperture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav flex-grow-1 justify-content-between align-items-center me-3">
            <li class="nav-item">
                <a class="nav-link" href="{{auth()->check() && auth()->user()->role == "admin" ? '/admin/toys' : '/'}}">
                    <svg class="bi" width="24" height="24"><use xlink:href="#aperture"/></svg>
                </a>
            </li>
            @auth
                @if (auth()->user()->role != "admin")
                <li class="d-flex align-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
                    </svg>
                    <span>Rp{{auth()->user()->money}}</span>
                </li>
                @endif
            @endauth
        @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Welcome back, {{auth()->user()->first_name . ' ' . auth()->user()->last_name}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (auth()->user()->role != "admin")
                    <li class="nav-item px-2"><a class="nav-link" href="/cart/toys">
                        <svg class="bi me-2" width="20" height="20"><use xlink:href="#cart"/></svg>
                    Keranjangmu</a></li>
                    <li><hr class="dropdown-divider"></li>
                    @endif

                    <li class="nav-item ms-1 d-flex align-items-center px-2">
                        <form class="w-100" action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        @else
                <li class="nav-item">
                    <a href="/login" class="text-decoration-none text-light">Login</a>
                </li>
        @endauth
        </ul>
    </div>
    </div>
</div>
</nav>
