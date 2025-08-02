@extends('front.layouts.front')
@section('title')
    {{ __('Lab Orders') }}
@endsection
@section('content')
    <section class="main-section users">
        @livewire('lab-orders')
    </section>
@endsection
