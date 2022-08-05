<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">

</head>

<body>

    <p class="signup-title"><strong>Create your free account</strong></p>
    <div class="signup-box">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label class="lab">Full Name</label><br>
            <input type="text" class="int" name="name" placeholder="Enter username" size="50" required /><br>
            <label class="lab">Username</label><br>
            <input type="text" class="int" name="user_name" placeholder="Enter username" size="50" required /><br>
            <label class="lab">Email</label><br>
            <input type="email" class="int" name="email" placeholder="Enter email address" size="50" required /><br>
            <label class="lab">Password</label><br>
            <input type="password" class="int" name="password" placeholder="Enter password" size="50"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required /><br>
    </div>
    <p class="guide">Use 8 or more characters with a mix of letters, numbers and<br> symbols</p>
    <button class="button" type="submit">Create account</button>

    <div class="right-line"></div>
    <p class="continue-with">Continue with</p>
    <div class="left-line"></div>
    <a href="{{ route('login.google') }}" class="fa fa-google"></a>
    <a href="{{ route('login.github') }}" class="fa fa-github"></a>
    </form>
    <p class="lastP">
        Already have an Auth-Wiki Account? <a href="{{ route('login') }}">Sign in here</a>
    </p>

</body>

</html>
