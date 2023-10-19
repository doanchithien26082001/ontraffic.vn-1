<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ontraffic.vn - Dịch vụ tăng traffic nhanh chóng, hiệu quả</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/client/images/fav-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/client/css/general.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" />
    @yield('css')
    <link rel="stylesheet" href="{{ asset('/client/css/responsive.css') }}">
    @yield('js-head')
</head>

<body>
    <div id="app" class="full-height">
        <!-- HEADER -->
        <div class="header pt-3 pb-5">
            <div class="top-sidebar">
                <div class="container pb-4">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <a href="{{ route('userDashboard') }}" class="logo-site">
                                <img src="{{ asset('/client/images/logo-ontraffic-white.png') }}" alt="">
                            </a>
                            <x-menu-header></x-menu-header>
                            <div class="info-user d-none d-lg-block"><span class="mr-2">Hi,</span> <strong
                                    class="username ml-2">{{ Auth::user()->name }}</strong>
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                                <div class="card shadow-lg animate__animated">
                                    <x-menu-user-hover></x-menu-user-hover>
                                </div>
                            </div>
                            <div class="mobile-menu-icon d-block d-lg-none">
                                <i class="bi bi-text-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="site-map">
                            <h3 class="font-bold mb-1 text-white">Hệ thống</h3>
                            @yield('breadcrumb')
                        </div>
                        <div class="contact-letegram d-none d-md-block">
                            <a href="" class="btn btn-primary bd-style-2">Group Telegram</a>
                            <a href="" class="btn btn-secondary text-dark bg-white bd-style-2">Tin nhắn
                                Telegram</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTENT -->
        <div class="page-content">
            <div class="content container">
                @yield('content')
            </div>
        </div>
        <!-- SUB ELEMENT -->
        <div class="overlay"></div>
        <x-mobile-menu></x-mobile-menu>
    </div>
    <div id="online-status"></div>
    @yield('js-before')
    <script src="{{ asset('/jquery-3.7.0.min.js') }} "></script>
    <script src="{{ asset('/client/js/general.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('status-online.js') }}"></script>
    @yield('js')
</body>

</html>
