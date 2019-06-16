@extends('layouts.app')

@section('content')
<div class="content__inner">
    
    @include('includes.alert')

    <header class="content__title">
        <h1>Home</h1>
    </header>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Welcome to ElDewrito Services!</h4>
            <h6 class="card-subtitle">Here I will do some cool (and maybe useful) stuff for ElDewrito.</h6>
        </div>
    </div>
</div>
@endsection
