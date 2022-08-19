@extends('layouts.master')

@section('title', 'AuthWiki | Profile')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
    <div class="container-lg profile">
        <div class="row mx-auto">
            <div class="mx-auto col-md-5 d-inline-flex flex-column align-items-center p-3 profile-section">
                <div class="pb-3">
                    <img src="{{ url($user->photo) }}" alt="profile picture" class="img be-avatar"/>
                </div>

                <h4 class="text-center">{{ $user->name }}</h4>
                <p>{{ $user->email }}</p>
                <p>{{ $user->role }}</p>
                <button data-href="{{ route('user.settings') }}">
                    Edit Profile
                    <img src="{{ asset('images/edit.svg') }}" alt="edit" style="width: 12px; height: 12px"/>
                </button>
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
                <h4>Explored Documentation</h4>
                @if($user->log && $user->log->wiki_id <> null)
                    <p><a href="{{ route('library.show', ['wiki'=>$user->log->wiki->id]) }}">{{ $user->log->wiki->title }}</a></p>
                    @else
                    <p>You have not explored any auth codes yet.</p>
                @endif
                <h4>Downloaded auth codes sample</h4>
                @if($user->log && $user->log->file_id <> null)
                    <p><a href="{{ route('library.show', ['wiki'=>$user->log->file->wiki->id]) }}">{{ $user->log->file->name }}</a></p>
                    @else
                    <p>You have not downloaded any auth codes samples.</p>
                @endif
                <h4>Auth codes details you commented on</h4>
                @if($user->log && $user->log->comment_id <> null)
                    <p><a href="{{ route('library.show', ['wiki'=>$user->log->comment->wiki->id]) }}">{{ $user->log->comment->comment }}</a></p>
                    @else
                    <p>You have not commented on any auth codes details.</p>
                @endif
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
                            <a href="{{ url((string)$user->website) }}" target="_blank" data-content="{{ $user->website }}">{{ $user->website }}</a>
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