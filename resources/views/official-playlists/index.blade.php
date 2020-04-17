@extends('layouts.app')

@section('title', 'Official Playlists')

@section('description', '')

@section('content')
<div class="content__inner">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('Official Playlists') }}</h1>
    </header>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Ranked Playlists') }}</h4>

                    <div class="actions">
                        <a href="#" class="actions__item zwicon-plus" title="{{ __('Add playlist') }}"></a>
                    </div>
                </div>

                <div class="listview listview--hover">
                    @foreach ($rankedPlaylists as $playlist)
                        <div class="listview__item">
                            <div class="listview__content">
                                <div class="listview__heading">{{ $playlist->name }}</div>
                                <p>{{ $playlist->max_players }} {{ __('players') }} · {{ $playlist->vote_mode ? __('Veto') : __('Voting') }} · {{ __('Updated') }} {{ $playlist->updated_at->diffForHumans() }}</p>
                            </div>

                            <div class="actions listview__actions">
                                <a href="{{ route('official-playlists.ranked.show', $playlist) }}" title="{{ __('Show playlist') }}"><i class="actions__item zwicon-document"></i></a>
                                <a href="{{ route('official-playlists.ranked.edit', $playlist) }}" title="{{ __('Edit playlist') }}"><i class="actions__item zwicon-edit-pencil"></i></a>
                                <a href="{{ route('official-playlists.ranked.destroy', $playlist) }}" title="{{ __('Delete playlist') }}" onclick="event.preventDefault();document.getElementById('delete-ranked-playlist-form-{{ $playlist->slug }}').submit();"><i class="actions__item zwicon-trash"></i></a>
                            </div>

                            <form method="POST" action="{{ route('official-playlists.ranked.destroy', $playlist) }}" id="delete-ranked-playlist-form-{{ $playlist->slug }}" style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    @endforeach

                    <div class="clearfix mb-3"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Social Playlists') }}</h4>

                    <div class="actions">
                        <a href="#" class="actions__item zwicon-plus" title="{{ __('Add playlist') }}"></a>
                    </div>
                </div>

                <div class="listview listview--hover">
                    @foreach ($socialPlaylists as $playlist)
                        <div class="listview__item">
                            <div class="listview__content">
                                <div class="listview__heading">{{ $playlist->name }}</div>
                                <p>{{ $playlist->max_players }} {{ __('players') }} · {{ $playlist->vote_mode ? __('Veto') : __('Voting') }} · {{ __('Updated') }} {{ $playlist->updated_at->diffForHumans() }}</p>
                            </div>

                            <div class="actions listview__actions">
                                <a href="{{ route('official-playlists.social.show', $playlist) }}" title="{{ __('Show playlist') }}"><i class="actions__item zwicon-document"></i></a>
                                <a href="{{ route('official-playlists.social.edit', $playlist) }}" title="{{ __('Edit playlist') }}"><i class="actions__item zwicon-edit-pencil"></i></a>
                                <a href="{{ route('official-playlists.social.destroy', $playlist) }}" title="{{ __('Delete playlist') }}" onclick="event.preventDefault();document.getElementById('delete-social-playlist-form-{{ $playlist->slug }}').submit();"><i class="actions__item zwicon-trash"></i></a>
                            </div>

                            <form method="POST" action="{{ route('official-playlists.social.destroy', $playlist) }}" id="delete-social-playlist-form-{{ $playlist->slug }}" style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    @endforeach

                    <div class="clearfix mb-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
