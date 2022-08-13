<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>New Password</title>
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
        <link
            rel="shortcut icon"
            href="{{ asset('images/logo.svg') }}"
            type="image/x-icon"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap"
        />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
                    <p>You are one step away from your new password, recover your password now.</p>
                </div>

                <div class="footer">

                </div>
                <div class="form-group">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="field">
                            <input type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus id="user_email" placeholder="Enter your email">
                        </div>
                        <div class="field">
                            <input type="password" name="password" required autocomplete="new-password" id="pwd" placeholder="Password">
                        </div>
                        <div class="field">
                            <input type="password" name="password_confirmation" required autocomplete="new-password" id="pwd" placeholder="Re-type Password">
                        </div>
                        <button class="change" type="submit">Reset Password</button>
                        <div class="link">
                            <a href="{{ route('login') }}"> Login</a>
                        </div>
                    </form>
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
    </body>
</html>
