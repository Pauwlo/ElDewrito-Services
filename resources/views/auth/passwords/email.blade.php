@extends('layouts.auth')

@section('title', 'Reset password')

@section('description', 'If you forgot your password, you can recover it by filling this form.')

@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
<div class="login__block active">
    <div class="login__block__header">
        <i class="zwicon-user-circle"></i>
        {{ __('Reset your password') }}

        <div class="actions actions--inverse login__block__actions">
            <div class="dropdown">
                <i data-toggle="dropdown" class="zwicon-more-h actions__item"></i>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
            </div>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success m-0" role="alert">
            {{ session('status') }}
        </div>

        <div class="login__block__body">
            <a class="btn btn-outline-theme" href="{{ route('login') }}">{{ __('Return to login') }}</a>
        </div>
    @else
        <form method="POST" action="{{ route('password.email') }}" class="login__block__body">
            @csrf
    
            <div class="form-group">
                <input type="email" name="email" class="form-control text-center @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" autocomplete="email" required autofocus>
    
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE') }}"></div>

                @error ('g-recaptcha-response')
                    <span class="invalid-feedback" style="display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <button type="submit" class="btn btn-theme btn--icon">
                <i class="zwicon-checkmark" title="{{ __('Send password reset link') }}"></i>
            </button>
        </form>
    @endif
</div>
@endsection
