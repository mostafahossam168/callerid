@extends('front.layouts.front')
@section('title')
    {{ __('admin.home') }}
@endsection
@section('content')
    @livewire('front.home')
@endsection
