<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.svg') }}">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
</head>

<body>
    <main>
        <div class="Enclosure">
        <img src="{{ asset('images/logo-title.svg') }}"/>
        <p class="first-P">Great to see you here!</p>
        <div class="login-box">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label class="user">Username or Email</label><br>
            <input name="login" class="nput" placeholder="Enter username or email address" size="38" required/><br>
            <label class="user">Password</label><br>
            <input type="password" name="password" class="nput" placeholder="Enter password" size="38" id="password">
            <i class="bi bi-eye-slash" id="togglePassword"></i><br>
            <input type="checkbox" value="lsRememberMe" id="rememberMe" class="IsRem">
            <label for="rememberMe" class="remember-me">Remember Password</label><br>
            <button class="button" type="submit">Login</button> </div>

            <div class="right-line"></div>
            <p class="continue-with">Continue with</p>
            <div class="left-line"></div>
        <div class="contact">
            <a href="{{ route('login.google') }}" class="fa fa-google fa-lg"></a>
            <a href="{{ route('login.github') }}" class="fa fa-github fa-lg"></a>
            
        </div>
        
            
            
            </form>
            <p class="lastP"><a href="{{ route('password.request') }}">Forgot Password?</a></p>
            <p class="lastB">
                Not a member yet? <a class="lastlink" href="{{ route('register') }}">Sign up</a>
            </p>
        </form>
    </div>
    </main>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"> </script>
    <script src="{{ asset('js/toastr.min.js') }}"> </script>
    <script type="text/javascript">
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");
    togglePassword.addEventListener("click", function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        this.classList.toggle("bi-eye");
    });
    @if($errors->any())

    @foreach($errors->all() as $message)
    toastr.error('{{ $message }}');
    @endforeach

    @endif
</script>
</body>

</html>