<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Woods</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('woodo/css/bootstrap.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{asset('woodo/css/style.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('woodo/css/responsive.css')}}">
    <!-- fevicon -->
    <link rel="icon" href="{{asset('woodo/images/fevicon.png')}}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('woodo/css/jquery.mCustomScrollbar.min.css')}}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="{{asset('woodo/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('woodo/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

</head>

<body>
    <!--header section start -->
    <div class="header_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-3">
                    <div class="logo">
                        <h1>BuluTangkis</h1>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-5">
                    <div class="menu-area">
                        <nav class="navbar navbar-expand-lg ">
                            <!-- <a class="navbar-brand" href="#">Menu</a> -->
                            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link active" href="{{ route('index') }}">Home<span
                                                class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('tentang') }}">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('cara-pemesanan') }}">Tata Cara</a>
                                    </li>
                                    <li class="#" href="#">
                                        <a class="nav-link" href="{{ route('booking') }}">Booking</a>
                                    </li>
                                    <li class="#" href="#">
                                        <a class="nav-link" href="{{ route('jadwal') }}">Jadwal</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-8 col-lg-4">
                    <div class="togle_3">

                        <div class="menu_main">
                            @if (Auth::check())
                                <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                                <a href="{{ route('user.keluar') }}" onclick="event.preventDefault(); document.getElementById('keluar').submit();" class="page-scroll ml-2"><i class="fa fa-sign-out"></i> Keluar</a>
                                <form action="{{ route('user.keluar') }}" method="POST" id="keluar">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('masuk') }}"><i class="fa fa-fw fa-user"></i> Login</a>
                                <a href="{{ route('daftar') }}"><i class="fa fa-fw fa-user"></i> Register</a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <!-- banner section start -->
            @yield('content')

        </div>
    </div>

    @yield('content2')

    <!-- copyright section start -->
    <div class="copyright">
        <div class="container">
            <p class="copyright_text">PenulisanIlmiah.2021 Universitas Gunadarma.</p>
        </div>
    </div>
    <!-- copyright section end -->

    <!-- Javascript files-->
    <script src="{{asset('woodo/js/jquery.min.js')}}"></script>
    <script src="{{asset('woodo/js/popper.min.js')}}"></script>
    <script src="{{asset('woodo/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('woodo/js/jquery-3.0.0.min.js')}}"></script>
    <script src="{{asset('woodo/js/plugin.js')}}"></script>
    <!-- sidebar -->
    <script src="{{asset('woodo/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('woodo/js/custom.js')}}"></script>
    <!-- javascript -->
    <script src="{{asset('woodo/js/owl.carousel.js')}}"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('js')
</body>

</html>