@extends('front.layouts.front')
@section('title')
{{ __('admin.Notifications') }}
@endsection
@section('content')
    <section class="main-section notice">
        @php($notifications=App\Models\Notification::latest()->paginate(10))
        <div class="container">
        <h4 class="main-heading">{{ __('admin.Notifications') }}</h4>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#bulkdelete" id="btn_delete_all">
        {{__('admin.Delete all')}}
        </button>
        {{-- <div class="bg-white p-3 rounded-2 shadow">
            @foreach($notifications as $notification)
                {{ $notification->markAsSeen() }}
                <div class="p-3 border-bottom">
                    <a href="{{ $notification->link }}">
                    @if (Carbon::now()->diffInMinutes(Carbon::parse($notification->seen_at)) < 1) <span class="text-danger new">
                    {{__('admin.New')}} </span>
                        @endif
                    <span class="text-main-color"> {{ $notification->title }}:</span>
                    {{ $notification->body }}

                    </a>
                </div>
            @endforeach
        </div> --}}
        <table class="table main-table">
            <thead>
                <th> <input type="checkbox" name="select_all" id="select-all"> </th>
                <th>{{__('admin.Notification')}}</th>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                    <tr>
                        <th >
                            <div class="animated-checkbox">
                                <label class="m-0">
                                    <input type="checkbox" value="{{ $notification->id }}" name="delete_select" id="delete_select">
                                    <span class="label-text"></span>
                                </label>
                            </div>
                        </th>
                        <td>
                            {{ $notification->markAsSeen() }}
                            <div class="p-3 border-bottom">
                                {{-- <a href="{{ $notification->link }}"> --}}
                                    @if (Carbon::now()->diffInMinutes(Carbon::parse($notification->seen_at)) < 1) <span class="text-danger new">
                                    {{__('admin.New')}} </span>
                                        @endif
                                    <span class="text-main-color"> {{ $notification->title }}:</span>
                                    {{ $notification->body }}
                                {{-- </a> --}}
                            </div>
                        </td>
                        <td class="not-print space-noWrap">
                        @include('front.notificationAction')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            {{$notifications->links()}}
        </div>
    </section>

@endsection
