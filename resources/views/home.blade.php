@extends('layouts.app')

@section('description', 'Here I will do some cool (and maybe useful) stuff for ElDewrito.')

@section('content')
<div class="content__inner">
    
    @include('includes.alert')

    <header class="content__title">
        <h1>Home</h1>
    </header>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Welcome to ElDewrito Services!</h4>
                    <h6 class="card-subtitle">Here I will do some cool (and maybe useful) stuff for ElDewrito.</h6>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{!! __('misc.latest_subreddit_posts') !!}</h4>
                    <div class="listview listview--hover" id="subreddit-feed"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://static.sekandocdn.net/static/feednami/feednami-client-v1.1.js"></script>
<script src="{{ asset('js/subreddit-parser.min.js') }}"></script>
@endsection
