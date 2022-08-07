@extends('layouts.general')

@section('title', 'AuthWiki_Team4')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/star-rating.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/popper.min.js') }}"> </script>    
    <script src="{{ asset('js/bootstrap.min.js') }}"> </script>    
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form method="GET" action="{{ route('page.library') }}">
                    <div class="input-group flex-nowrap mb-3 input-box">
                        <input type="text" name="keyword" class="form-control" placeholder="Search for code..." autocomplete="off" aria-label="Search" aria-describedby="button-search" value="{{ request()->input('keyword') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                        <div class="search_result d-none">
                        </div>
                    </div>
                </form>
                <p class="text-center">Over 1000+ codes</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($wikis as $lib)
            <div class="col-6 col-md-4">
                <div class="card">
                    <img width="48" height="54" src="{{ asset("images/stacks/{$lib->stack}.svg") }}">
                    <div class="card-body">
                        <h2 class="card-title">{!! $lib->title !!} ({{ Str::ucfirst($lib->stack) }})</h2>
                        <p class="card-text">
                            {!! $lib->description !!}
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="download">
                            <img src="{{ asset('images/download.svg') }}">
                            <span>{{ number_format($lib->downloads) }}</span>
                        </div>
                        <div class="star-rating">
                            <div class="back-stars">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <div class="front-stars" style="width: {!! $lib->stars !!}%;">
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
            </div>
            @endforeach
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('[name=keyword]').on('keyup', function(){
                $.ajax({
                    url: '{!! route('search.library') !!}',
                    data: {
                        'keyword': $(this).val()
                    },
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $('.search_result').append('<p><a href="#">'+value.title+'</a></p>');
                        });
                    },
                    beforeSend: function(){
                        $('.search_result').html('');
                    },
                    complete: function() {
                        if($('.search_result').children().length > 0) {
                            $('.search_result').removeClass('d-none');
                        } else {
                            $('.search_result').addClass('d-none');
                        }
                    }
                });
            });
            $('body').click(function(e){
                if($(e.target).parents('.input-box').length == 0) {
                    $('.search_result').addClass('d-none');
                }
            });
        });
    </script>
@endpush