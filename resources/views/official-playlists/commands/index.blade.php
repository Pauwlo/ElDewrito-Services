@extends('layouts.app')

@section('title', __('Manage commands'))

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('Commands') }}</h1>
    </header>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Manage commands') }}</h4>

                    <div class="actions">
                        <a href="{{ route('official-playlists.commands.create') }}" class="actions__item zwicon-plus" title="{{ __('Add a command') }}"></a>
                    </div>
                </div>

                <div class="listview listview--hover">
                    @foreach ($commands as $command)
                        <div class="listview__item">
                            <div class="listview__content">
                                <div class="listview__heading">{{ $command->command }}</div>
                                <p>{{ __('Updated') }} {{ $command->updated_at->diffForHumans() }}</p>
                            </div>

                            <div class="actions listview__actions">
                                <a href="{{ route('official-playlists.commands.show', $command) }}" title="{{ __('Show command') }}"><i class="actions__item zwicon-document"></i></a>
                                <a href="{{ route('official-playlists.commands.edit', $command) }}" title="{{ __('Edit command') }}"><i class="actions__item zwicon-edit-pencil"></i></a>
                                <a href="{{ route('official-playlists.commands.destroy', $command) }}" title="{{ __('Remove command') }}" onclick="event.preventDefault();document.getElementById('delete-command-form-{{ $command->id }}').submit();"><i class="actions__item zwicon-trash"></i></a>
                            </div>

                            <form method="POST" action="{{ route('official-playlists.commands.destroy', $command) }}" id="delete-command-form-{{ $command->id }}" style="display:none">
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
