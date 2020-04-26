@extends('layouts.app')

@section('title', 'Create an option')

@section('description', '')

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('New option') }}</h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Create an option') }}</h4>

            <form method="POST" action="{{ route('official-playlists.options.store') }}">
                @csrf

                <div class="form-group">
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" name="can-be-veto-result" id="can-be-veto-result" class="custom-control-input @error('can-be-veto-result') is-invalid @enderror"{{ old('can-be-veto-result') ? ' checked' : '' }}>
                        <label for="can-be-veto-result" class="custom-control-label">{{ __('Can be veto result') }}</label>
                    </div>

                    @error('can-be-veto-result')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Create option') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
