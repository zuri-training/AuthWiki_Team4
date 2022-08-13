<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <title>Login</title>
  </head>
  <body>
    <main>
      <a href="{{ route('index') }}"><img src="{{ asset('images/logo-title.svg') }}" alt="logo"/></a>
      <h4>Great to see you here!</h4>

      <form action="{{ route('login') }}" method="POST" class="form">
        @csrf
        <label for="username">Username or Email</label>
        <input name="login" value="{{ old('login') }}"
          type="text"
          placeholder="Enter username or email address"
          required
        />

        <label for="password" class="">Password</label>
        <input type="password" name="password" placeholder="Enter password" required/>

        <p>
          <input type="checkbox" name="remember"/> Remember
          Password
        </p>
        <button class="login" type="submit">Login</button>
    </form>
      
      <div class="continue">
        <p>
          <hr class="line"> Continue with <hr class="line">
        </p>
      </div>

      <div class="bottom">
        <div class="contact">
          <div>
            <button data-href="{{ route('login.google') }}"><img src="{{ asset('images/google.svg') }}" alt="google" class="img" /></button>
          </div>

          <div>
            <button data-href="{{ route('login.github') }}">
              <img src="{{ asset('images/github2.svg') }}" alt="github" class="img" />
            </button>
          </div>
        </div>

        <div>
          <a href="{{ route('password.request') }}">Forgot Password?</a>
          <p>Not a member yet? <a href="{{ route('register') }}">Sign Up</a></p>
        </div>
      </div>
    </main>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"> </script>
    <script src="{{ asset('js/toastr.min.js') }}"> </script>
    <script type="text/javascript">
        // const togglePassword = document.querySelector("#togglePassword");
        // const password = document.querySelector("#password");
        // togglePassword.addEventListener("click", function () {
        //     const type = password.getAttribute("type") === "password" ? "text" : "password";
        //     password.setAttribute("type", type);
        //     this.classList.toggle("bi-eye");
        // });
        $('[data-href]').click(function(){
            window.location = $(this).data('href');
        });
        @if($errors->any())

        @foreach($errors->all() as $message)
        toastr.error('{{ $message }}');
        @endforeach

        @endif
    </script>
</body>
</html>
