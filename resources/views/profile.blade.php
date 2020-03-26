@extends('layouts.app')

@section('title', 'Profile – ' . config('app.name', 'ElDewrito Services'))

@section('description', '')

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('Profile') }}</h1>
    </header>

    <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data" class="card new-contact">
        <div class="actions">
            <div class="dropdown actions__item">
                <i data-toggle="dropdown" class="zwicon-more-h"></i>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('profile.delete.confirmation') }}" class="dropdown-item text-danger">{{ __('Delete account') }}</a>
                </div>
            </div>
        </div>
        
        @csrf
        @method('PUT')

        <div class="new-contact__header">
            <label for="avatar" class="zwicon-camera new-contact__upload" title="{{ __('Change avatar') }}"></label>
            <input type="file" name="avatar" id="avatar" class="d-none">

            <img src="{{ asset('img/avatars/' . ($user->avatar ?? 'default.png')) }}" class="new-contact__img" alt="{{ $user->name }}">

            <p class="mt-3 mb-0">
                <strong>{{ $user->name }}</strong><br>
                <span class="text-muted">{{ $user->roleToString() }}</span>
                @error('avatar')
                    <strong class="invalid-feedback d-block">
                        {{ $message }}
                    </strong>
                @enderror
            </p>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">{{ __('Username') }}</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ $user->name }}" value="{{ old('name', $user->name) }}" maxlength="32" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ $user->email }}" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discord">{{ __('Discord') }}</label>
                        <input type="text" name="discord" id="discord" class="form-control @error('discord') is-invalid @enderror" placeholder="{{ $user->discord ?? 'John#0117' }}" value="{{ old('discord', $user->discord) }}" minlength="7" maxlength="37">
                        @error('discord')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discord">{{ __('Password') }}</label>
                        <p>
                            <a href="{{ route('password.change') }}" class="btn btn-theme-dark">{{ __('Change password') }}</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">{{ __('Save profile') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection
