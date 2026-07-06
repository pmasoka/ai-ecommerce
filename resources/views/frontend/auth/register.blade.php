@extends('frontend.layouts.app')

@section('title', 'User Registration')

@section('content')
<div class="mainBody">
    <div class="container">
        <div class="row">
            <div class="span9 offset1">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                        <span class="divider"></span>
                    </li>
                    <li class="active">Registration</li>
                </ul>

                <h3>User Registration</h3>

                <div class="well">
                    <div id="successMessage" class="alert alert-success" style="display:none;"></div>

                    <form method="POST" id="registerForm" action="{{ route('register.store') }}" class="form-horizontal">
                        @csrf

                        <h4>Create Your Account</h4>

                        <div class="control-group">
                            <label class="control-label">Name <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="name" placeholder="Enter Name">
                                <span id="name-error" class="validation-error text-error"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Email <sup>*</sup></label>
                            <div class="controls">
                                <input type="email" name="email" placeholder="Enter Email">
                                <span id="email-error" class="validation-error text-error"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Mobile <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="phone" placeholder="Enter Mobile Number">
                                <span id="phone-error" class="validation-error text-error"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Password <sup>*</sup></label>
                            <div class="controls">
                                <input type="password" name="password" placeholder="Enter Password">
                                <span id="password-error" class="validation-error text-error"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Confirm Password <sup>*</sup></label>
                            <div class="controls">
                                <input type="password" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-success btn-large">Register</button>
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
    $('#registerForm').submit(function (e) {
        e.preventDefault();
        $('.validation-error').html('');
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function () {
                $('#registerForm button')
                    .prop('disabled', true)
                    .text('Registering...');
            },
            success: function (response) {
                $('#successMessage')
                    .html(response.message)
                    .show();
                $('#registerForm')[0].reset();
            },
            error: function (xhr) {
                console.log(xhr);
                if (xhr.status == 422) {
                    let response = JSON.parse(xhr.responseText);
                    $.each(response.errors, function (field, messages) {
                        $('#' + field + '-error')
                            .html(messages[0]);
                    });
                }
            },
            complete: function () {
                $('#registerForm button')
                    .prop('disabled', false)
                    .text('Register');
            }
        });
    });

    $('input').on('keyup change', function () {
        let field = $(this).attr('name');
        $('#' + field + '-error').html("");
    });
});
</script>
@endpush