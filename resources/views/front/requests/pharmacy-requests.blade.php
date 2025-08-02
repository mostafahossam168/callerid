@extends('front.layouts.front')
@section('title')
    {{ __('admin.pharmacy_requests') }}
@endsection
@section('content')
    @livewire('pharmacy-requests')
@endsection
