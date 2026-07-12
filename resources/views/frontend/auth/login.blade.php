@extends('frontend.layouts.app')

@section('title', 'User Login')

@section('content')

<div id="mainBody">
    <div class="container">
        <div class="row">
            <div class="span9 offset1">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <span class="divider">/</span>
                </ul>

                <h3>User Login</h3>

                <div class="well">
                    <div id="successMessage" class="alert alert-success" style="display:none;"></div>

                    <form method="POST" id="loginForm" action="{{ route('login.store') }}" class="form-horizontal">
                        @csrf

                        <h4>Login To Your Account</h4>

                        <div class="control-group">
                            <label class="control-label">
                                Email
                                <sup>*</sup>
                            </label>
                            <div class="controls">
                                <input type="email" name="email" placeholder="Enter Email">
                                <span id="email-error" class="validation-error text-error"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">
                                Password
                                <sup>*</sup>
                            </label>
                            <div class="controls">
                                <input type="password" name="password" placeholder="Enter Password">
                                <span id="password-error" class="validation-error text-error"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-success btn-large">
                                    Login
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#loginForm').submit(function (e) {
        e.preventDefault();

        $('.validation-error').html('');

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function () {
                $('#loginForm button')
                    .prop('disabled', true)
                    .text('Logging In...');
            },
            success: function (response) {
                window.location.href = response.redirect;
            },
            error: function (xhr) {
                console.log(xhr);

                let response = JSON.parse(xhr.responseText);

                if (response.errors) {
                    $.each(response.errors, function (field, messages) {
                        $('#' + field + '-error')
                            .html(messages[0]);
                    });
                }
            },
            complete: function () {
                $('#loginForm button')
                    .prop('disabled', false)
                    .text('Login');
            }
        });
    });

    $('input').on('keyup change', function () {
        let field = $(this).attr('name');
        $('#' + field + '-error').html('');
    });
});
</script>
@endpush