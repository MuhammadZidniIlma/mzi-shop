<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">MZI Shop<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item {{ Request::routeIs('shop') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                </li>
                <li class="nav-item {{ Request::routeIs('about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('about') }}">About us</a>
                </li>
                <li class="nav-item {{ Request::routeIs('service') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('service') }}">Services</a>
                </li>
                <li class="nav-item {{ Request::routeIs('blog') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                </li>
                <li class="nav-item {{ Request::routeIs('contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('contact') }}">Contact us</a>
                </li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                @guest
                    <li><a class="btn btn-primary d-flex align-items-center" href="{{ route('login') }}"
                            style="border: 2px solid #ffffffed; height: 40px; ">Login</a>
                    </li>
                @else
                    <li class="nav-item navbar-dropdown dropdown-user dropdown d-flex align-items-center">
                        <a class="nav-link dropdown-toggle-hide-arrow p-0" data-bs-toggle="dropdown">
                            <img src="{{ Auth::user()->avatar ? asset('profile/' . Auth::user()->avatar) : asset('profile/default.png') }}"
                                alt class="w-px-40 rounded-circle"
                                style="width: 32px; height: 32px; border: 1px solid #ffffff; cursor: pointer" />
                        </a>

                        <ul class="dropdown-menu ">
                            <li>
                                <div class="dropdown-item d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ Auth::user()->avatar ? asset('profile/' . Auth::user()->avatar) : asset('profile/default.png') }}"
                                                alt class="w-px-40 rounded-circle" style="width: 40px; height: 40px" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-capitalize">
                                        <h6 class="mb-0">{{ Auth::user()->username }}</h6>
                                        <small class="text-muted">{{ Auth::user()->role }}</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider my-1"></div>
                            </li>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pegawai')
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="bx bx-user bx-md me-3"></i><span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="bx bx-user bx-md me-3"></i><span>My Profile</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->role == 'customer')
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.home') }}">
                                        <i class="bx bx-user bx-md me-3"></i><span>My Profile</span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a class="dropdown-item" href="{{ route('checkOrderStatus') }}">
                                    <i class="bx bx-user bx-md me-3"></i><span>Check Order Status</span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider my-1"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endguest
                <li>
                    <a class="nav-link position-relative" href="{{ route('trolly') }}"><img
                            src="{{ asset('images/cart.svg') }}">
                        <span class="badge badge-center rounded-pill bg-danger"
                            style="position: absolute; bottom: 0; right: 0;">{{ $countTrolly }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
