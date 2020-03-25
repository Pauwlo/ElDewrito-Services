@extends('layouts.auth')

@section('title', 'Change password')

@section('robots', 'noindex, nofollow')

@section('content')
<div class="login__block active">
    <div class="login__block__header">
        <i class="zwicon-user-circle"></i>
        {{ __('Change password') }}
    </div>

    <form method="POST" action="{{ route('password.change') }}" class="login__block__body">
        @csrf
        @method('PUT')

        <div class="form-group form-group--centered">
            <input type="password" name="current-password" class="form-control text-center @error('current-password') is-invalid @enderror" placeholder="{{ __('Current password') }}" minlength="8" required>

            @error('current-password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group form-group--centered">
            <input type="password" name="password" class="form-control text-center @error('password') is-invalid @enderror" placeholder="{{ __('New password') }}" minlength="8" autocomplete="new-password" required>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group form-group--centered">
            <input type="password" name="password_confirmation" class="form-control text-center @error('password') is-invalid @enderror" placeholder="{{ __('Confirm password') }}" minlength="8" autocomplete="new-password" required>
        </div>

        <button type="submit" class="btn btn-theme btn--icon">
            <i class="zwicon-checkmark" title="{{ __('Change password') }}"></i>
        </button>
    </form>
</div>
@endsection
