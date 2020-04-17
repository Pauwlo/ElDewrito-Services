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
</div>
@endsection
