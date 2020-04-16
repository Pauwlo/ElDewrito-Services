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
                        <a href="#" class="actions__item zwicon-trash" title="{{ __('Delete playlist') }}"></a>
                    </div>

                    <ul>
                        <li>Name: {{ $playlist->name }}</li>
                        <li>Server name: {{ $playlist->server_name }}</li>
                        <li>Message: {{ $playlist->message }}</li>
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