@extends('admin.layouts.admin')
@section('title')

{{ __('admin.invoices') }}
@endsection
@section('content')
{{-- invoices table  --}}
<div>
    <h3>{{__('invoices')}}</h3>
</div>
<div>
    <table class="table table-bordered table-striped text-center">
        <thead>
            <th>{{__('admin.invoice_number')}}</th>
            <th>{{__('admin.patient')}}</th>
            <th>{{__('admin.employee')}}</th>
            <th>{{__('total')}}</th>
            <th>{{__('discount')}}</th>
            <th>{{__('tax')}}</th>
            <th>{{ __('admin.Status') }}</th>
        </thead>
        <tbody>
            @forelse($invoices as $invoice)
            <tr>
                <td>{{$invoice->invoice_number ?? __('admin.Undefined')}}</td>
                <td>{{$invoice->patient->name ?? __('admin.Undefined')}}</td>
                <td>{{$invoice->employee->name ?? __('admin.Undefined')}}</td>
                <td>{{$invoice->total ?? __('admin.Undefined')}}</td>
                <td>{{$invoice->discount ?? __('admin.Undefined')}}</td>
                <td>{{$invoice->tax ?? __('admin.Undefined')}}</td>
                <td>{{ __($invoice->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8">{{__('admin.no_invoices')}}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
