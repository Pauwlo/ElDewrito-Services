@extends('layouts.app')

@section('title', __('Edit option:') . ' ' . $option->variant->display_name . ' on ' . $option->map->display_name)

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ $option->variant->display_name }} on {{ $option->map->display_name }}</h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Edit option') }}</h4>

            <form method="POST" action="{{ route('official-playlists.options.update', $option) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="variant">{{ __('Variant') }}</label>
                    <select name="variant" id="variant" class="select2 form-control @error('variant') is-invalid @enderror" data-placeholder="{{ __('- Select -') }}">
                        @foreach ($variants as $variant)
                            <option value="{{ $variant->slug }}"{{ (old('variant', $option->variant->slug) === $variant->slug) ? ' selected' : '' }}>{{ $variant->display_name }} ({{ $variant->file_name }})</option>
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
                        @foreach ($maps as $map)
                            <option value="{{ $map->slug }}"{{ (old('map', $option->map->slug) === $map->slug) ? ' selected' : '' }}>{{ $map->display_name }} ({{ $map->file_name }})</option>
                        @endforeach
                    </select>
                    
                    @error('map')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" name="can-be-veto-result" id="can-be-veto-result" class="custom-control-input @error('can-be-veto-result') is-invalid @enderror"{{ old('can-be-veto-result', $option->can_be_veto_result) ? ' checked' : '' }}>
                        <label for="can-be-veto-result" class="custom-control-label">{{ __('Can be veto result') }}</label>
                    </div>

                    @error('can-be-veto-result')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Save option') }}</button>
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
