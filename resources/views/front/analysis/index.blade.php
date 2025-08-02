@extends('front.layouts.front')
@section('title', 'التحاليل')
@section('content')
    @livewire('mkhtbr.analysis.mkhtbr-analysis', ['id' => $id])
@endsection
