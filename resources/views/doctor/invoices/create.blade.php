 @extends('doctor.layouts.index')
 @section('title')
     {{ __('admin.Add invoice') }}
 @endsection
 @section('content')
     @livewire('doctor-invoice.add-invoice')
 @endsection
