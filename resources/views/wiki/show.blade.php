@extends('layouts.master')

@section('title', 'Auth-wiki | '.Str::words($wiki->title, 3, '...'))

@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/star-rating.css') }}">
    <style type="text/css">
    body {
        font-family: 'Manrope';
    }
    .pagination {
        padding-left: 2rem;
    }
    button{
        border: none;
        color: var(--text_color);
        font-size: 16px !important;
        font-weight: 500 !important;
        border-radius: 4px;
        padding: 0 15px;
        gap: 10px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 0 !important;
    }
    button:hover{
    border: 1px solid rgba(255, 146, 67, 0.85);
    box-shadow: 0px 2px 10px 2px rgba(31, 31, 31, 0.1);
    transform: scale(1.02);
    }
    button#download {
        background-color: var(--button_hover_color);
        margin-right: calc(5% + 17px);
    }
    button#download:hover {
        background-color: var(--button_color);
    }
    button#commentBtn {
        background-color: var(--button_color);
    }
    button#commentBtn:hover {
        background-color: var(--button_hover_color);
    }
    .star-rating i {
        font-size: 35px !important;
    }

    @media only screen and (max-width: 408px) {
        .star-rating i {
            font-size: 25px !important;
        }
    }
    h1, h2, h3, h4, h5, h6 {
        font-family: 'DM Sans';
        color: #143A56;
    }
    h2 {
        padding-bottom: 15px;
        font-weight: 500;
    }
    h1 {
        padding-bottom: 20px;
        font-weight: 700;
    }
    hr {
        margin: 1.5px 0;
    }
    code, pre {
        background-color: rgba(175,184,193,0.2);
    }
    code {
        display: flex;
        flex-direction: column;
    }

    </style>
@endpush

@section('content')
@php
    $suggests = \App\Models\Wiki::where(['type' => 'wiki', 'category_id' => $wiki->category_id])->where('id', '<>', $wiki->id)->inRandomOrder()->limit(3)->get();
    $coms = $wiki->comment()->latest()->paginate(15);
@endphp
    <div class="container-fluid" style="margin-top: -40px;">
        <div class="mx-3 mx-md-4 pb-3">
            <div class="row be-break" id="main">
                <div class="row">
                    <h1>
                        {{ $wiki->title }} ({{ $wiki->category->name }})
                    </h1>
                </div>
                <div class="row my-2">
                    {!! $wiki->overview !!}
                </div>
                <div class="row">
                    {!! $wiki->contents !!}
                </div>
            </div>
            <div class="row my-3">
                <button class="w-auto" id="download" data-href="{{ route('library.download', ['id' => $wiki->id]) }}">Download</button>
                <div class="star-rating w-auto" data-wiki="{{ $wiki->id }}">
                    <div class="back-stars">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <div class="front-stars" style="width: {{ $wiki->stars }}%;">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            @if(count($suggests) > 0)
            <div class="container px-4">
                <div class="row">
                    <h2 class="text-center">Suggested Download</h2>
                </div>
                <div class="row g-4 py-3 justify-content-center">
                    @foreach($suggests as $sug)
                    <div style="background: linear-gradient(180deg, #FCFCFC 0%, #FCFCFC 100%); border-bottom: 2px solid #DCDCDC; border-radius: 0px 0px 8px 8px; box-sizing: border-box;" class="col-12 col-md-4" data-href="{{ route('library.show', ['id' => $sug->id]) }}">
                      <div class="d-flex align-items-center justify-content-center mb-3">
                        <img class="rounded" width="50px" height="50px" src="{{ url($sug->category->icon) }}" alt="card-{{ $loop->index }}"/>
                      </div>
                      <b style="height: 72px; overflow: hidden;" class="d-block be-break">{{ $sug->title }}</b>
                      <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                          <img class="px-1" src="{{ asset('images/view.svg') }}"/>
                          {{ Helper::shortNum($sug->views) }} Views
                        </div>
                
                        <div class="d-flex align-items-center">
                          <img class="px-1" src="{{ asset('images/download.svg') }}"/>
                          {{ Helper::shortNum($sug->downloads) }} Downloads
                        </div>
                      </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="row pt-3">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        @auth
                        <h3 class="pb-2 mb-0" style="margin-left: -5px;">LEAVE A COMMENT</h3>
                        <div class="d-flex">
                            <img src="{{ url(Auth::user()->photo) }}" class="be-avatar" width="50px" height="50px">
                            <div class="pb-1 mb-0 mx-2">
                                <form action="{{ route('library.comment', ['wiki' => $wiki->id]) }}" method="POST">
                                    @csrf
                                    <textarea id="comment" class="form-control" name="comment" placeholder="comment*" rows="3" cols="70" style="resize: none;" required></textarea>
                                    <button type="submit" class="my-3" id="commentBtn">Post Comment</button>
                                </form>
                            </div>
                        </div>
                        @endauth
                        <div class="my-3 p-3 rounded">
                            @if(count($coms) > 0)
                            <h3 class="pb-2 mb-0" style="margin-left: -20px;">PREVIOUS COMMENTS</h3>
                            @endif
                            @foreach($coms as $com)
                            <div class="d-flex text-muted pt-3">
                                <img src="{{ url($com->user->photo) }}" class="flex-shrink-0 me-2 rounded" width="32px" height="32px" role="img">
                                <div class="pb-3 mb-0">
                                    <div class="small">
                                        <a href="{{ route('index').'/user/'.$com->user->user_name }}" style="color: var(--text_color);"><strong class="text-gray-dark">{{ $com->user->name }}</strong></a>
                                        <span class="px-2">{{ Helper::timeAgo($com->created_at) }}</span>
                                    </div>
                                    <div class="be-break">
                                        {!! $com->comment !!}
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a data-target="comment" data-value="{{ $com->user->user_name }}" style="font-weight: bold;">Reply</a>
                                        <div class="d-flex align-items-center mx-4" data-comment="{{ $com->id }}">
                                            <img data-vote="up" src="{{ asset('images/like.png') }}" alt="like-button">
                                            <img class="px-2" data-vote="down" src="{{ asset('images/dislike.png') }}" alt="dislike button">
                                            <span>{{ Helper::shortNum($com->reaction()->where('wiki_id', $wiki->id)->sum('rating')) }}</span>
                                        </div>                  
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{ $coms->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"> </script>    
    <script src="{{ asset('js/clipboard.min.js') }}"> </script>    
    @auth
    <script type="text/javascript">
        let percentRating = {{ $wiki->stars }}, isClickedRating = false;
        $(document).ready(function(){
            $('code').prepend($('<i class="fa fa-copy" data-clipboard-target="#foo"/>').css({
                color: '#FF9243',
                'font-size': 'large',
                position: 'relative',
                top: '5px',
                right: '-5px',
                'align-self': 'end',
                padding: '5px'
            }));
            new ClipboardJS('.fa-copy', {
                target: function(trigger) {
                    return trigger.parentNode;
                }
            });
            function calcPosition(mouseObj) {
                var i = $('.star-rating i').index(mouseObj) + 1;
                return i > 5 ? (i - 5) : i;
            }
            $('.star-rating i').hover(function(){
                isClickedRating = false;
                $('.front-stars').width((calcPosition(this) * 20)+'%');
            }, function(){
                if(!isClickedRating) {
                    $('.front-stars').width(percentRating+'%');
                }
            });
            $('.star-rating i').click(function(){
                isClickedRating = true;
                $.ajax({
                    url: '{{ route('library.rate', ['id' => $wiki->id]) }}',
                    method: 'POST',
                    data: {
                        rating: calcPosition(this)
                    }
                }).done(function(data) {
                    if(data.status === true) {
                        percentRating = data.ratings;
                        $('.front-stars').width(data.ratings +'%');
                    } else {
                        $('.front-stars').width(percentRating+'%');
                    }
                });
            });
            $('[data-vote]').click(function(){
                var i = $(this).siblings('span');
                $.ajax({
                    url: '{{ route('index') }}/comment/'+$(this).parent().data('comment')+'/voting',
                    method: 'POST',
                    data: {
                        vote: $(this).data('vote')
                    }
                }).done(function(data) {
                    if(data.status === true) {
                        $(i).html(data.votes);
                    }
                });
            });
        });
    </script>
    @endauth
@endpush
