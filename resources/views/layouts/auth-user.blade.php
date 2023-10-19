<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ontraffic.vn - Dịch vụ tăng traffic nhanh chóng, hiệu quả</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('client/images/fav-icon.png') }}">
    <meta property="og:title" content="Dịch vụ tăng traffic nhanh chóng, hiệu quả - ontraffic.vn">
    <meta property="og:description"
        content="Tăng traffic cho website nhanh chóng và hiệu quả với chi phí tối ưu, đa dạng các loại hình dịch vụ và chất lượng dịch vụ tốt nhất đến từ ontraffic.vn">
    <meta property="og:image" content="{{ asset('client/images/thumnail-website.png') }}">
    <meta property="og:image:alt" content="ontraffic.vn">
    <meta property="og:site_name" content="ontraffic.vn">
    <meta property="og:url" content="https://ontraffic.vn">
    <meta property="og:type" content="website">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/general.css') }}">
    @yield('css')
    <style>
        #app {
            height: 100vh;
            display: flex;
            align-items: center;
            background: url({{ asset('client/images/white-background.png') }});
            background-size: 100% 100%;
        }

        .form-group-password {
            position: relative;
        }

        .toggle-show-password {
            position: absolute;
            top: 3px;
            right: 9px;
            color: #6d757d;
            cursor: pointer;
            padding: 9px;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 mb-2 mb-md-0">
                    <img class="img-fluid" src="{{ asset('client/images/thumnail-website.png') }}" alt="">
                </div>
                <div class="col-12 col-md-5">
                    <div class="card mt-2 shadow card-gray border-0 bd-style-1">
                        <div class="card-body text-left">
                            <div class="text-center">
                                <img src="{{ asset('client/images/logo-ontraffic.png') }}" alt=""
                                    class="w-50">
                            </div>
                            @yield('form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="online-status"></div>
    <script src="{{ asset('jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('status-online.js') }}"></script>
    <script src="{{ asset('client/js/auth-user.js') }}"></script>
    @yield('js')
</body>

</html>
