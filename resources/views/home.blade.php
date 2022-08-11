@extends('layouts.master')

@section('title', 'Authwiki')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endpush

@section('content')
<!-- HOME PAGE BODY -->

<main id="hp" class="be_container">
    <section class="showcase">
        <div class="showcase_body">
            <h1>Get unlimited access to authentication codes from Auth-wiki</h1>
            <p>Our extensive component library for auth codes simplifies authentication.</p>
            <button id="showcase_button" data-href="{{ route('page.library') }}">View Library</button>
        </div>

        <div class="showcase_images">
            <img src="{{ asset('images/homepage_showcase_img.svg') }}" alt="my code">
            <img src="{{ asset('images/homepage_showcase_img2.svg') }}" alt="my code">
            <img src="{{ asset('images/homepage_showcase_img2.svg') }}" alt="my code">
        </div>
    </section>

    <section class="site_actions">
        <div class="site_actions_header">
            <h1>Steps to accessing auth codes of your choice</h1>
        </div>

        <div class="site_actions_sub">
            <div class="sub1">
                <div class="sub1_item">
                    <img src="{{ asset('images/user2.svg') }}" alt="user icon">
                    <h3>Sign up</h3>
                    <p>Create and verify your free  account on Auth-wiki to begin your auth codes journey</p>
                </div>
                <div class="sub1_item">
                    <div id="lib">
                        <img src="{{ asset('images/lib1.svg') }}" alt="library">
                        <img src="{{ asset('images/lib2.svg') }}" alt="">
                    </div>
                    <h3>Explore library</h3>
                    <p>Browse through Auth-wiki's library for auth codes of your choice.</p>
                </div>
                <div class="sub1_item">
                    <img src="{{ asset('images/download3.svg') }}" alt="download">
                    <h3>Download codes</h3>
                    <p>Easily download the authentication codes of your choice with no stress.</p>
                </div>
            </div>

            <div class="sub2">
                <img src="{{ asset('images/community.svg') }}" alt="community">
                <h3>Join community</h3>
                <p>There's already a community of developers ready to make your journey on Auth-wiki smooth</p>
            </div>
        </div>
        <button data-href="{{ route('register') }}">Get started for free</button>
    </section>
    
    <!-- ARTICLE -->

    <article class="contents">
        <div class="contents_header">
            <h1>Why use Auth-wiki's library of auth codes?</h1>
        </div>

        <section class="content_section">
            <h3><li>Easy Navigation</li></h3>
            <p>To download auth codes of your choice, all you have to do is sign up! 
                Unauthorized users are permitted to visit the platform to view basic information about it; while authorized users have full access to the platform, they are allowed to contribute,
                    comment and react. Authorized users can also view example, code usage and also download code samples.
            </p>
        </section>

        <section class="content_section">
            <h3><li>Detailed Guide</li></h3>
            <p>
                The website contains a detailed or at least near detailed guide on the requirements for specific authentication systems and how to use them to aid easy implementation. 
                Authwiki is envisioned to be an inclusive and exhaustive library. So, no programming language or framework is left out, allowing it to feed a vast community of developers.
            </p>
        </section>

        <section class="content_section">
            <h3><li>Time Efficiency</li></h3>
            <p>
                Once you've created an account on Auth wiki, navigating through the documentation page and download will only take you seconds!
                    It will help you finish your project faster than you had planned. You don't have to worry so much about building authentication, 
                    and you can easily focus on what matters the most.
            </p>
        </section>

        <section class="content_section">
            <h3><li>Quick Access</li></h3>
            <p>
                Developers who want to build their own authentication system can get quick access to code modules and packages without going through 
                the hassle of browsing through websites 
                (like stack overflow) for code samples.
            </p>
        </section>
    </article>
</main>
@endsection