@extends('front.layouts.front')
@section('title')
    تعديل سند القيد
@endsection
@section('content')
    @livewire('voucher.edit', ['voucher' => $voucher])
@endsection
