@extends('layouts.app')

@section('title', __('Manage maps'))

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('Maps') }}</h1>
    </header>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Manage maps') }}</h4>

                    <div class="actions">
                        <a href="{{ route('official-playlists.maps.create') }}" class="actions__item zwicon-plus" title="{{ __('Add a map') }}"></a>
                    </div>
                </div>

                <div class="listview listview--hover">
                    @foreach ($maps as $map)
                        <div class="listview__item">
                            <div class="listview__content">
                                <div class="listview__heading">{{ $map->display_name }}</div>
                                <p>{{ $map->file_name }} · {{ __('Updated') }} {{ $map->updated_at->diffForHumans() }}</p>
                            </div>

                            <div class="actions listview__actions">
                                <a href="{{ route('official-playlists.maps.show', $map) }}" title="{{ __('Show map') }}"><i class="actions__item zwicon-document"></i></a>
                                <a href="{{ route('official-playlists.maps.edit', $map) }}" title="{{ __('Edit map') }}"><i class="actions__item zwicon-edit-pencil"></i></a>
                                <a href="{{ route('official-playlists.maps.destroy', $map) }}" title="{{ __('Remove map') }}" onclick="event.preventDefault();document.getElementById('delete-map-form-{{ $map->id }}').submit();"><i class="actions__item zwicon-trash"></i></a>
                            </div>

                            <form method="POST" action="{{ route('official-playlists.maps.destroy', $map) }}" id="delete-map-form-{{ $map->id }}" style="display:none">
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
