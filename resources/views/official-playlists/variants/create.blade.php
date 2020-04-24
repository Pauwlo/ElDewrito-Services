@extends('layouts.app')

@section('title', 'Add a variant')

@section('description', '')

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('New variant') }}</h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Add a variant') }}</h4>

            <form method="POST" action="{{ route('official-playlists.variants.store') }}">
                @csrf

                <div class="form-group">
                    <label for="display-name">{{ __('Display name') }}</label>
                    <input type="text" name="display-name" id="display-name" class="form-control @error('display-name') is-invalid @enderror" placeholder="Guardian" value="{{ old('display-name') }}" required>
                    
                    @error('display-name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file-name">{{ __('File name') }}</label>
                    <input type="text" name="file-name" id="server-name" class="form-control @error('file-name') is-invalid @enderror" placeholder="guardian" value="{{ old('file-name') }}" required>
                    
                    @error('file-name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Add variant') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
