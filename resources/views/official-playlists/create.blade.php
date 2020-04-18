@extends('layouts.app')

@section('title', 'Create a new playlist')

@section('description', '')

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('New playlist') }}</h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Create a new playlist') }}</h4>

            <form method="POST" action="{{ route('official-playlists.store') }}">
                @csrf

                <div class="form-group">
                    <label for="type">{{ __('Type') }}</label>
                    <select name="type" id="type" class="select2 form-control @error('type') is-invalid @enderror" data-minimum-results-for-search="-1" data-placeholder="{{ __('- Select -') }}" required>
                        <option value=""{{ !old('type') && !request('type') ? ' selected' : '' }}></option>
                        <option value="ranked"{{ old('type') ?? request('type') === 'ranked' ? ' selected' : '' }}>{{ __('Ranked') }}</option>
                        <option value="social"{{ old('type') ?? request('type') === 'social' ? ' selected' : '' }}>{{ __('Social') }}</option>
                    </select>
                    
                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Big Team Battle') }}" value="{{ old('name') }}" required>
                    
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Server name') }}</label>
                    <input type="text" name="server-name" id="server-name" class="form-control @error('server-name') is-invalid @enderror" placeholder="{{ __('Ranked - Big Team Battle') }}" value="{{ old('server-name', $defaultServerName) }}" required>
                    
                    @error('server-name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Message') }}</label>
                    <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" placeholder="{{ __('This is a motd.') }}" required>{{ old('message', $defaultMessage) }}</textarea>
                    
                    @error('message')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Max players') }}</label>
                    <input type="number" name="max-players" id="max-players" class="form-control @error('max-players') is-invalid @enderror" placeholder="16" value="{{ old('max-players') }}" min="1" max="16" required>
                    
                    @error('max-players')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Vote mode') }}</label>
                    <select name="vote-mode" id="vote-mode" class="select2 form-control @error('vote-mode') is-invalid @enderror" data-minimum-results-for-search="-1" data-placeholder="{{ __('- Select -') }}" required>
                        <option value=""{{ !old('vote-mode') ? ' selected' : '' }}></option>
                        <option value="voting"{{ (old('vote-mode') === 'voting') || (request('type') === 'social') ? ' selected' : '' }}>{{ __('Voting') }}</option>
                        <option value="veto"{{ (old('vote-mode') === 'veto') || (request('type') === 'ranked') ? ' selected' : '' }}>{{ __('Veto') }}</option>
                    </select>
                    
                    @error('vote-mode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('Number of revotes') }}</label>
                    <input type="number" name="number-of-revotes" id="number-of-revotes" class="form-control @error('number-of-revotes') is-invalid @enderror" placeholder="1" value="{{ old('number-of-revotes') }}" min="0" max="99" required>
                    
                    @error('number-of-revotes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Create playlist') }}</button>
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
