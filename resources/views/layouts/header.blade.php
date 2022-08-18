<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/be-css.css') }}">
    <title>@yield('title', 'AuthWiki')</title>
    @stack('css')
</head>
<body>
    <header>
        <div class="be_container">
            <div class="site_logo">
                <a href="{{ route('index') }}"><img src="{{ asset('images/logo-title.svg') }}" width="100%" height="100%"></a>
            </div>
            <button id="menu_button">
                <img src="{{ asset('images/lines.svg') }}" width="24" height="24">     
            </button>
            <nav>
                <ul>
                    <li class="nav_link"><a href="{{ route('page.documentation') }}">Doc</a></li>
                    <li class="nav_link"><a href="{{ route('page.about') }}">About</a></li>
                    <li class="nav_link"><a href="{{ route('page.library') }}">Library</a></li>
                    @guest
                    <li class="nav_link"><a href="{{ route('login') }}">Login</a></li>
                    @endguest
                </ul>
                <div id="nav_secondary" style="margin-left: 45px;">
                    @guest
                    <button id="nav_button" data-href="{{ route('register') }}">Get started <img src="{{ asset('images/caret.svg')}}"></button>
                    @endguest
                    @auth
                    <img src="{{ url(Auth::user()->photo) }}" id="be_menu" class="icon be-avatar" width="52" height="52">
                    <!-- HOVER MENU -->
                    <div id=myHovermenu class="hover_menu">
                        <div class="hover_menu_item">
                            <a href="{{ route('user.profile') }}">Profile</a>
                        </div>
                        <div class="hover_menu_item">
                            <a href="{{ route('user.settings') }}">Settings</a>
                        </div>
                        <div class="hover_menu_item">
                            <img src="{{ asset('images/signout2.svg') }}">
                            <a href="javascript:void(0)" id="logoutBtn"><span style= "color: red">Sign out</span></a>
                        </div>
                    </div>     
                    @endauth
                </div>
            </nav>
        </div>
    </header>
    <div id="mySidemenu" class="side_menu">
        <a href="javascript:void(0)" class="closebtn">&times;</a>
        <div class="menu_search" >
            <img src="{{ asset('images/search_icon.svg') }}" alt="search icon" class="search_icon">
            <form action="{{ route('page.library') }}" id="menu_search_form" method="GET">
                @csrf
                <input id="search_field" type="text" name="keyword" placeholder="Search">
            </form>
        </div>      
        <ul class='menu_links'>
            <li style="list-style-image: url('{{ asset('images/home.svg') }}')"><a href="{{ route('index') }}">Home</a></li>
            <li style="list-style-image: url('{{ asset('images/docs.svg') }}')"><a href="{{ route('page.documentation') }}">Doc</a></li>
            <li style="list-style-image: url('{{ asset('images/about.svg') }}')"><a href="{{ route('page.about') }}">About</a></li>
            <li style="list-style-image: url('{{ asset('images/library.svg') }}')"><a href="{{ route('page.library') }}">Library</a></li>
            @auth
            <li style="list-style-image: url('{{ asset('images/profile.svg') }}')"><a href="{{ route('user.profile') }}">Profile</a></li>
            <li style="list-style-image: url('{{ asset('images/settings.svg') }}')"><a href="{{ route('user.settings') }}">Settings</a></li>
            <li style="list-style-image: url('{{ asset('images/signout.svg') }}')"><a href="javascript:void(0)" id="logoutBtn" style= "color: red">Sign out</a></li>
            @endauth
            @guest
            <li style="list-style-image: url('{{ asset('images/login.svg') }}')"><a id href="{{ route('login') }}">Login</a></li>
            @endguest
        </ul>
        @guest
        <button data-href="{{ route('register') }}">Get started</button>
        @endguest
    </div>
    <div class="be-container">
