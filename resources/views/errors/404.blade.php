<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    <title>Page Not Found</title>
</head>
<body>
    <main class="container">
        <div class="content_container">
            <div class="error_image">
                <img src="{{ asset('images/error/404.svg') }}" alt="Page not found">
            </div>
            <div class="error_msg">
                <h1>404</h1>
                <h3>LOOKS LIKE YOU'RE LOST</h3>
                <p>The page you're looking for is not available.</p>
                <a href="{{ route('index') }}"><button>
                    GO TO HOME
                    <img src="{{ asset('images/arrow.svg') }}">
                </button></a>
            </div>
        </div>
    </main>
</body>
</html>