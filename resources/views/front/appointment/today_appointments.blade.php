@extends('front.layouts.front')
@section('title')
    {{ __('admin.today_appointments') }}
@endsection
@section('content')
    @livewire('today_appointments')

    @push('js')
        <script src="{{ asset('js/diagnosticsPage.js') }}"></script>
    @endpush
@endsection
