@extends('layouts.app')

@section('title', __('Option:') . ' ' . $option->variant->display_name . ' on ' . $option->map->display_name)

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ $option->variant->display_name }} on {{ $option->map->display_name }}</h1>
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
                                <a href="{{ route('official-playlists.options.edit', $option) }}" class="dropdown-item">{{ __('Edit option') }}</a>
                                <a href="{{ route('official-playlists.options.destroy', $option) }}" class="dropdown-item text-danger" onclick="event.preventDefault();document.getElementById('delete-option-form').submit();">{{ __('Delete option') }}</a>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('official-playlists.options.destroy', $option) }}" id="delete-option-form" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                    <ul>
                        <li>Variant: {{ $option->variant->display_name }} ({{ $option->variant->file_name }})</li>
                        <li>Map: {{ $option->map->display_name }} ({{ $option->map->file_name }})</li>
                        <li>Can be veto result: {{ $option->can_be_veto_result ? __('Yes') : __('No') }}</li>
                    </ul>
                </div>

                <div class="card-header">
                    <small class="text-secondary">{{ __('Created') }} <span title="{{ $option->created_at }}">{{ $option->created_at->diffForHumans() }}</span>, {{ __('and updated') }} <span title="{{ $option->updated_at }}">{{ $option->updated_at->diffForHumans() }}</span>.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
