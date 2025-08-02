@extends('front.layouts.front')
@section('title')
    {{ __('Queue report') }}
@endsection
@section('content')
@livewire('reports.queue-report')


@endsection
