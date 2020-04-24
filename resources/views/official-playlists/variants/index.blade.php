@extends('layouts.app')

@section('title', __('Manage variants'))

@section('content')
<div class="content__inner content__inner--sm">

    @include('includes.verify-email')

    @include('includes.alert')

    <header class="content__title">
        <h1>{{ __('Variants') }}</h1>
    </header>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title">{{ __('Manage variants') }}</h4>

                    <div class="actions">
                        <a href="{{ route('official-playlists.variants.create') }}" class="actions__item zwicon-plus" title="{{ __('Add a variant') }}"></a>
                    </div>
                </div>

                <div class="listview listview--hover">
                    @foreach ($variants as $variant)
                        <div class="listview__item">
                            <div class="listview__content">
                                <div class="listview__heading">{{ $variant->display_name }}</div>
                                <p>{{ $variant->file_name }} · {{ __('Updated') }} {{ $variant->updated_at->diffForHumans() }}</p>
                            </div>

                            <div class="actions listview__actions">
                                <a href="{{ route('official-playlists.variants.show', $variant) }}" title="{{ __('Show variant') }}"><i class="actions__item zwicon-document"></i></a>
                                <a href="{{ route('official-playlists.variants.edit', $variant) }}" title="{{ __('Edit variant') }}"><i class="actions__item zwicon-edit-pencil"></i></a>
                                <a href="{{ route('official-playlists.variants.destroy', $variant) }}" title="{{ __('Remove variant') }}" onclick="event.preventDefault();document.getElementById('delete-variant-form-{{ $variant->id }}').submit();"><i class="actions__item zwicon-trash"></i></a>
                            </div>

                            <form method="POST" action="{{ route('official-playlists.variants.destroy', $variant) }}" id="delete-variant-form-{{ $variant->id }}" style="display:none">
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
