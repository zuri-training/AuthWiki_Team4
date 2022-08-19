@extends('layouts.master')

@section('title', 'AuthWiki | Library')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/star-rating.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"> </script>    
@endpush

@section('content')
    <div class="container-lg">
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
                <p class="text-center">@if((request()->has('keyword') || request()->has('stack')) && count($wikis) > 0) {{ Helper::shortNum(count($wikis)). ' '. Str::plural('result', count($wikis)). ' found' }} @else Over 1000+ codes @endif</p>
            </div>
        </div>
    </div>
    <div class="container-lg">
        <div class="row">
            @if(count($wikis) == 0)
            <div class="col-12">
                No library in this category
            </div>
            @endif
            @foreach($wikis as $lib)
            <div class="col-6 col-md-4">
                <div class="card" data-href="{{ route('library.show', ['wiki' => $lib->id]) }}">
                    <img width="48px" height="54px" src="{{ url($lib->category->icon) }}">
                    <div class="card-body be-break">
                        <h2 class="card-title be-overflow" id="xx">{{ $lib->title }}</h2>
                        <p class="card-text be-overflow" id="y">
                            {!! $lib->overview !!}
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="download">
                            <img src="{{ asset('images/download.svg') }}">
                            <span>{{ Helper::shortNum($lib->downloads) }}</span>
                        </div>
                        <div class="star-rating" data-wiki="{{ $lib->id }}">
                            <div class="back-stars">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <div class="front-stars" style="width: {{ $lib->stars }}%;">
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
            {{ $wikis->onEachSide(0)->links() }}
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.input-group [name=keyword]').on('keyup', function(){
                if($(this).val().length > 0) {
                    $.ajax({
                        url: '{{ route('library.search') }}',
                        data: {
                            'keyword': $(this).val()
                        },
                        method: 'POST',
                        success: function(data) {
                            $.each(data.data, function(index, value) {
                                $('.search_result').append('<a href="{{ route('index') }}/library/'+value.id+'"><p>'+value.title+'</p></a>');
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
                } else {
                    // Load search history
                }

            });
            $('[name=keyword]').on('blur', function(){
                // Search history
                // let _history = localStorage.getItem('search');
                // JSON.stringify(data)
                // localStorage.setItem()
            });
            $('body').click(function(e){
                if($(e.target).parents('.input-box').length == 0) {
                    $('.search_result').addClass('d-none');
                }
            });
        });
    </script>
@endpush