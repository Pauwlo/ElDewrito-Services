@extends('layouts.app')

@section('title', 'Add a command')

@section('description', '')

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('New command') }}</h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Add a command') }}</h4>

            <form method="POST" action="{{ route('official-playlists.commands.store') }}">
                @csrf

                <div class="form-group">
                    <label for="command">{{ __('Command') }}</label>
                    <input type="text" name="command" id="command" class="form-control @error('command') is-invalid @enderror" placeholder="Server.NumberOfTeams 2" value="{{ old('command') }}" required>
                    
                    @error('command')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Add command') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
