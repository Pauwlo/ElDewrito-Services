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
                    <label for="variant">{{ __('Variant') }}</label>
                    <select name="variant" id="variant" class="select2 form-control @error('variant') is-invalid @enderror" data-placeholder="{{ __('- Select -') }}">
                        <option value=""{{ !old('variant') ? ' selected' : '' }}></option>
                        @foreach ($variants as $variant)
                            <option value="{{ $variant->slug }}"{{ (old('variant') === $variant->slug) ? ' selected' : '' }}>{{ $variant->display_name }} ({{ $variant->file_name }})</option>
                        @endforeach
                    </select>
                    
                    @error('variant')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="map">{{ __('Map') }}</label>
                    <select name="map" id="map" class="select2 form-control @error('map') is-invalid @enderror" data-placeholder="{{ __('- Select -') }}">
                        <option value=""{{ !old('map') ? ' selected' : '' }}></option>
                        @foreach ($maps as $map)
                            <option value="{{ $map->slug }}"{{ (old('map') === $map->slug) ? ' selected' : '' }}>{{ $map->display_name }} ({{ $map->file_name }})</option>
                        @endforeach
                    </select>
                    
                    @error('map')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group custom-control custom-checkbox">
                    <input type="checkbox" name="can-be-veto-result" id="can-be-veto-result" class="custom-control-input @error('can-be-veto-result') is-invalid @enderror"{{ old('can-be-veto-result') ? ' checked' : '' }}>
                    <label for="can-be-veto-result" class="custom-control-label">{{ __('Can be veto result') }}</label>

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

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer></script>
@endsection
