@extends('layouts.master')

@section('title', 'Auth-wiki | Publish library')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/auth_form.css') }}">
@endpush

@section('content')
<main class="container wrapper">
    <!-- IMAGE -->
    <form action="{{ route('category.create') }}" method="POST" class="auth_create_form" id="upload_form" style="display: {{ request()->query('display', 'none') }};">
        @csrf
        <input type="hidden" name="type" value="wiki">
        <div class="create_form_fields">
            <label for="name">Name</label>
            <input name="name" type="text"/>
            <label for="icon">Icon (url)</label>
            <input name="icon" type="text"/>
            <label for="description">Description</label>
            <textarea name="description"></textarea>
            <button id="upload_btn" type="submit">Create category</button>
        </div>
    </form>
    <hr style="display: none;">
    <h1 id="create_header">Create Authentication Code</h1>
    <!-- UPLOAD FORM -->
    <form action="{{ route('library.upload') }}" class="auth_create_form" id="upload_form" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <h3 id="info_text">Upload the code's file to proceed</h3>
        <!-- ZIP FILE -->
        <div class="create_form_fields">
            <label for="file">Downloadable File</label>
            <input type="file" name="file" accept=".zip" style="display: none;">
            <button id="upload_btn" data-be="file">Upload</button>
        </div>
    </form>
    <hr>


    <!--DETAIL FORM -->
    <form action="{{ route('library.publish') }}" class="auth_create_form" method="POST">
        @csrf
        <input type="hidden" name="file" value="{{ request()->query('file', 0) }}">
        <input type="hidden" name="type" value="wiki">
        <!-- CATEGORIES -->
        <div class="create_form_fields">
            <label for="categories">Category</label>
            <select name="category" id="categories" data-be="category">
                <option value="0">Select category</option>                
                @foreach(\App\Models\Category::where('type', 'wiki')->get() as $value)
                <option value="{{ $value->id }}" @selected(request()->query('category', 0) == $value->id)>{{ $value->name }}</option>                
                @endforeach
            </select>
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
            <label for="requirements">Content</label>
            <textarea name="contents" placeholder="Code details" id="contents">{{ old('contents') }}</textarea>
        </div>

        <button type="submit" id="create_btn">Create</button>
    </form>
</main>
@endsection
@push('js')
    <script type="text/javascript">
    $('[data-be=file]').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).siblings('input[type=file]').trigger('click').on('change', function(){
            $(this).parents('form').submit();
        });
    });
    $('[data-be=category]').on('change', function(){
        href = new URL(window.location.href);
        href.searchParams.set('category', $(this, ':selected').val());
        window.location = href.href;
    });
    </script>
@endpush