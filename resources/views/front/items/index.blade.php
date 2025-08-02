@extends(auth()->user()->type == 'dr' ? 'doctor.layouts.index' : 'front.layouts.front')
@section('title', 'المنتجات')
@section('content')
@livewire('items')
@endsection