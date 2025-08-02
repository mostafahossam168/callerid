@extends('doctor.layouts.index')
@section('title')
    {{ __('admin.doctor interface') }}
@endsection
@section('content')
    <div class="container">

        <h4 class="main-heading mb-4">{{ __('doctor interface')}}</h4>
        <livewire:doctor-interface />

    </div>
@endsection
