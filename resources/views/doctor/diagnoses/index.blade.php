@extends('doctor.layouts.index')
@section('title')
{{ __('admin.Diagnoses') }}
@endsection
@section('content')
@livewire('diagnoses')

@push('js')
<script src="{{ asset('js/diagnosticsPage.js') }}"></script>
@endpush
@endsection
