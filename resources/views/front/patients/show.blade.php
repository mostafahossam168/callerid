@extends('front.layouts.front')
@section('title')
    {{ $patient->name }}
@endsection
@section('content')
    @include('front.unpaidInvoicePop')
    @livewire('patients.view-patient', ['patient' => $patient])
    @if ($patient->invoices()->unpaid()->count() > 0)
        @push('js')
            <script>
                var myModal = new bootstrap.Modal(document.getElementById("unpaid_invoice"), {});
                document.onreadystatechange = function() {
                    myModal.show();
                };
            </script>
        @endpush
    @endif
@endsection
