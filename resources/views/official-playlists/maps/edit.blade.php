@extends('layouts.app')

@section('title', __('Edit map:') . " $map->display_name")

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>
            {{ $map->display_name }}
            <small>{{ $map->file_name }}</small>
        </h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Edit map') }}</h4>

            <form method="POST" action="{{ route('official-playlists.maps.update', $map) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="display-name">{{ __('Display name') }}</label>
                    <input type="text" name="display-name" id="display-name" class="form-control @error('display-name') is-invalid @enderror" placeholder="{{ $map->display_name }}" value="{{ old('display-name', $map->display_name) }}" required>
                    
                    @error('display-name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">{{ __('File name') }}</label>
                    <input type="text" name="file-name" id="file-name" class="form-control @error('file-name') is-invalid @enderror" placeholder="{{ $map->file_name }}" value="{{ old('file-name', $map->file_name) }}" required>
                    
                    @error('file-name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('Save map') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
