<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.svg') }}">
    @stack('head')
    <script src="{{ asset('js/header.js') }}"></script>
    <title>@yield('title', 'AuthWiki')</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="site_logo">
                <a href="#"><img src="{{ asset('images/logo.svg') }}" width="175" height="43"></a>
            </div>
            
            <div class="nav_container">
                <button id="menu_button" onclick="openNav()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 12C0 13.1046 0.895431 14 2 14H22C23.1046 14 24 13.1046 24 12C24 10.8954 23.1046 
                        10 22 10H2C0.89543 10 0 10.8954 0 12ZM0 22C0 23.1046 0.895431 24 2 24H12H22C23.1046 24 24 23.1046 24 
                        22C24 20.8954 23.1046 20 22 20H12H2C0.895431 20 0 20.8954 0 22ZM2 0C0.89543 0 0 0.895431 0 2C0 3.10457
                         0.895431 4 2 4H22C23.1046 4 24 3.10457 24 2C24 0.895431 23.1046 0 22 0H2Z" fill="#284E6B"/>
                    </svg>     
                </button>
                <div class="nav_menu">
                    <nav>
                        <ul>
                            <a href="{{ route('page.documentation') }}"><li class="nav_link">Doc</li></a>
                            <a href="#"><li class="nav_link">About</li></a>
                            <span id="current_page_link"><a href="#"><li class="nav_link">Library</li></a></span>
                        </ul>
                    </nav>
        
                    <div id="nav_secondary">
                        <a href="{{ route('login') }}">Login</a>
                        <button id="nav_button">Get started <img src="{{ asset('images/caret.svg') }}"></button>
                    </div>
                </div>  
            </div>   
        </div>
    </header>
    <div id="mySidemenu" class="side_menu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="menu_search" >
            <img src="{{ asset('images/search_icon.svg') }}" alt="search icon" class="search_icon">
            <form action="#" id="menu_search_form" onchange="submit_form()" method="GET">
                <input id="search_field" type="text" placeholder="Search">
            </form>
        </div>
        
        <div class="menu_item">
            <img src="{{ asset('images/home.svg') }}">
            <a href="#">Home</a>
        </div>
        <div class="menu_item">
            <img src="{{ asset('images/docs.svg') }}">
            <a href="{{ route('page.documentation') }}">Doc</a>
        </div>
        <div class="menu_item">
            <img src="{{ asset('images/resources.svg') }}">
            <a href="#">About</a>
        </div>
        <div class="menu_item">
            <img src="{{ asset('images/library.svg') }}">
            <a href="#">Library</a>
        </div>
        @auth
        <div class="menu_item">
            <img src="{{ asset('images/profile.svg') }}">
            <a href="{{ route('profile.index') }}">Profile</a>
        </div>
        <div class="menu_item">
            <img src="{{ asset('images/settings.svg') }}">
            <a href="{{ route('profile.setting') }}">Settings</a>
        </div>
        @endauth
        @guest
        <div class="menu_item">
            <img src="{{ asset('images/login.svg') }}">
            <a href="{{ route('login') }}">Login</a>
        </div>
        @endguest
        @auth
        <div class="menu_item">
            <img src="{{ asset('images/signout.svg') }}">
            <a href="javascript:void(0)" onclick="logout();">Sign out</a>
            <form action="{{ route('logout') }}" method="GET" id="logoutForm">
                @csrf
            </form>
        </div>
        @endauth
        <button>Get started</button>
    </div>
    <div style="padding-top: 110px">