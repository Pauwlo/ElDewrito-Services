@extends('layouts.error')

@section('code', 429)
@section('name', __('Too Many Requests'))
@section('message', __('Sorry, you are making too many requests to our servers.'))
