@extends('front.layouts.front')
@section('title')
    {{ __('admin.loyalty_points') }}
@endsection
@section('content')
@livewire('points.points')

@endsection
