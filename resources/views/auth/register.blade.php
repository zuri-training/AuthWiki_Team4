<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}" />
    <title>Sign Up</title>
  </head>
  <body>
    <main>
      <a href="{{ route('index') }}"><img src="{{ asset('images/logo-title.svg') }}" alt="logo" /></a>
      <h4>Create your free account</h4>

      <form action="{{ route('register') }}" method="POST" class="form">
        @csrf
        <label for="name">Full Name</label>
        <input name="name" value="{{ old('name') }}" type="text" placeholder="Enter full name" required />

        <label for="username">Username</label>
        <input type="text" name="user_name" value="{{ old('user_name') }}" placeholder="Enter username" required/>

        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required/>

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter password" required/>

        <p>
          Use 8 or more characters with a mix of letters, numbers and symbols.
          Must not contain your name or username.
        </p>

        <button type="submit" class="login">Create Account</button>
      </form>

      <div class="continue">
        <p></p>
        <hr class="line" />
        Continue with
        <hr class="line" />
      </div>

      <div class="bottom">
        <div class="contact">
          <div>
            <button data-href="{{ route('login.google') }}"><img src="{{ asset('images/google.svg') }}" alt="google" class="img" /></button>
          </div>

          <div>
            <button data-href="{{ route('login.github') }}"><img src="{{ asset('images/github2.svg') }}" alt="github" class="img" /></button>
          </div>
        </div>
      </div>

      <div>
        <p>
          Already have an Auth-Wiki account?
          <a href="{{ route('login') }}">Sign in here</a>
        </p>
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
