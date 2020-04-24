@extends('layouts.app')

@section('title', __('Map:') . " $map->display_name")

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

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Details') }}</h4>

                    <div class="actions">
                        <div class="dropdown actions__item">
                            <i data-toggle="dropdown" class="zwicon-more-h"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('official-playlists.maps.edit', $map) }}" class="dropdown-item">{{ __('Edit map') }}</a>
                                <a href="{{ route('official-playlists.maps.destroy', $map) }}" class="dropdown-item text-danger" onclick="event.preventDefault();document.getElementById('delete-map-form').submit();">{{ __('Delete map') }}</a>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('official-playlists.maps.destroy', $map) }}" id="delete-map-form" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                    <ul>
                        <li>Display name: {{ $map->display_name }}</li>
                        <li>File name: {{ $map->file_name }}</li>
                    </ul>
                </div>

                <div class="card-header">
                    <small class="text-secondary">{{ __('Created') }} <span title="{{ $map->created_at }}">{{ $map->created_at->diffForHumans() }}</span>, {{ __('and updated') }} <span title="{{ $map->updated_at }}">{{ $map->updated_at->diffForHumans() }}</span>.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
