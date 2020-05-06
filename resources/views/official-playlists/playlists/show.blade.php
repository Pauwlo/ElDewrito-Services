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

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Details') }}</h4>

                    <div class="actions">
                        <div class="dropdown actions__item">
                            <i data-toggle="dropdown" class="zwicon-more-h"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ $jsonRoute }}" target="_blank" class="dropdown-item">{{ __('Generate JSON') }}</a>
                                <a href="{{ $editRoute }}" class="dropdown-item">{{ __('Edit playlist') }}</a>
                                <a href="{{ $destroyRoute }}" class="dropdown-item text-danger" onclick="event.preventDefault();document.getElementById('delete-playlist-form').submit();">{{ __('Delete playlist') }}</a>
                            </div>
                        </div>

                        <form method="POST" action="{{ $destroyRoute }}" id="delete-playlist-form" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                    <ul>
                        <li>Name: {{ $playlist->name }}</li>
                        <li>Server name: {{ $playlist->server_name }}</li>
                        <li>Message:
                            <p>{!! nl2br(e($playlist->message)) !!}</p>
                        </li>
                        <li>Max players: {{ $playlist->max_players }}</li>
                        <li>Vote mode: {{ $playlist->vote_mode ? 'Veto' : 'Voting' }}</li>
                        <li>Number of revotes: {{ $playlist->number_of_revotes }}</li>
                    </ul>
                </div>

                <div class="card-header">
                    <small class="text-secondary">{{ __('Created') }} <span title="{{ $playlist->created_at }}">{{ $playlist->created_at->diffForHumans() }}</span>, {{ __('and updated') }} <span title="{{ $playlist->updated_at }}">{{ $playlist->updated_at->diffForHumans() }}</span>.</small>
                </div>
            </div>
        </div>
    </div>

    @if ($playlist instanceof \App\OfficialPlaylists\RankedPlaylist)
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pb-0">
                        <h4 class="card-title">{{ __('Options') }}</h4>

                        <div class="actions">
                            <div class="dropdown actions__item">
                                <i data-toggle="dropdown" class="zwicon-more-h"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ $editRoute }}#edit-options" class="dropdown-item">{{ __('Edit playlist options') }}</a>
                                </div>
                            </div>
                        </div>

                        @foreach ($playlist->options as $option)
                            <a href="{{ route('official-playlists.options.show', $option) }}"><strong>{{ $option->variant->display_name }} on {{ $option->map->display_name }}</strong></a>
                            <ul>
                                <li>Variant: <a href="{{ route('official-playlists.variants.show', $option->variant) }}">{{ $option->variant->display_name }} ({{ $option->variant->file_name }})</a></li>
                                <li>Map: <a href="{{ route('official-playlists.maps.show', $option->map) }}">{{ $option->map->display_name }} ({{ $option->map->file_name }})</a></li>
                                <li>Can be veto result: {{ $option->can_be_veto_result ? __('Yes') : __('No') }}</li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($playlist instanceof \App\OfficialPlaylists\SocialPlaylist)
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pb-0">
                        <h4 class="card-title">{{ __('Maps') }}</h4>

                        <div class="actions">
                            <div class="dropdown actions__item">
                                <i data-toggle="dropdown" class="zwicon-more-h"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ $editRoute }}#edit-maps" class="dropdown-item">{{ __('Edit playlist maps') }}</a>
                                </div>
                            </div>
                        </div>

                        <ul>
                            @foreach ($playlist->maps as $map)
                                <li><a href="{{ route('official-playlists.maps.show', $map) }}">{{ $map->display_name }} ({{ $map->file_name }})</a></li>
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
                        <h4 class="card-title">{{ __('Variants') }}</h4>

                        <div class="actions">
                            <div class="dropdown actions__item">
                                <i data-toggle="dropdown" class="zwicon-more-h"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ $editRoute }}#edit-variants" class="dropdown-item">{{ __('Edit playlist variants') }}</a>
                                </div>
                            </div>
                        </div>

                        <ul>
                            @foreach ($playlist->variants as $variant)
                                <li><a href="{{ route('official-playlists.variants.show', $variant) }}">{{ $variant->display_name }} ({{ $variant->file_name }})</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
