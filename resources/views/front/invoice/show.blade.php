@extends('front.layouts.front')

@section('title')
{{ __('admin.Show invoice') }}
@endsection
@section('content')
@livewire('invoices.show-invoice',['invoice'=>$invoice])
@endsection
