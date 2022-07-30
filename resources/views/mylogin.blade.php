@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Login</title>
     
</head>

<body>
    {{-- <script src="{{ asset('js/login.js') }}" defer></script> --}}
    
        <p class="first-P"><strong>Great to see you here!</strong></p>
        <div class="login-box">

        <form method="POST" action="#">
        @csrf
            <label class="user">Username or Email</label><br>
            <input type="email" class="nput" placeholder="Enter username or email address" size="38" /><br>
            <label class="user">Password</label><br>
            <input type="password" class="nput" placeholder="Enter password" size="38"/>
            <i class="bi bi-eye-slash" id="togglePassword" onclick="myFunction()"></i><br>
            <input type="checkbox" value="lsRememberMe" id="rememberMe">
            <label for="rememberMe">Remember me</label><br>
            <button class="button" onclick="">Login</button> </div>

            <div class="right-line"></div>
            <p class="continue-with">Continue with</p>
            <div class="left-line"></div>
        <div class="contact">
            <a href="google.com" class="fa fa-google"></a>
            <a href="github.com" class="fa fa-github"></a>
            
        </div>
            
            
            </form>
            <p class="lastP">Forgot Password?</p>
            <p class="lastP">
                Not a member yet? <a href="signup.html">Sign up</a>
            </p>
        </form>

 
</body>

</html>
@endsection
