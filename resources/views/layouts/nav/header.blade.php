<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <title>@yield('title', 'AuthWiki')</title>
    @stack('css')
</head>
<body>
    <header>
        <div class="container">
            <div class="site_logo">
                <a href="#"><img src="{{ asset('images/logo-title.svg') }}" width="175" height="43"></a>
            </div>
            
            <div class="nav_container">
                <button id="menu_button">
                    <img src="{{ asset('images/lines.svg') }}">     
                </button>
                <div class="nav_menu">
                    <nav>
                        <ul>
                            <a href="{{ route('page.documentation') }}"><li class="nav_link">Doc</li></a>
                            <a href="#"><li class="nav_link">About</li></a>
                            <span id="current_page_link"><a href="#"><li class="nav_link">Library</li></a></span>
                        </ul>
                    </nav>
                    @auth
                    <div id="nav_secondary">
                        <img src="{{ asset('images/user-icon.svg') }}" class="icon" id="show_profile_menu">
                        <!-- HOVER MENU -->
                        <div id=myHovermenu class="hover_menu" style="display: none;">
                            <div class="hover_menu_item">
                                <a href="#">Profile</a>
                            </div>
                            <div class="hover_menu_item">
                                <a href="#">Settings</a>
                            </div>
                            <div class="hover_menu_item">
                                <img src="{{ asset('images/signout2.svg') }}">
                                <a href="#" id="logoutBtn">Sign out</a>
                            </div>
                        </div>     
                    </div>
                    @endauth
                    @guest
                    <div id="nav_secondary">
                        <a href="{{ route('login') }}">Login</a>
                        <button id="nav_button">Get started <img src="{{ asset('images/caret.svg') }}"></button>
                    </div>
                    @endguest
                </div>  
            </div>   
        </div>
    </header>
    <div id="mySidemenu" class="side_menu">
        <a href="javascript:void(0)" class="closebtn">&times;</a>
        <div class="menu_search" >
            <img src="{{ asset('images/search_icon.svg') }}" alt="search icon" class="search_icon">
            <form action="#" id="menu_search_form" method="GET">
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
            <a href="">Profile</a>
        </div>
        <div class="menu_item">
            <img src="{{ asset('images/settings.svg') }}">
            <a href="">Settings</a>
        </div>
        @endauth
        @guest
        <div class="menu_item">
            <img src="{{ asset('images/login.svg') }}">
            <a href="{{ route('login') }}">Login</a>
        </div>
        <button id="nav_button">Get started <img src="{{ asset('images/caret.svg') }}"></button>
        @endguest
    </div>
    <div>