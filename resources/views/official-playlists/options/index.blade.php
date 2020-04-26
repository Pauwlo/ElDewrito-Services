@extends('layouts.app')

@section('title', __('Manage options'))

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('Options') }}</h1>
    </header>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Manage options') }}</h4>

                    <div class="actions">
                        <a href="{{ route('official-playlists.options.create') }}" class="actions__item zwicon-plus" title="{{ __('Create an option') }}"></a>
                    </div>
                </div>

                <div class="listview listview--hover">
                    @foreach ($options as $option)
                        <div class="listview__item">
                            <div class="listview__content">
                                <div class="listview__heading">{{ $option->id }}</div>
                                <p>{{ __('Updated') }} {{ $option->updated_at->diffForHumans() }}</p>
                            </div>

                            <div class="actions listview__actions">
                                <a href="{{ route('official-playlists.options.show', $option) }}" title="{{ __('Show option') }}"><i class="actions__item zwicon-document"></i></a>
                                <a href="{{ route('official-playlists.options.edit', $option) }}" title="{{ __('Edit option') }}"><i class="actions__item zwicon-edit-pencil"></i></a>
                                <a href="{{ route('official-playlists.options.destroy', $option) }}" title="{{ __('Delete option') }}" onclick="event.preventDefault();document.getElementById('delete-option-form-{{ $option->id }}').submit();"><i class="actions__item zwicon-trash"></i></a>
                            </div>

                            <form method="POST" action="{{ route('official-playlists.options.destroy', $option) }}" id="delete-option-form-{{ $option->id }}" style="display:none">
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
