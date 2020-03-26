@extends('layouts.error')

@section('code', 503)
@section('name', __('Service Unavailable'))
@if ($exception->getMessage())
    @section('message', $exception->getMessage())
@else
    @section('message', __('Sorry, we are doing some maintenance. Please check back soon.'))
@endif
