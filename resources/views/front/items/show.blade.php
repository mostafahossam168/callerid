@extends('front.layouts.front')
@section('title', $item->name)
@section('content')

    @livewire('front.item-quantities',['item'=>$item])

@endsection
