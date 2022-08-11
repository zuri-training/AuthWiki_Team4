@push('css')
  <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endpush

@php
  $suggests = DB::table('wikis')->where(['type' => 'wiki', 'category_id' => $wik->category_id])->inRandomOrder()->limit(3)->get();
  $comments = $wiki->comment()->orderBy('votes', 'desc')->latest()->paginate(10);
@endphp

<section class="container">
    <h2 class="suggestion-text">Suggested Download</h2>
    <div class="section-container">
      @foreach($suggests as $rel)
      <div class="card-section-card-1">
        <div class="card-section sub-section">
          <img
            class="icon-image"
            src="{{ asset('images/react.png') }}"
            alt="card-1"
          />
        </div>
        <div class="card-view">
          <h2 class="sub-section-title">Seamless Reactjs Login templates</h2>
          <div class="card-base">
            <div class="card-view-details">
              <img src="{{ asset('images/view.svg') }}"/>
              <p class="card-view-paragraph">4.5K Views</p>
            </div>

            <div class="card-view-details">
              <img src="{{ asset('images/vote.svg') }}"/>
              <p class="card-view-paragraph">1.3K Votes</p>
            </div>

            <div class="card-view-details">
              <img src="{{ asset('images/download.svg') }}"/>
              <p class="card-view-paragraph">11.3K Downloads</p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <button><a href="#">Load more</a></button>
    @auth('verified')
    <!-- LEAVE COMMENT SECTION -->
    <main>
      <div class="comment-container-heading">
        <h2>LEAVE A COMMENT</h2>
        <div class="comment-container">
          <i class="fa-solid fa-circle-user"></i>
          <p class="comment-container-paragraph">
            Your email address will not be published. Required fields are
            marked*
          </p>
        </div>
      </div>
      <form class="comment-form" action="" method="POST">
        <textarea name="" id="comment" placeholder="comment*"></textarea>
        <button type="submit" class="button-post">Post Comment</button>
      </form>
    </main>
    @endauth
    <article class="comment-section">
      <h1>PREVIOUS COMMENTS</h1>
      
      <div class="previous-comments-wrapper">
          <!-- first reply -->
        @foreach($comments as $com)
        <div class="previous-comments">
          <i class="fa-solid fa-circle-user"></i>
          <div class="previous-comments-name">
            <p class="previous-comments-paragraph-name">
              {{ $com->user->name }} <span> {{ $com->created_at }}</span>
            </p>
            <p class="previous-comments-paragraph">
              {{ $com->comment }}
            </p>
            <div class="reply-button">
              <p data-reply="{{ $com->user->user_name }}">Reply</p>
                <div class="reply-button-like">
                <img class="reply-icon" src="{{ asset('images/like.png') }}" alt="like-button">
                <img class="reply-icon-1" src="{{ asset('images/dislike.png') }}" alt="dislike button">
              </div>
            </div>
          </div>
        </div>          
        @endforeach
      </div>
    </article>
</section>

@push('js')
  
@endpush