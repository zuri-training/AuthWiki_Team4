@extends('layouts.master')

@section('title', 'Auth-wiki | Publish library')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/auth_form.css') }}">
@endpush

@section('content')
    <main class="be_container wrapper" onpointerover="displayInfoText(), closeCardOnOutsideClick()">
        <h1 id="create_header">Create Authentication Code</h1>
        <!-- UPLOAD FORM -->
        <form action="{{ route('library.upload') }}" class="auth_create_form" id="upload_form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <h3 id="info_text">Upload the code's file to proceed</h3>
            <!-- ZIP FILE -->
            <div class="create_form_fields">
                <label for="file">Downloadable File</label>
                <input type="file" accept=".zip" name="file" placeholder="Upload Zip" id="file">
                <button id="upload_btn" type="submit">Upload</button>
            </div>
        </form>
        <hr>


        <!--DETAIL FORM -->
        <form action="{{ route('library.publish') }}" class="auth_create_form" method="POST">
            @csrf
            <input type="hidden" name="file" value="{{ request()->query('file', 0) }}">
            <input type="hidden" name="type" value="wiki">
                <!-- CATEGORIES -->
            <div class="category">
                <div class="create_form_fields">
                    <label for="categories">Category</label>
                    <select name="category" id="categories">
                        @foreach(\App\Models\Category::where('type', 'wiki')->get() as $value)
                        <option value="{{ $value->id }}" @selected(old('category') == $value->id)>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button onclick="resizeCard(); displayPopup('cat_card');" type="button" id="add_btn">
                    <p>Add</p>
                    <img src="{{ asset('images/plus.svg') }}">
                </button>
            </div>

            <hr>
            <!-- TITLE -->
            <div class="create_form_fields">
                <label for="title">Code Title</label>
                <input type="text" name="title" placeholder="Code title" id="title" value="{{ old('title') }}">
            </div>

            <hr>
            <!-- OVERVIEW -->
            <div class="create_form_fields">
                <label for="overview">Overview</label>
                <textarea name="overview" placeholder="Code description" id="overview">{{ old('overview') }}</textarea>
            </div>

            <hr>
            <!-- PACKAGES -->
            <div class="create_form_fields">
                <label for="contents">Content</label>
                <textarea name="contents" placeholder="Code details" id="contents">{{ old('contents') }}</textarea>
            </div>
            
            <button type="submit" id="create_btn">Create</button>
        </form>
    </main>


    <!-- CREATE CATEGORY FORM -->
    <div class="cat_card" id="cat_card">
        <h1 id="create_header">Add Category</h1>
        <form action="{{ route('category.create') }}" class="auth_create_form" id="create_cat_form" method="POST">
            @csrf
            <input type="hidden" name="type" value="wiki">
            <!-- CATEGORY NAME -->
            <div class="create_form_fields">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Category name" id="cat_name">
            </div>

            <hr>
            <!-- IMAGE-->
            <div class="create_form_fields">
                <label for="icon">Icon</label>
                <input type="url" name="icon" placeholder="Enter icon's url" id="cat_image">
            </div>

            <hr>
            <!-- DESCRIPTION -->
            <div class="create_form_fields">
                <label for="description">Description</label>
                <textarea name="description" placeholder="Category description" id="cat_description"></textarea>
            </div>

            <button type="submit" id="create_cat_btn" onclick="hidePopup('cat_card')">Add</button>
        </form> 
    </div>
    @endsection
    @push('js')
        <script src="{{ asset('js/create_cards.js') }}"> </script>
        <script type="text/javascript">
        // $('[data-be=file]').click(function(e){
        //     e.preventDefault();
        //     e.stopPropagation();
        //     $(this).siblings('input[type=file]').trigger('click').on('change', function(){
        //         $(this).parents('form').submit();
        //     });
        // });
        // $('[data-be=category]').on('change', function(){
        //     href = new URL(window.location.href);
        //     href.searchParams.set('category', $(this, ':selected').val());
        //     window.location = href.href;
        // });
        </script>
    @endpush