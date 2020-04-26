@extends('layouts.app')

@section('title', __('Command:') . " $command->command")

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>
            {{ $command->command }}
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
                                <a href="{{ route('official-playlists.commands.edit', $command) }}" class="dropdown-item">{{ __('Edit command') }}</a>
                                <a href="{{ route('official-playlists.commands.destroy', $command) }}" class="dropdown-item text-danger" onclick="event.preventDefault();document.getElementById('delete-command-form').submit();">{{ __('Remove command') }}</a>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('official-playlists.commands.destroy', $command) }}" id="delete-command-form" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                    <ul>
                        <li>Command: {{ $command->command }}</li>
                    </ul>
                </div>

                <div class="card-header">
                    <small class="text-secondary">{{ __('Created') }} <span title="{{ $command->created_at }}">{{ $command->created_at->diffForHumans() }}</span>, {{ __('and updated') }} <span title="{{ $command->updated_at }}">{{ $command->updated_at->diffForHumans() }}</span>.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
