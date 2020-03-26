@extends('layouts.auth')

@section('title', 'Delete your account')

@section('robots', 'noindex, nofollow')

@section('content')
<div class="login__block active">
    <div class="login__block__header">
        <img src="{{ asset('img/avatars/' . (auth()->user()->avatar ?? 'default.png')) }}" alt="{{ auth()->user()->name }}">
        {{ __('Are you sure,') }} <strong>{{ auth()->user()->name }}</strong>{{ __('?') }}
    </div>

    <form method="POST" action="{{ route('profile.delete') }}" class="login__block__body">
        @csrf
        @method('DELETE')
        
        <p>{{ __('Once you delete your account, there is no going back. Please be certain.') }}</p>

        <div class="form-group">
            <input type="password" name="password" class="form-control text-center @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" minlength="8" required>
            
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger">{{ __('Delete my account') }}</button>
    </form>
</div>
@endsection
