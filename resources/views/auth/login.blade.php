<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
</head>

<body>
        <p class="first-P"><strong>Great to see you here!</strong></p>
        <div class="login-box">

        <form method="POST" action="{{ route('login')}}">
            @csrf
            <label class="user">Username or Email</label><br>
            <input type="email" class="nput" name="login_id" placeholder="Enter username or email address" size="38" /><br>
            <label class="user">Password</label><br>
            <input type="password" id="password" class="nput" name="password" placeholder="Enter password" size="38"/>
            <i class="bi bi-eye-slash" id="togglePassword"></i><br>
            <input type="checkbox" value="lsRememberMe" id="rememberMe">
            <label for="rememberMe">Remember me</label><br>
            <button class="button" type="submit">Login</button> </div>

            <div class="right-line"></div>
            <p class="continue-with">Continue with</p>
            <div class="left-line"></div>
            <div class="contact">
                <a href="{{ route('login.google') }}" class="fa fa-google"></a>
                <a href="{{ route('login.github') }}" class="fa fa-github"></a>
            </div>
            <p class="lastP">Forgot Password?</p>
            <p class="lastP">
                Not a member yet? <a href="{{ route('register') }}">Sign up</a>
            </p>
        </form>

        <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
