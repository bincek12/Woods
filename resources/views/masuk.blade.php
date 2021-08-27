<!DOCTYPE html>
<div id="login"></div>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َBuluTangkis Login</title>
    <link rel="stylesheet" href="{{asset('woodo/login.css')}}">
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

        
<form action="{{ route('user.masuk') }}" method="POST" id="login-form" class="box">
                @csrf


  <h1>Login</h1>
  <input type="text" name="username" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <input type="submit" value="Login">
</form>


  </body>
</html>
