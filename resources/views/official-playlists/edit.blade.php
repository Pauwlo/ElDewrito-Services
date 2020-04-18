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
                    <select name="vote-mode" id="vote-mode" class="form-control @error('vote-mode') is-invalid @enderror" required>
                        <option value="voting"{{ (old('vote-mode') ?? $playlist->vote_mode === 'voting') ? ' selected' : ''}}>{{ __('Voting') }}</option>
                        <option value="veto"{{ (old('vote-mode') ?? $playlist->vote_mode === 'veto') ? ' selected' : ''}}>{{ __('Veto') }}</option>
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
</div>
@endsection
