<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.svg') }}">
    <title>Signup</title>
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
</head>

<body>
  <div class="Enclosure">
    <img src="{{ asset('images/logo-title.svg') }}"/>
    <p class="signup-title">Create your free account</p>
    <div class="signup-box">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label class="lab">Full Name</label><br>
            <input type="text" name="name" class="int" placeholder="Enter Full name" size="50"  /><br>
            <label class="lab">Username</label><br>
            <input type="text" name="user_name" class="int" placeholder="Enter username" size="50"  /><br>
            <label class="lab">Email</label><br>
            <input type="email" name="email" class="int" placeholder="Enter email address" size="50"  /><br>
            <label class="lab">Password</label><br>
            <input type="password" name="password" class="int" placeholder="Enter password" size="50" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  id="myInput">
            {{-- <i class="bi bi-eye-slash" id="togglePassword"></i><br> --}}
          </div>
    <p class="guide">Use 8 or more characters with a mix of letters, numbers and<br> symbols. Must not contain your name
        or username.</p>
    <button class="button" type="submit">Create account</button>

    <div class="right-line"></div>
    <p class="continue-with">Continue with</p>
    <div class="left-line"></div>
    <a href="{{ route('login.google') }}" class="fa fa-google fa-lg"></a>
    <a href="{{ route('login.github') }}" class="fa fa-github fa-lg"></a>


    </form>
    <p class="lastP">
        <a class="btn_tos">Already have an Auth-Wiki Account?</a> <a class="lastlink" href="{{ route('login') }}">Sign in here</a>
    </p>
  </div>
  <script src="{{ asset('js/jquery-3.6.0.min.js') }}"> </script>
  <script src="{{ asset('js/toastr.min.js') }}"> </script>
  <script type="text/javascript">
    $('a.btn_tos').click(function(){
        $.ajax({
            url: '{{ route('settings.tos') }}',
            method: 'POST',
            success: function() {
                window.location = '{{ route('page.tos') }}';
            }
        });
    });
    // const togglePassword = document.querySelector("#togglePassword");
    // const password = document.querySelector("#password");
    // togglePassword.addEventListener("click", function () {
    //     const type = password.getAttribute("type") === "password" ? "text" : "password";
    //     password.setAttribute("type", type);
    //     this.classList.toggle("bi-eye");
    // });
    </script>

</body>

</html>