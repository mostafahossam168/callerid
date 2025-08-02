@extends('front.layouts.front')
@section('title')
    {{ __('admin.maincategories') }}
@endsection
@section('content')
@livewire('categories')


@endsection