@extends('layouts.master')

@section('title', 'Auth-wiki | '.Str::words($wiki->title, 3, '...'))

@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('css/authenication_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endpush

@section('content')
    <main class="be_container">
        <h1 class="heading">{{ $wiki->title }} ({{ $wiki->category->name }})</h1>
        <section class="overview">
            <h3>Overview</h3>
            <p class="body-text">
                {{ $wiki->overview }}
            </p>
        </section>
        <section class="requirement">
            <h3>Packages/dependencies</h3>
            <p class="body-text">
                {{ $wiki->requirements }}
            </p>
        </section>
        @if(Str::length($wiki->snippets) > 0)
        <section>
            <h3>Code snippets</h3>
                <div class="code">
                    @foreach(Str::of($wiki->snippets)->squish()->split('/\n{1,}/') as $snips)
                    <iframe
                        src="{{ $snips }}"
                        style="width: 100%; height: 1000px; border:0; transform: scale(1); overflow:auto; padding-top: 56px;"
                        sandbox="allow-scripts allow-same-origin">
                    </iframe>
                    @endforeach
                </div>
        </section>
        @endif
        @if(Str::length($wiki->examples) > 0)
        <section>
            <h3 class="examples">Examples</h3>
            <p class="body-text">
                Time is precious as a developer, and we want you to get started building that next idea FAST! To get started
                using the library:
            </p>
            <p class="body-text">
                {{ $wiki->examples }}
            </p>
        </section>
        @endif
        <div class="btn-group">
            <button class="download-btn"><a href="#">Download  <img src="{{ asset('images/download.svg') }}" alt=""></a></button>
            <div class="star-rating" data-wiki="{{ $wiki->id }}">
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
    </main>
    @php
    $suggests = \App\Models\Wiki::where(['type' => 'wiki', 'category_id' => $wiki->category_id])->inRandomOrder()->limit(3)->get();
    $coms = $wiki->comment()->orderBy('vote', 'desc')->latest()->paginate(10);
    @endphp
    <section class="be_container" style="padding-top: 20px;">
        <h2 class="suggestion-text">Suggested Download</h2>
        <div class="section-container">
          @foreach($suggests as $sug)
          <div class="card-section-card-1" data-href="{{ route('library.show', ['id' => $sug->id]) }}">
            <div class="card-section sub-section">
              <img
                class="icon-image"
                src="{{ url($sug->category->icon) }}"
                alt="card-1"
              />
            </div>
            <div class="card-view">
              <h2 class="sub-section-title">{{ $sug->title }}</h2>
              <div class="card-base">
                <div class="card-view-details">
                  <img src="{{ asset('images/view.svg') }}"/>
                  <p class="card-view-paragraph">{{ $sug->views }} views</p>
                </div>
    
                <div class="card-view-details">
                  <img src="{{ asset('images/download.svg') }}"/>
                  <p class="card-view-paragraph"> {{ $sug->downloads }} Downloads</p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @auth
        <main>
            <div class="comment-container-heading">
              <div class="comment-container">
                <img src="{{ url(Auth::user()->photo) }}" class="be-avatar" width="50px" height="50px">
                <h2>LEAVE A COMMENT</h2>
            </div>
              <form class="comment-form" action="{{ route('library.comment', ['wiki' => $wiki->id]) }}" method="POST">
                @csrf
                <textarea name="comment" id="comment" placeholder="comment*"></textarea>
                <button type="submit" class="button-post">Post Comment</button>
              </form>
              </div>
          </main>
        @endauth
        <article class="comment-section">
            <div class="previous-comments-wrapper">
                    <!-- first reply -->
                @foreach($coms as $com)
                <div class="previous-comments">
                    <img src="{{ url($com->user->photo) }}" class="be-avatar" width="50px" height="50px">
                    <div class="previous-comments-name">
                    <p class="previous-comments-paragraph-name">
                        {{ $com->user->name }} <span> {{ $com->created_at }}</span>
                    </p>
                    <p class="previous-comments-paragraph">
                        {{ $com->comment }}
                    </p>
                    <div class="reply-button">
                        <p data-target="comment" data-value="{{ $com->user->user_name }}">Reply</p>
                        <div class="reply-button-like">
                            <a href="javascript:void(0);" data-vote="up" data-comment="{{ $com->id }}"><img class="reply-icon" src="{{ asset('images/like.png') }}" alt="like-button"></a>
                            <a href="javascript:void(0);" data-vote="down" data-comment="{{ $com->id }}"><img class="reply-icon-1" src="{{ asset('images/dislike.png') }}" alt="dislike button"></a>
                            <span>{{ $com->vote }}</span>
                        </div>
                    </div>
                    </div>
                </div>          
                @endforeach
            </div>
        </article>
    </section>
    {{ $coms->onEachSide(0)->links() }}
@endsection
@push('js')
    @auth
    <script type="text/javascript">
        $(document).ready(function(){
            let percentRating = {{ $wiki->stars }}, isClickedRating = false;
            function calcPosition(mouseObj) {
                var i = $('.star-rating i').index(mouseObj) + 1;
                return i > 5 ? (i - 5) : i;
            }
            $('.star-rating i').mousemove(function(){
                $('.front-stars').width((calcPosition(this) * 20)+'%');
            });
            $('[data-wiki]').mouseleave(function(){
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
                        percentRating = data.rating;
                        $('.front-stars').width(data.rating +'%');
                        toastr.info('Thank you for your feedback');
                    } else {
                        isClickedRating = false;
                        $('.front-stars').width(percentRating+'%');
                    }
                });
            });
            $('[data-vote]').click(function(){
                var i = $(this).siblings('span');
                $.ajax({
                    url: '{{ route('index') }}/comment/'+$(this).data('comment')+'/voting',
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
