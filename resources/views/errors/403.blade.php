<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/error/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    <title>Access Denied</title>
</head>
<body>
    <main class="container">
        <div class="content_container">
            <div class="error_image">
                <img src="{{ asset('images/error/403.svg') }}" alt="Access denied">
            </div>
            <div class="error_msg">
                <h1>403</h1>
                <h3>ACCESS DENIED</h3>
                <p>You are not allowed to access this address..</p>
                <a href="{{ route('index') }}"><button>
                    GO TO HOME
                    <img src="{{ asset('images/arrow.svg') }}">
                </button></a>
            </div>
        </div>
    </main>
</body>
</html>