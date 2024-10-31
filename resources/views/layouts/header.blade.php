<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Altf4 Yazılım" name="description" />
    <meta content="Altf4 L-MasterBM" name="author" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <link href="{{ asset('assets/libs/metrojs/release/MetroJs.Full/MetroJs.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark">
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box">
                        <a href="{{ route('dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('images/logo.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('images/logo.png') }}" alt="" height="55px">
                            </span>
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </div>
                <div class="search-wrap" id="search-wrap">
                    <div class="search-bar">
                        <input class="search-input form-control" placeholder="Search" />
                        <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                            <i class="mdi mdi-close-circle"></i>
                        </a>
                    </div>
                </div>

                <div class="d-flex">


                    <!----
                      
                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="modal" data-bs-target="#smsModal">
                            <i class="mdi mdi-email"></i>
                            <span class="badge bg-danger rounded-pill">100</span>
                        </button>
                    </div>
                    
                    <div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="smsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="smsModalLabel">SMS Bilgisi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe src="http://ustapos.com/extension/services.php?subDomain=yenihali.ustapos.com" width="100%" height="400" frameborder="0"></iframe>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .modal-dialog {
                            max-width: 90%;
                        }
                        .modal-lg {
                            max-width: 90%;
                        }

                        .modal-content {
                            border-radius: 10px;
                        }

                        .modal-backdrop {
    --bs-backdrop-zindex: 1040;
    --bs-backdrop-bg: #000;
    --bs-backdrop-opacity: 0.5;
    position: inherit !important;
    top: 0;
    left: 0;
    z-index: var(--bs-backdrop-zindex);
    width: 100vw;
    height: 100vh;
    background-color: var(--bs-backdrop-bg);
}
                    </style>
                    

                 ---->
                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown">
                            <i class="mdi mdi-calendar-check"></i>
                            <span class="badge bg-danger rounded-pill">5</span>
                        </button>
                    </div>


                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="mdi mdi-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect user-step" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#"><i class="dripicons-user d-inline-block text-muted me-2"></i> Profil</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-wallet d-inline-block text-muted me-2"></i> Cüzdanım</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-lock d-inline-block text-muted me-2"></i> Ekranı Kilitle</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i class="dripicons-exit d-inline-block text-muted me-2"></i> Çıkış Yap</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">{{ config('app.name') }}</li>

                        <li>
                            <a href="{{ route('dashboard') }}" class="waves-effect">
                                <i class="mdi mdi-chart-areaspline"></i>
                                <span>Analiz</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('settings') }}" class="waves-effect">
                                <i class="mdi mdi-cog-outline"></i>
                                <span>Genel Ayarlar</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('users') }}" class="waves-effect">
                                <i class="mdi mdi-account-settings-outline"></i>
                                <span>Kullanıcı Ayarları</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('services') }}" class="waves-effect">
                                <i class="mdi mdi-package-variant-closed"></i>
                                <span>Hizmetler</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('tables') }}" class="waves-effect">
                                <i class="mdi mdi-table"></i>
                                <span>Senans Oda Listesi</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('reservations') }}" class="waves-effect">
                                <i class="mdi mdi-calendar-check"></i>
                                <span>Rezervasyon Listesi</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('feedbacks') }}" class="waves-effect">
                                <i class="mdi mdi-comment-alert-outline"></i>
                                <span>Geri Bildirimler</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('customers') }}" class="waves-effect">
                                <i class="mdi mdi-account-multiple-outline"></i>
                                <span>Müsteri Listesi</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('employees') }}" class="waves-effect">
                                <i class="mdi mdi-account-group-outline"></i>
                                <span>Personel Listesi</span>
                            </a>
                        </li>

                        <!---Kampanya --->

                        <li>
                            <a href="{{ route('campaigns') }}" class="waves-effect">
                                <i class="mdi mdi-bell-ring"></i>
                                <span>Kampanyalar</span>
                            </a>
                        </li>




                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>