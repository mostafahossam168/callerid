

@extends('doctor.layouts.index')

@section('title')
    {{__("admin.Owner's animals")}} {{ $patient->name }}
@endsection
@section('content')
    @livewire('animals.patient', ['patient' => $patient])

    @push('js')
        <script>
            $('input[type=checkbox]:checked').prop('checked', false);
        </script>
    @endpush
@endsection
