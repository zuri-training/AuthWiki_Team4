@extends('layouts.master')

@section('title', 'AuthWiki | '.$user->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
@php
    $first_name = Str::words($user->name, 1, '');
@endphp
    <div class="container-lg profile">
        <div class="row mx-auto">
            <div class="mx-auto col-md-5 d-inline-flex flex-column align-items-center p-3 profile-section">
                <div class="pb-3">
                    <img src="{{ url($user->photo) }}" alt="profile picture" class="img be-avatar"/>
                </div>

                <h4 class="text-center">{{ $user->name }}</h4>
                <p>{{ $user->email }}</p>
                <p>{{ $user->role }}</p>
                <p>
                    <img
                        src="{{ asset('images/calendar.svg') }}"
                        alt="calendar"
                        style="width: 15px; height: 15px; padding-right: 5px"
                    />
                    Joined {{ $user->created_at }}
                </p>
            </div>
            <div class="d-md-none my-3" role="separator"></div>
            <div class="mx-auto col-md-6 d-inline-flex flex-column align-items-start py-3 px-5 px-md-3 profile-section">
                <h4>Published libraries</h4>
                @if($user->libraries == 0)
                    <p>{{ $first_name }} have not Published any library yet.</p>
                    @else
                    <p>{{ $first_name }} have created {{ $user->libraries .' '. Str::plural('library', $user->libraries) }}.</p>
                @endif
                <h4>Contributions</h4>
                @if($user->contributions == 0)
                    <p>
                        {{ $first_name }} have not commented on any auth codes details.
                    </p>
                    @else
                    <p>
                        {{ $first_name }} have contributed {{ $user->contributions .' '. Str::plural('times', $user->contributions).' to '. $user->comment()->groupBy('wiki_id')->count() .' '.Str::plural('library', $user->comment()->groupBy('wiki_id')->count()) }}.
                    </p>
                @endif
                <h4>Downloaded auth code samples</h4>
                <p>
                    {{ $first_name }} have not downloaded any auth codes samples.
                </p>
            </div>
            <div class="col-12 my-3" role="separator"></div>
            <div class="mx-auto col-md-5 col-12 py-3 px-1 profile-section">
                <div class="container-fluid">
                    <div class="row py-1 profile-links">
                        <div class="col-4">
                            <img src="{{ asset('images/website.svg') }}" alt="website" class="icon"/>
                            Website
                        </div>
                        <div class="col-8 be-overflow" id="y">
                            <a href="{{ url($user->website) }}" target="_blank" data-content="{{ $user->website }}">{{ $user->website }}</a>
                        </div>
                    </div>
                    <div class="row py-1 profile-links">
                        <div class="col-4">
                            <img src="{{ asset('images/github.svg') }}" alt="github" class="icon"/>
                            Github
                        </div>
                        <div class="col-8">
                            <a href="https://github.com/{{ $user->github }}" target="_blank" data-content="{{ $user->github }}">{{ $user->github }}</a>
                        </div>
                    </div>
                    <div class="row py-1 profile-links">
                        <div class="col-4">
                            <img src="{{ asset('images/twitter2.svg') }}" alt="twitter" class="icon"/>
                            Twitter
                        </div>
                        <div class="col-8">
                            <a href="https://twitter.com/{{ $user->twitter }}" target="_blank" data-content="{{ $user->twitter }}">{{ $user->twitter }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-auto col-md-6 d-none d-md-block" role="separator"></div>
        </div>
</div>
@endsection