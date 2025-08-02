@extends('front.layouts.front')
@section('title')
{{ __('admin.Add patient') }}
@endsection
@section('content')
{{-- @include('front.unpaidInvoicePop') --}}
@livewire('doctor-patients.patient-show',['patient'=>$patient])
{{-- @if ($patient->invoices()->unpaid()->count()>0) --}}
@push('js')
{{-- <script>
    var myModal = new bootstrap.Modal(document.getElementById("unpaid_invoice"), {});
    document.onreadystatechange = function () {
    myModal.show();
    };
</script> --}}
@endpush
{{-- @endif --}}

@endsection
