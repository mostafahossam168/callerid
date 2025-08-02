@extends(auth()->user()->type == 'dr' ? 'doctor.layouts.index' : 'front.layouts.front')
@section('title')
{{ __('admin.Products') }}
@endsection
@section('content')
@livewire('products')

@endsection