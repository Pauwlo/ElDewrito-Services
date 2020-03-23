@extends('layouts.app')

@section('title', 'Profile – ' . config('app.name', 'ElDewrito Services'))

@section('description', '')

@section('content')
<div class="content__inner content__inner--sm">

    <header class="content__title">
        <h1>{{ __('Profile') }}</h1>
    </header>

    <div class="card new-contact">
        <div class="new-contact__header">
            <img src="{{ asset('img/avatars/default.png') }}" class="new-contact__img" alt="{{ $user->name }}">
        </div>

        <form method="POST" action="{{ route('profile') }}" class="card-body">
            @csrf
            @method('PUT')

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
            </div>

            <div class="clearfix"></div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">{{ __('Save profile') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
