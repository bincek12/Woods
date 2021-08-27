<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ََBuluTangkis Register</title>
    <link rel="stylesheet" href="{{asset('woodo/register.css')}}">
  </head>
  <body>
      
      @if (session('message_success'))
          <ol class="breadcrumb" style="background-color: green; color: #fff;">
              <li class="">{{ session('message_success') }}</li>
          </ol>
      @endif
      
      @if (session('message_fail'))
          <ol class="breadcrumb" style="background-color: #ff5d56; color: #fff;">
              <li class="">{{ session('message_fail') }}</li>
          </ol>
      @endif

      

    <form action="{{ route('user.daftar') }}" method="POST" id="daftar-form" class="box">

        @csrf
  <h1>Register</h1>
  <input type="text" name="nama" placeholder="Nama Lengkap">
  @error('nama')
        <div class="invalid-feedback" style="color: red">{{ $message }}</div>
    @enderror
  <input type="text" name="email" placeholder="Email">
  @error('email')
        <div class="invalid-feedback" style="color: red">{{ $message }}</div>
    @enderror
  <input type="text" name="no_hp" placeholder="Nomor Telpon">
  @error('no_hp')
        <div class="invalid-feedback" style="color: red">{{ $message }}</div>
    @enderror
  <input type="text" name="username" placeholder="Username">
  @error('username')
        <div class="invalid-feedback" style="color: red">{{ $message }}</div>
    @enderror
  <input type="password" name="password" placeholder="Password">
  @error('password')
        <div class="invalid-feedback" style="color: red">{{ $message }}</div>
    @enderror
  <input type="submit" name="" value="Register">
</form>


  </body>
</html>
