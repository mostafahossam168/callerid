@extends('front.layouts.front')
@section('title')
{{ __('accounting management') }}
@endsection
@section('content')

@livewire('accounting-departments')
@endsection
