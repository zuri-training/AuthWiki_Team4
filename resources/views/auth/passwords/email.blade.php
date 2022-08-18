<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reset Password</title>
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/reset_password.css') }}" />
        <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon"/>
    </head>
    <body>
        <div class="container">
            <main>
                <div>
                    <a href="{{ route('index') }}"><img
                        src="{{ asset('images/logo-title.svg') }}"
                        alt="Auth_wiki"
                        class="img"
                    /></a>
                </div>
                <h4>Reset Password</h4>
                <div class="form-group">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <label for="username">Email Address</label>
                        <input type="email" name="email" id="user_email" placeholder="Enter email address" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <button class="reset" type="submit">Reset Password</button>
                    </form>
                    <div class="footer">
                        <p>Not a member yet? <a href="{{ route('register') }}">Sign Up</a></p>
                    </div>
                </div>
            </main>
        </div>

        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"> </script>
        <script src="{{ asset('js/toastr.min.js') }}"> </script>
        <script type="text/javascript">
        @if($errors->any())
    
        @foreach($errors->all() as $message)
        toastr.error('{{ $message }}');
        @endforeach
    
        @endif
        @if (session('status'))
            toastr.success('{{ session('status') }}');
        @endif
    </script>
    

    </body>
</html>
