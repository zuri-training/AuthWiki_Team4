@extends('layouts.master')

@section('title', 'Auth-wiki | Settings')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush
@section('content')
    <main class="be_container">
        <div class="container_head">
            <h1 class="settings_header">Settings</h1>
            <button id="save_button">Save</button>
        </div>
        <hr id="hr1">
        <section class="avatar_section">
            <h1>Change Profile Image</h1>
            <div class="avatar_container">
                <img src="{{ url($user->photo) }}" alt="User image" class="be-avatar">
                <div class="avatar_container_btns">
                    <form action="{{ route('user.avatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar" style="display: none;" accept=".jpg,.jpeg,.png">
                        <button id="upload_button">Upload</button>
                    </form>
                    <button id="remove_button" data-href="{{ route('user.avatar.reset') }}">Remove</button>
                </div>
            </div>
            <hr>
        </section>
        <form action="{{ route('user.update') }}" id="p_form" class="personal_details_form" method="POST">
            @csrf
            <h1>Personal Details</h1>
            <div class="form_fields">
                <div id="exception1" style="flex-direction: column;">
                    <label for="name">Full Name
                        <input name="name" value="{{ $user->name }}" type="text" class="p_form_input">
                    </label>
                    
                    <label for="email">Email
                        <input name="email" value="{{ $user->email }}" type="email" class="p_form_input" @disabled($user->email_verified_at <> null)>
                    </label>
                    
                    <label for="user_name">Username
                        <input name="user_name" value="{{ $user->user_name }}" type="text" class="p_form_input" @disabled($user->password_changed)>
                    </label>
                </div>
            </div>
            <hr>
            <h1>Social Handles</h1>
            <div class="form_fields">
                <label for="website">Website
                    <input name="website" value="{{ $user->website }}" type="url" class="p_form_input" id="website">
                </label>

                <label for="twitter">Twitter
                    <input name="twitter" value="{{ $user->twitter }}" type="url" class="p_form_input" id="twitter">
                </label>
                
                <label  for="github">GitHub
                    <input name="github" value="{{ $user->github }}" type="url" class="p_form_input" id="github">
                </label>
            </div>
            <hr>
        </form>

        <form action="{{ route('user.password') }}" id="pwd_form" class="change_pwd_form" method="POST">
            @csrf
            @method('patch')
            <h1>Change Password</h1>
            <div id="exception2">
                <div class="form_fields">
                    <label for="old_password">Old password
                        <input name="password_old" type="password" class="pwd_form_input" id="old_password" @disabled(!$user->password_changed)>
                    </label>
    
    
                    <label for="new_password">New password
                        <input name="password" type="password" class="pwd_form_input" id="new_password">
                    </label>
                    
                    <label for="confirm_password">Confirm password
                        <input name="password_confirmation" type="password" class="pwd_form_input" id="confirm_password">
                    </label>
                </div>
                <button type="submit" id="pwd_button">Change</button>
            </div>
            <hr>
        </form>

        <section class="delete_section">
            <h1>Delete your profile</h1>
            <p>Deleting your information does not impact your Auth-wiki identity.</p>
            <button id="delete_button" data-href="{{ route('user.settings') }}">Delete</button>
        </section>
    </main>

    @if(session('profile'))
    <!-- PROFILE SAVED -->
    <div class="profile_card1" id="popup_success">
        <div>
            <img src="{{ asset('images/round_check.svg') }}" alt="check">
            <h1 >Profile saved successfully</h1>    
        </div>    
        <button id="close_button">Close</button>
    </div>
    @endif
    @if(request()->query('delete', 'no') == 'yes')
    <!-- DELETE CONFIRMATION -->
    <div class="profile_card" id="delete_confirm">
        <h1>Are you sure?</h1>
        <p>Deleting your profile cannot be undone.</p>
        <div class="buttons">
            <button id="close_button">Close</button>
            <a href="#"><button id="delete_button">Delete</button></a>
        </div>
    </div>
    @endif
@endsection
@push('js')
    <script type="text/javascript">
    $('#upload_button').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).siblings().trigger('click').on('change', function(){
            $(this).parent().submit();
        });
    });
    $('#save_button').click(function(){
        $('form#p_form').submit();
    });
    @if(session('profile'))
    $('body').css({
        height: '100%',
        overflow: 'hidden'
    });
    $('#popup_success').css({
        display: 'flex'
    });
    $('#close_button').click(function(){
        $('body').css({
            height: 'auto',
            overflow: 'auto'
        });
        $('#popup_success').remove();
    });
    @endif
    @if(request()->query('delete', 'no') == 'yes')
    $('body').css({
        height: '100%',
        overflow: 'hidden'
    });
    $('#delete_confirm').css({
        display: 'flex'
    });
    $('#close_button').click(function(){
        $('body').css({
            height: 'auto',
            overflow: 'auto'
        });
        $('#delete_confirm').remove();
    });
    @endif
    </script>
@endpush