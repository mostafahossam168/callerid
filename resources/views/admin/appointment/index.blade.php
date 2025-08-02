@extends('admin.layouts.admin')
@section('title')
    {{ __('admin.appointments') }}
@endsection
@section('content')
    {{--  appointments table  --}}
    <div>
        <h3>{{__('appointments')}}</h3>
    </div>
    <div>
        <table class="table table-bordered table-striped text-center">
            <thead>
            <th>{{__('admin.appointment_number')}}</th>
            <th>{{__('admin.patient')}}</th>
            <th>{{__('admin.employee')}}</th>
            <th>{{__('admin.doctor')}}</th>
            <th>{{__('admin.clinic')}}</th>
            <th>{{__('admin.appointment_status')}}</th>
            <th>{{__('admin.appointment_time')}}</th>
            <th>{{__('admin.appointment_date')}}</th>
            </thead>
            <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td>{{$appointment->appointment_number ?? __('admin.Undefined')}}</td>
                    <td>{{$appointment->patient->name ?? __('admin.Undefined')}}</td>
                    <td>{{$appointment->employee->name ?? __('admin.Undefined')}}</td>
                    <td>{{$appointment->doctor->name ?? __('admin.Undefined')}}</td>
                    <td>{{$appointment->clinic->name ?? __('admin.Undefined')}}</td>
                    <td>{{$appointment->appointment_status ?? __('admin.Undefined')}}</td>
                    <td>{{$appointment->appointment_time ?? __('admin.Undefined')}}</td>
                    <td>{{$appointment->appointment_date ?? __('admin.Undefined')}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">{{__('admin.no_appointments')}}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
