@extends('layouts.app')

@section('title', __('Edit variant:') . " $variant->display_name")

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>
            {{ $variant->display_name }}
            <small>{{ $variant->file_name }}</small>
        </h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Edit variant') }}</h4>

            <form method="POST" action="{{ route('official-playlists.variants.update', $variant) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="display-name">{{ __('Display name') }}</label>
                    <input type="text" name="display-name" id="display-name" class="form-control @error('display-name') is-invalid @enderror" placeholder="{{ $variant->display_name }}" value="{{ old('display-name', $variant->display_name) }}" required>
                    
                    @error('display-name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('File name') }}</label>
                    <input type="text" name="file-name" id="file-name" class="form-control @error('file-name') is-invalid @enderror" placeholder="{{ $variant->file_name }}" value="{{ old('file-name', $variant->file_name) }}" required>
                    
                    @error('file-name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Save variant') }}</button>
            </form>
        </div>
    </div>

    <div class="card" id="edit-commands">
        <div class="card-body">
            <h4 class="card-title">{{ __('Edit variant commands') }}</h4>

            <form method="POST" action="{{ route('official-playlists.variants.commands.add', $variant) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="command">{{ __('Commands available') }}</label>
                    <select name="command" id="command" class="select2 form-control @error('command') is-invalid @enderror" data-placeholder="{{ __('- Select -') }}" required>
                        <option value=""{{ !old('command') ? ' selected' : '' }}></option>
                        @foreach ($variant->commandsAvailable() as $command)
                            <option value="{{ $command->slug }}"{{ (old('command') === $command->slug) ? ' selected' : '' }}>{{ $command->command }}</option>
                        @endforeach
                    </select>
                    
                    @error('command')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Add command') }}</button>
            </form>

            @if (count($variant->commands))
                <p class="mt-4">{{ __('Commands in the variant:') }}</p>

                <ul>
                    @foreach ($variant->commands as $command)
                        <li><a href="{{ route('official-playlists.commands.show', $command) }}">{{ $command->command }}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="card" id="edit-maps">
        <div class="card-body">
            <h4 class="card-title">{{ __('Edit variant specific maps') }}</h4>

            <form method="POST" action="{{ route('official-playlists.variants.maps.add', $variant) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="map">{{ __('Maps available') }}</label>
                    <select name="map" id="map" class="select2 form-control @error('map') is-invalid @enderror" data-placeholder="{{ __('- Select -') }}" required>
                        <option value=""{{ !old('map') ? ' selected' : '' }}></option>
                        @foreach ($variant->mapsAvailable() as $map)
                            <option value="{{ $map->slug }}"{{ (old('map') === $map->slug) ? ' selected' : '' }}>{{ $map->display_name }} ({{ $map->file_name }})</option>
                        @endforeach
                    </select>
                    
                    @error('map')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Add map') }}</button>
            </form>

            @if (count($variant->specificMaps))
                <p class="mt-4">{{ __('Maps in the variant:') }}</p>

                <ul>
                    @foreach ($variant->specificMaps as $map)
                        <li><a href="{{ route('official-playlists.maps.show', $map) }}">{{ $map->display_name }} ({{ $map->file_name }})</a></li>
                    @endforeach
                </ul>
            @endif
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
