@extends('layouts.app')

@section('title', $title)

@section('description', '')

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>
            {{ $playlist->name }}
            <small>{{ $type }}</small>
        </h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Edit playlist') }}</h4>

            <form method="POST" action="{{ $updateRoute }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ $playlist->name }}" value="{{ old('name', $playlist->name) }}" required>
                    
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Server name') }}</label>
                    <input type="text" name="server-name" id="server-name" class="form-control @error('server-name') is-invalid @enderror" placeholder="{{ $playlist->server_name }}" value="{{ old('server-name', $playlist->server_name) }}" required>
                    
                    @error('server-name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Message') }}</label>
                    <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" placeholder="{{ $playlist->message }}" required>{{ old('message', $playlist->message) }}</textarea>
                    
                    @error('message')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Max players') }}</label>
                    <input type="number" name="max-players" id="max-players" class="form-control @error('max-players') is-invalid @enderror" placeholder="{{ $playlist->max_players }}" value="{{ old('max-players', $playlist->max_players) }}" min="1" max="16" required>
                    
                    @error('max-players')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Vote mode') }}</label>
                    <select name="vote-mode" id="vote-mode" class="select2 form-control @error('vote-mode') is-invalid @enderror" data-minimum-results-for-search="-1" required>
                        <option value="voting"{{ ((old('vote-mode') ?? $playlist->voteModeToString()) === 'voting') ? ' selected' : ''}}>{{ __('Voting') }}</option>
                        <option value="veto"{{ ((old('vote-mode') ?? $playlist->voteModeToString()) === 'veto') ? ' selected' : ''}}>{{ __('Veto') }}</option>
                    </select>
                    
                    @error('vote-mode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Number of revotes') }}</label>
                    <input type="number" name="number-of-revotes" id="number-of-revotes" class="form-control @error('number-of-revotes') is-invalid @enderror" placeholder="{{ $playlist->number_of_revotes }}" value="{{ old('number-of-revotes', $playlist->number_of_revotes) }}" min="0" max="99" required>
                    
                    @error('number-of-revotes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Save playlist') }}</button>
            </form>
        </div>
    </div>

    @if ($playlist instanceof \App\OfficialPlaylists\RankedPlaylist)
        <div class="card" id="edit-options">
            <div class="card-body">
                <h4 class="card-title">{{ __('Edit playlist options') }}</h4>

                <form method="POST" action="{{ route('official-playlists.playlists.ranked.options.add', $playlist) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="option">{{ __('Options available') }}</label>
                        <select name="option" id="option" class="select2 form-control @error('option') is-invalid @enderror" data-placeholder="{{ __('- Select -') }}">
                            <option value=""{{ !old('option') ? ' selected' : '' }}></option>
                            @foreach ($playlist->optionsAvailable() as $option)
                                <option value="{{ $option->slug }}"{{ (old('option') === $option->slug) ? ' selected' : '' }}>{{ $option->variant->display_name }} on {{ $option->map->display_name }} ({{ $option->variant->file_name }} on {{ $option->map->file_name }})</option>
                            @endforeach
                        </select>
                        
                        @error('option')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">{{ __('Add option') }}</button>
                </form>

                @if (count($playlist->options))
                    <p class="mt-4">{{ __('Options in the playlist:') }}</p>

                    @foreach ($playlist->options as $option)
                        <a href="{{ route('official-playlists.options.show', $option) }}"><strong>{{ $option->variant->display_name }} on {{ $option->map->display_name }}</strong></a>
                        <ul>
                            <li>Variant: <a href="{{ route('official-playlists.variants.show', $option->variant) }}">{{ $option->variant->display_name }} ({{ $option->variant->file_name }})</a></li>
                            <li>Map: <a href="{{ route('official-playlists.maps.show', $option->map) }}">{{ $option->map->display_name }} ({{ $option->map->file_name }})</a></li>
                            <li>Can be veto result: {{ $option->can_be_veto_result ? __('Yes') : __('No') }}</li>
                        </ul>
                    @endforeach
                @endif
            </div>
        </div>
    @endif

    @if ($playlist instanceof \App\OfficialPlaylists\SocialPlaylist)
        <div class="card" id="edit-maps">
            <div class="card-body">
                <h4 class="card-title">{{ __('Edit playlist maps') }}</h4>

                <form method="POST" action="{{ route('official-playlists.playlists.social.maps.add', $playlist) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="map">{{ __('Maps available') }}</label>
                        <select name="map" id="map" class="select2 form-control @error('map') is-invalid @enderror" data-placeholder="{{ __('- Select -') }}">
                            <option value=""{{ !old('map') ? ' selected' : '' }}></option>
                            @foreach ($playlist->mapsAvailable() as $map)
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

                @if (count($playlist->maps))
                    <p class="mt-4">{{ __('Maps in the playlist:') }}</p>

                    <ul>
                        @foreach ($playlist->maps as $map)
                            <li><a href="{{ route('official-playlists.maps.show', $map) }}">{{ $map->display_name }} ({{ $map->file_name }})</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="card" id="edit-variants">
            <div class="card-body">
                <h4 class="card-title">{{ __('Edit playlist variants') }}</h4>

                <form method="POST" action="{{ route('official-playlists.playlists.social.variants.add', $playlist) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="variant">{{ __('Variants available') }}</label>
                        <select name="variant" id="variant" class="select2 form-control @error('variant') is-invalid @enderror" data-placeholder="{{ __('- Select -') }}">
                            <option value=""{{ !old('variant') ? ' selected' : '' }}></option>
                            @foreach ($playlist->variantsAvailable() as $variant)
                                <option value="{{ $variant->slug }}"{{ (old('variant') === $variant->slug) ? ' selected' : '' }}>{{ $variant->display_name }} ({{ $variant->file_name }})</option>
                            @endforeach
                        </select>
                        
                        @error('variant')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">{{ __('Add variant') }}</button>
                </form>

                @if (count($playlist->variants))
                    <p class="mt-4">{{ __('Variants in the playlist:') }}</p>

                    <ul>
                        @foreach ($playlist->variants as $variant)
                            <li><a href="{{ route('official-playlists.variants.show', $variant) }}">{{ $variant->display_name }} ({{ $variant->file_name }})</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer></script>
@endsection
