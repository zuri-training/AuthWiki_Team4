<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>New Password</title>
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/new_password.css') }}" />
        <link
            rel="shortcut icon"
            href="{{ asset('images/logo.svg') }}"
            type="image/x-icon"
        />
        <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    </head>
    <body>
        <div class="container">
            <main>
                <div>
                    <a href="{{ route('index') }}"><img src="{{ asset('images/logo-title.svg') }}" alt="Auth_wiki" class="img"/></a>
                    <p>You are one step away from your new password, recover your password now.</p>
                </div>

                <div class="footer">
                    
                </div>
                <div class="form-group">
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="field">
                            <input type="password" name="user_email" id="user_email" placeholder="Password" name="password" required autocomplete="current-password">
                        </div>
                        <div class="field">
                            <input type="email" name="user_email" id="user_email" placeholder="Confirm Password">
                        </div>
                        
                        <button class="change" type="submit">Change Password</button>
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
