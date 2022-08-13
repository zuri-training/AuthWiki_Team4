@extends('layouts.master')

@section('title', 'Auth-wiki | Terms of Service')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/tos.css') }}">
@endpush

@section('content')
<div class="be_container">
    <div class="header">
        <p class="agreement">Agreement</p>
        <p class="terms">Terms of service</p>
    </div>
    <div class="main">
        <p>
            We know its tempting to overlook/skip these terms of
            service, but it is important to establish what you can
            expect from us and what we expect of you.
        </p>
        <p>
            These Terms of Service reflect the way our web page works,
            the steps to take, how to take these steps, in other to get
            the desired results. As a result, these terms and services
            will help provide details on webpage and how to interact
            with it. These terms include the following:
        </p>
        <ol>
            <li>
                We provide you with various authentication codes that
                make authenticating easy and fast.
            </li>
            <li>
                All information on the page can be accessed by
                Unauthorized users, except the download page. The user
                would have to Login or sign up to have access to Auth
                codes. Also, after signing up, email has to be verified
                before you're allowed to move to the download page or
                any where else.
            </li>
        </ol>
        <p>
            Understanding these terms is important because to use our
            services, you must accept these terms.
        </p>
    </div>
    @if(Session::has('tos'))
    <div class="btns">
        <button class="decline" data-href="{{ route('register') }}" data-action="{{ route('settings.tos') }}?decision=decline">Decline</button>
        <button class="accept" data-href="{{ route('register') }}" data-action="{{ route('settings.tos') }}?decision=accept">I Accept</button>
    </div>
    @endif
</div>
@endsection
