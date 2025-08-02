@extends(auth()->user()->type == 'admin' ? 'front.layouts.front' : 'doctor.layouts.index')
@section('title')
عرض الاليف {{ $animal->name }}
@endsection
@section('content')

@include('front.unpaidInvoicePop')
@livewire('animals.view-patient',['patient'=> $animal])
@if ($animal->invoices()->unpaid()->count()>0)
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
