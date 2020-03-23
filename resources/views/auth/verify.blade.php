@extends('layouts.auth')

@section('title', 'Verify your email address')

@section('robots', 'noindex, nofollow')

@section('content')
@include('includes.verify-email')
@endsection
