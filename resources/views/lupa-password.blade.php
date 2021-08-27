@extends('layout.arifmou')

@section('navbar')

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url('/#tentang') }}" class="page-scroll">Tentang</a></li>
        <li><a href="{{ url('/#cara-pemesanan') }}" class="page-scroll">Cara Pemesanan</a></li>
        <li><a href="{{ route('booking') }}" class="page-scroll">Booking</a></li>
        <li><a href="{{ route('jadwal') }}" class="page-scroll">Jadwal</a></li>

        @if (Auth::check())  
            <li><a href="{{ route('dashboard') }}" class="page-scroll">Dashboard</a></li>
            <li><a href="{{ route('user.keluar') }}" onclick="event.preventDefault(); document.getElementById('keluar').submit();" class="page-scroll">Keluar <i class="fa fa-arrow-right"></i></a></li>
            <form action="{{ route('user.keluar') }}" method="POST" id="keluar">
                @csrf
            </form>
        @else
            <li><a href="{{ route('masuk') }}" class="page-scroll">Masuk</a></li>
            <li><a href="{{ route('daftar') }}" class="page-scroll">Daftar</a></li>
        @endif

        </ul>
    </div>

@endsection

@section('content')

  <!-- Booking Section -->
  <div id="booking">
    <div class="section-title text-center center">
      <div class="overlay">
        <h2>Lupa Password</h2>
        <hr>
        <p>Lupa Password Minisoccer ArifMou Sport Center.</p>
      </div>
    </div>
    <div class="container">
        <h3>Lupa Password?</h3>
        <div class="col-xs-12 col-sm-6">
            @if (session('message_success'))
                <ol class="breadcrumb" style="background-color: green; color: #fff;">
                    <li class="">{{ session('message_success') }}</li>
                </ol>
            @endif

            @if (session('status'))
					<ol class="breadcrumb" style="background-color: green; color: #fff;">
						<li class="">{{ session('status') }}</li>
					</ol>
				@endif
            
            @if (session('message_fail'))
                <ol class="breadcrumb" style="background-color: #ff5d56; color: #fff;">
                    <li class="">{{ session('message_fail') }}</li>
                </ol>
            @endif

            <form action="{{ route('password.email') }}" method="POST" id="forgot-form">
                @csrf

                <div class="mb-2">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Alamat Email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>

                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="submit" value="Kirim" onclick="event.preventDefault(); document.getElementById('forgot-form').submit();" class="btn btn-success btn-block">
                        </div>
                    </div>
                </div>
                <a href="{{ route('daftar') }}">Buat akun baru?</a>
            </form>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="about-img"><img src="{{asset('arifmou/img/tentang.jfif')}}" style="width: 500px; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;" class="img-responsive" alt=""></div>
        </div>
    </div>
  </div>

@endsection

@section('js')
	
	<script>

	</script>

@endsection