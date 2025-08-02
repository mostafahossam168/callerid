@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Notifications') }}
@endsection
@section('content')
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <table class="table main-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>العنوان</th>
                <th>الفاتوره</th>
                <th>الحيوان</th>
                <th>المالك</th>
                <th>المستخدم</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
            @php
            $invoice = App\Models\Invoice::find($notification->invoice_id);
            @endphp
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $notification->title }} </td>
                <td><a href="{{$notification->link}}"><i class="fa fa-money-bills text-danger"></i></a></td>
                <td>
                    @foreach ($invoice?->animals ?? [] as $animal)
                    <span class="badge bg-primary">{{ $animal->name }}</span>
                    @endforeach
                </td>
                <td>{{ $invoice?->patient?->name }}</td>
                <td>{{$notification->user?->name}}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#delete_agent{{ $notification->id }}"><i></i>
                        {{ __('admin.Delete') }}
                    </button>
                    @include('admin.notifications.delete')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $notifications->links() }}

</div>
@endsection