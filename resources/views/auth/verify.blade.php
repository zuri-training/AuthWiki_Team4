<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon"/>
        <title>Verification</title>
        <link rel="stylesheet" href="{{ asset('css/verification.css') }}" />
    </head>
    <body>
        <div class="alpha">
            <main>
                <div>
                    <img src="{{ asset('images/envelope.svg') }}" alt="envelope" class="img" />
                </div>

                <h4>Email Verification</h4>

                <hr />

                <p class="p1">
                    In order to start using Authwiki, you need to confirm your
                    email address.
                </p>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button class="verify" type="submit">Verify Email Address</button>
                </form>

                <hr class="hr" />

                <p>Once your email address is verified, you're all set.</p>

                <h5>Stay in touch</h5>

                <div class="div1">
                    <div>
                        <button class="social">
                            <img src="{{ asset('images/twitter.svg') }}" alt="twitter"/>
                        </button>
                    </div>

                    <div>
                        <button class="social">
                            <img src="{{ asset('images/slack.svg') }}" alt="slack" class="icon"/>
                        </button>
                    </div>

                    <div>
                        <button class="social">
                            <img src="{{ asset('images/gmail.svg') }}" alt="gmail" class="icon" />
                        </button>
                    </div>
                </div>
            </main>
        </div>
        @if (session('resent'))
            <script type="text/javascript">
                let noti = 'A fresh verification link has been sent to your email address.';
                console.log(noti);
            </script>
        @endif
    </body>
</html>
