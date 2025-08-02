@extends('front.layouts.front')
@section('title', 'عرض فاتورة')
@section('content')
    @livewire('orders.show', ['id' => $id])
@endsection
