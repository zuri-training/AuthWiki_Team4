@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
   
</head>

<body>

    <p class="signup-title"><strong>Create your free account</strong></p>
    <div class="signup-box">
        <form method="POST" action="#">
            <label class="lab">Full Name</label><br>
            <input type="text" class="int" placeholder="Enter username" size="50" required /><br>
            <label class="lab">Username</label><br>
            <input type="text" class="int" placeholder="Enter username" size="50" required /><br>
            <label class="lab">Email</label><br>
            <input type="email" class="int" placeholder="Enter email address" size="50" required /><br>
            <label class="lab">Password</label><br>
            <input type="password" class="int" placeholder="Enter password" size="50"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required /><br>
    </div>
    <p class="guide">Use 8 or more characters with a mix of letters, numbers and<br> symbols. Must not contain your name
        or username.</p>

    <!-- I think this should be added -->
    <!-- <label>Confirm Password</label>
            <input type="password" placeholder="" /> -->

    <button class="button">Create account</button>

    <div class="right-line"></div>
    <p class="continue-with">Continue with</p>
    <div class="left-line"></div>
    <a href="google.com" class="fa fa-google"></a>
    <a href="github.com" class="fa fa-github"></a>


    </form>
    <p class="lastP">
        Already have an Auth-Wiki Account? <a href="{{ url('login') }}">Sign in here</a>
    </p>

</body>

</html>
@endsection
