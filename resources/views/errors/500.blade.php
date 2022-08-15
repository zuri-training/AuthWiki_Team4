<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    <title>Server Error</title>
</head>
<body>
    <main class="container">
        <div class="content_container">
            <div class="error_image">
                <img src="{{ asset('images/error/500.svg') }}" alt="Server error">
            </div>
            <div class="error_msg">
                <h1>500</h1>
                <h3>Server Error</h3>
                <p>Oops! Something went wrong. Try and refresh this page.</p>
                <a href="{{ route('index') }}"><button>
                    GO TO HOME
                    <img src="{{ asset('images/arrow.svg') }}">
                </button></a>
            </div>
        </div>
    </main>
</body>
</html>