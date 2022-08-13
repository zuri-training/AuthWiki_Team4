@extends('layouts.master')

@section('title', 'Auth-wiki | Publish library')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/auth_form.css') }}">
@endpush

@section('content')
    <main class="be_container wrapper">
        <h1 id="create_header">Create Authentication Code</h1>
        <!-- FORM -->
        <form action="" class="auth_create_form" oninput="enableAndDisableCreateButton()">
            <div class="create_form_fields">
                <label for="file">Downloadable File</label>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="file" name="file" placeholder="Upload Zip" id="file" style="display: none;">
                    <button id="be-wiki_file">Upload zip</button>
                </form>
            </div>
                <!-- TITLE -->
            <div class="create_form_fields">
                <label for="title">Code Title</label>
                <input type="text" name="title" placeholder="Code title" id="title">
            </div>

            <hr>
            <!-- OVERVIEW -->
            <div class="create_form_fields">
                <label for="overview">Overview</label>
                <textarea name="overview" placeholder="Code description" id="overview"></textarea>
            </div>

            <hr>
            <!-- PACKAGES -->
            <div class="create_form_fields">
                <label for="requirements">Packages & Dependencies</label>
                <textarea name="requirements" placeholder="Requirements" id="Fill in the requirements"></textarea>
            </div>

            <hr>
            <!-- CODE -->
            <div class="create_form_fields">
                <label for="code-snippets">Code Snippets</label>
                <input type="url" name="snippets" placeholder="Enter code snippet's url" id="code-snippets">
            </div>

            <hr>
            <!-- EXAMPLES -->
            <div class="create_form_fields">
                <label for="examples">Examples</label>
                <textarea name="examples" placeholder="Examples go here" id="examples"></textarea>
                <!-- LINKS SECTION -->
                <div id="links_header">
                    <h3>Enter any required links here: </h3>
                    <small>You can fill these with links associated with the examples given above.</small>
                </div>
                <div id="links_wrapper">
                    <div class="links">
                        <div class="link">
                            <label for="link_name">Link name (1)</label>
                            <input type="text" name="link_name[]" placeholder="Enter url name">
                        </div>
                        <div class="link">
                            <label for="link_name">Link</label>
                            <input type="url" name="link[]" placeholder="Enter url" id="link3">
                        </div>
                    </div>

                    <div class="links">
                        <div class="link">
                            <label for="link_name">Link name (2)</label>
                            <input type="text" name="link_name[]" placeholder="Enter url name">
                        </div>
                        <div class="link">
                            <label for="link_name">Link</label>
                            <input type="url" name="link[]" placeholder="Enter url" id="link3">
                        </div>
                    </div>

                    <div class="links">
                        <div class="link">
                            <label for="link_name">Link name (3)</label>
                            <input type="text" name="link_name[]" placeholder="Enter url name">
                        </div>
                        <div class="link">
                            <label for="link_name">Link</label>
                            <input type="url" name="link[]" placeholder="Enter url" id="link3">
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <!-- ZIP FILE -->
            <button disabled="true" style="pointer-events: none;" type="submit" id="create_btn">Create</button>
        </form>
    </main>
@endsection
@push('js')
    <script type="text/javascript">
    $('#be-wiki_file').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $('this').siblings().trigger('click').on('change', function(){
            $(this).parent().submit();
        });
    });
    </script>
@endpush