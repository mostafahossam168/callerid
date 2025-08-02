@extends('front.layouts.front')
@section('title')
    {{ __('admin.medicines') }}
@endsection
@section('content')
    @livewire('medicines')
@endsection
