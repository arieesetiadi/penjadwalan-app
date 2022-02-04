<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--plugins-->
    <link href="{{ asset('plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    {{-- ajax header --}}
    <meta id="csrf-token" content="{{ csrf_token() }}">

    <!-- loader-->
    <link href="{{ asset('css/pace.min.css') }}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{ asset('css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/header-colors.css') }}" rel="stylesheet" />

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>{{ $title ??= 'Title' }} | Kominfo Denpasar</title>
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper toggled">
        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-icon fs-3">
                    <i class="bi bi-list"></i>
                </div>
                {{-- <form class="searchbar">
            <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
            <input class="form-control" type="text" placeholder="Type here to search">
            <div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i>
            </div>
        </form> --}}
                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item search-toggle-icon">
                            <a class="nav-link" href="#">
                                <div class="">
                                    <i class="bi bi-search"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-user-setting">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                                data-bs-toggle="dropdown">
                                <div class="user-setting d-flex align-items-center">
                                    @if (auth()->user()->gender == 'Pria')
                                        <img src="{{ asset('images/avatars/man.png') }}" alt=""
                                            class="rounded-circle" width="35" height="35">
                                    @else
                                        <img src="{{ asset('images/avatars/woman.png') }}" alt=""
                                            class="rounded-circle" width="35" height="35">
                                    @endif
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <div class="d-flex align-items-center">
                                        @if (auth()->user()->gender == 'Pria')
                                            <img src="{{ asset('images/avatars/man.png') }}" alt=""
                                                class="rounded-circle" width="54" height="54">
                                        @else
                                            <img src="{{ asset('images/avatars/woman.png') }}" alt=""
                                                class="rounded-circle" width="54" height="54">
                                        @endif
                                        <div class="ms-3">
                                            <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}</h6>
                                            <small
                                                class="mb-0 dropdown-user-designation text-secondary">{{ auth()->user()->role->name }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-user-profile.html">
                                        <div class="d-flex align-items-center">
                                            <div class=""><i class="bi bi-person-fill"></i></div>
                                            <div class="ms-3"><span>Profile</span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <div class="d-flex align-items-center">
                                            <div class=""><i class="bi bi-lock-fill"></i></div>
                                            <div class="ms-3"><span>Logout</span></div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!--end top header-->

        <!--start sidebar -->
        <aside class="semi-dark sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ asset('images/icons/kominfo-dps.png') }}" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h5 class="logo-text">KOMINFO</h5>
                </div>
                <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                {{-- <li class="mm-active">
                    <a href="javascript:;" class="" aria-expanded="true">
                        <div class="parent-icon"><i class="bi bi-house-fill"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                    <ul>
                        <li class="mm-active"> <a href="#"><i class="bi bi-circle"></i>Email</a>
                        </li>
                        <li> <a href="#"><i class="bi bi-circle"></i>Chat Box</a>
                        </li>
                    </ul>
                </li> --}}

                <li>
                    <a href="/" class="" aria-expanded="true">
                        <div class="parent-icon"><i class="bi bi-house-fill"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li class="menu-label">Penjadwalan</li>
                <li>
                    <a href="#">
                        <div class="parent-icon"><i class="bi bi-card-list"></i>
                        </div>
                        <div class="menu-title">Request</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="parent-icon"><i class="bi bi-card-checklist"></i>
                        </div>
                        <div class="menu-title">Jadwal</div>
                    </a>
                </li>
                <li class="menu-label">Pengguna</li>
                <li>
                    <a href="{{ route('user.index') }}">
                        <div class="parent-icon"><i class="bi bi-people-fill"></i>
                        </div>
                        <div class="menu-title">Kelola Pengguna</div>
                    </a>
                </li>
            </ul>
            <!--end navigation-->
        </aside>

        <!--end sidebar -->
