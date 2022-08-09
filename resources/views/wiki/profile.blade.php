<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Profile</title>
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
        <link
            rel="shortcut icon"
            href="{{ asset('images/favicon.svg') }}"
            type="image/x-icon"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;display=swap"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap"
        />
    </head>
    <body>
        <main>
            <div class="div1">
                <div>
                    <img
                        src="{{ asset('images/indiana.png') }}"
                        alt="profile picture"
                        class="img"
                    />
                </div>

                <h4>Indiana Walters</h4>
                <p>waltersindiana@gmail.com</p>
                <p>Website Developer</p>
                <button>
                    Edit Profile
                    <img
                        src="{{ asset('images/edit.svg') }}"
                        alt="edit"
                        style="width: 12px; height: 12px"
                    />
                </button>
                <p>
                    <img
                        src="{{ asset('images/calendar.svg') }}"
                        alt="calendar"
                        style="width: 15px; height: 15px; padding-right: 5px"
                    />
                    Joined 2 seconds ago
                </p>
            </div>

            <div class="div2">
                <div>
                    <p class="div2p">
                        <img
                            src="{{ asset('images/website.svg') }}"
                            alt="website"
                            class="icon"
                        />
                        Website<a href=""> indianwalts@wix.com</a>
                    </p>
                </div>

                <hr />

                <div>
                    <p class="div2p">
                        <img
                            src="{{ asset('images/github.svg') }}"
                            alt="github"
                            class="icon"
                        />
                        Github <a href=""> Waltersdiana__</a>
                    </p>
                </div>

                <hr />

                <div>
                    <p class="div2p">
                        <img
                            src="{{ asset('images/twitter2.svg') }}"
                            alt="twitter"
                            class="icon"
                        />
                        Twitter <a href=""> Waltersdiana__</a>
                    </p>
                </div>
            </div>

            <div class="div3">
                <h4 class="div3h4">Explore Documentation</h4>
                <p class="div3p">You have not explored any auth codes yet.</p>

                <h4 class="div3h4">Downloaded auth code samples</h4>
                <p class="div3p">
                    You have not downloaded any auth codes samples.
                </p>

                <h4 class="div3h4">Auth codes details you commented on</h4>
                <p class="div3p">
                    You have not commented on any auth codes details.
                </p>
            </div>
        </main>
    </body>
</html>
