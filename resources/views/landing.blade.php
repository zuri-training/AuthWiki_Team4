@extends('layouts.master')

@section('title', 'Auth-wiki')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
    <!--hero start-->
<section style="margin-top: -45px;">               
    <div class="hero">

        <div id="hero-text">
            <h3>Authentications made easy<br>with our vast component<br>library for auth codes.</h3>
            <p>The largest authentication code library in 2022.</p>
            <button data-href="{{ route('register') }}">Get Started for Free</button> 
        </div>
        <div id="hero-img"><img src="{{ asset('images/undraw_pair_programming_re_or4x.svg') }}"></div>

    </div>
</section>                          
    <!--hero end-->
    <!--how it works start-->
  <section>
    <div class="how-it-works">
        <div id="oac-header">
            <h2>How It Works</h2>
                <p>Operation and contribution to auth-wiki made<br>easy.</p>
        </div>
                    <br>
                        <div id="oac-options">

                            <p>
                                <img src="{{ asset('images/signup.svg') }}">
                                    <br><br>
                                Sign Up<br><br>Create your free <br>account</p>

                            <p>
                                <img src="{{ asset('images/explore.svg') }}">
                                    <br><br>                             
                                Explore<br><br>Search for the right <br>codes</p>

                            <p>
                                <img src="{{ asset('images/download2.svg') }}">  
                                    <br><br>                            
                                Download<br><br>Download code samples easily,<br> without stress</p>
                        </div>
                            <br><br><br>
                <div>
                    <button id="oac-btn" data-href="{{ route('register') }}">Get Started for Free</button>
                </div>
    </div>
</section>
    <!--how it works end-->
    <!--code snippet start-->
@php
    $suggests = \App\Models\Wiki::where('type', 'wiki')->inRandomOrder()->limit(6)->get();
@endphp
<section>
    <div class="snippets">
        <div id="snippet-header">
            <h2>Top picks From Our Library</h2>
        </div>
                <div class="daily-selections"> 
                    @foreach($suggests as $sug)
                    <div id="pick-one" data-href="{{ route('library.show', ['wiki' => $sug->id]) }}">
                        <img src="{{ url($sug->category->icon) }}">
                        <div id="options">
                            <p id="title">{{ $sug->title }}</p>        
                                <p id="panel">
                                    <img src="{{ asset('images/view.svg') }}"/> {{ Helper::shortNum($sug->views) }} Views    
                                    <img src="{{ asset('images/download.svg') }}"/> {{ Helper::shortNum($sug->downloads) }} Downloads
                                </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            <div>
                <button id="snippet-btn" data-href="{{ route('page.library') }}">Explore Library ></button>
            </div>
    </div>
</section>
    <!--code snippet end-->
@endsection