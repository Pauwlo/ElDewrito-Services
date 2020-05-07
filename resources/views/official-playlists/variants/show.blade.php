@extends('layouts.app')

@section('title', __('Variant:') . " $variant->display_name")

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

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Details') }}</h4>

                    <div class="actions">
                        <div class="dropdown actions__item">
                            <i data-toggle="dropdown" class="zwicon-more-h"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('official-playlists.variants.edit', $variant) }}" class="dropdown-item">{{ __('Edit variant') }}</a>
                                <a href="{{ route('official-playlists.variants.destroy', $variant) }}" class="dropdown-item text-danger" onclick="event.preventDefault();document.getElementById('delete-variant-form').submit();">{{ __('Remove variant') }}</a>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('official-playlists.variants.destroy', $variant) }}" id="delete-variant-form" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                    <ul>
                        <li>Display name: {{ $variant->display_name }}</li>
                        <li>File name: {{ $variant->file_name }}</li>
                    </ul>

                    @if (count($variant->playlists))
                        <p>Playlists including this variant:</p>

                        <ul>
                            @foreach ($variant->playlists as $playlist)
                                <li><a href="{{ route('official-playlists.playlists.social.show', $playlist) }}">{{ $playlist->name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="card-header">
                    <small class="text-secondary">{{ __('Created') }} <span title="{{ $variant->created_at }}">{{ $variant->created_at->diffForHumans() }}</span>, {{ __('and updated') }} <span title="{{ $variant->updated_at }}">{{ $variant->updated_at->diffForHumans() }}</span>.</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Commands') }}</h4>

                    <div class="actions">
                        <div class="dropdown actions__item">
                            <i data-toggle="dropdown" class="zwicon-more-h"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('official-playlists.variants.edit', $variant) }}#edit-commands" class="dropdown-item">{{ __('Edit variant commands') }}</a>
                            </div>
                        </div>
                    </div>

                    <ul>
                        @foreach ($variant->commands as $command)
                            <li><a href="{{ route('official-playlists.commands.show', $command) }}">{{ $command->command }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Specific maps') }}</h4>

                    <div class="actions">
                        <div class="dropdown actions__item">
                            <i data-toggle="dropdown" class="zwicon-more-h"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('official-playlists.variants.edit', $variant) }}#edit-maps" class="dropdown-item">{{ __('Edit variant specific maps') }}</a>
                            </div>
                        </div>
                    </div>

                    <ul>
                        @foreach ($variant->specificMaps as $map)
                            <li><a href="{{ route('official-playlists.maps.show', $map) }}">{{ $map->display_name }} ({{ $map->file_name }})</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
