@extends('layouts.app')

@section('title', __('Edit command:') . " $command->command")

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>
            {{ $command->command }}
        </h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Edit command') }}</h4>

            <form method="POST" action="{{ route('official-playlists.commands.update', $command) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="command-string">{{ __('Command') }}</label>
                    <input type="text" name="command-string" id="command-string" class="form-control @error('command-string') is-invalid @enderror" placeholder="{{ $command->command }}" value="{{ old('command-string', $command->command) }}" required>
                    
                    @error('command-string')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Save command') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
