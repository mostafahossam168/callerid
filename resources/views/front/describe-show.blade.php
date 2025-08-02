@extends('front.layouts.front')
@section('title')
@lang('View prescription')
@endsection
@section('content')
<section class="main-section users">
    <div class="container" id="data-table">
        <a href="{{route('front.pharmacy',['screen' =>'describe'])}}" class="btn btn-sm btn-secondary my-2"> <i class="fa fa-arrow-left"></i> رجوع </a>
        <div class="bg-white shadow p-4 rounded-3">
            <div id="prt-content">
                <div class="d-flex align-items-center gap-1 flex-wrap mb-3 not-print">
                    @if($describe->is_dispensed_by_pharmacist)
                    <span class="badge bg-success fs-14 py-2">@lang('accept')</span>
                    @else
                    <span class="badge bg-warning fs-14 py-2">@lang('waiting')</span>
                    @endif
                    <h6 class="main-heading mb-0 mx-auto fs-6">@lang('Medical prescription no') <span class="text-primary">{{$describe->id}}</span>
                    </h6>
                    <button class="btn btn-sm btn-warning " id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </div>
                <div class="box-invoice">
                    <div class="row">
                        <div class="col-md-4 p-3">
                            <p>
                                <b> {{ setting()->site_name }}</b>
                            </p>
                            <p><b>@lang('Tax number') </b> {{ setting()->tax_no }}</p>
                            <p><b>@lang('address') </b>{{ setting()->address }}</p>
                            <p>
                                <b> @lang('email') </b>
                                {{setting()->email}}
                            </p>
                            <p><b>@lang('phone') </b> {{setting()->phone}}</p>
                        </div>
                        <div class="text-center col-md-4 p-3 d-flex align-items-center justify-content-center">
                            <img class="img-fluid" src="{{ display_file(setting()->logo) }}" alt="" width="130" />
                        </div>
                        <div class="col-md-4 p-3">
                        </div>
                    </div>
                </div>
                <div class="row g-4 row-cols-1 row-cols-md-3 row-cols-lg-5 mb-3">
                    <div class="col text-center">
                        <label for="" class="title-bg">@lang('Owner')</label>
                        <input type="text" disabled value="{{$describe->appointment->patient?->name}}" name="" id="" class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">@lang('pet')</label>
                        <input type="text" disabled value="{{$describe->appointment->animal?->name}}" name="" id="" class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">@lang('Breed')</label>
                        <input type="text" disabled value="{{$describe->appointment->animal?->strain?->name}}" name="" id="" class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">
                            @lang('Age')
                        </label>
                        <input type="text" value="{{$describe->appointment->animal?->age}}" disabled name="" id="" class="form-control">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">
                            @lang('Date')
                        </label>
                        <input type="text" disabled value="{{$describe->created_at->format('Y-m-d')}}" id="" class="form-control">
                    </div>
                </div>
                <div class="row g-4 mb-3">
                    <div class="col-12 text-center">
                        <label for="" class="title-bg">@lang('prescription')</label>
                    </div>

                </div>
                @foreach($describe->items as $item)
                <div class="row g-4 row-cols-1 row-cols-md-3 row-cols-lg-4 mb-3">
                    <div class="col text-center">
                        <label for="" class="title-bg">@lang('medicament name')</label>
                        <input type="text" disabled value="{{$item->pharmacyMedicine?->name}}" name="" id="" class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">
                            @lang('Dosages')
                        </label>
                        <input type="text" disabled value="{{$item->quantity}}" id="" class="form-control">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">@lang('Frequency/rate')</label>
                        <input type="text" disabled value="{{$item->repetition}}" class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">
                            @lang('Duration')
                        </label>
                        <input type="text" disabled value="{{$item->duration}}" id="" class="form-control">
                    </div>
                </div>
                @endforeach
                <div class="d-flex  justify-content-between gap-3 flex-column flex-sm-row align-items-start align-items-sm-center">
                    <div class="d-flex flex-column gap-2 align-items-start">
                        <div>
                            <b>@lang('Name of the pharmacist')</b>
                            {{$describe->pharmacist?->name}}
                        </div>
                        <div>
                            <b> @lang('Pharmacist signature') : {{$describe->pharmacist?->name}}</b>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2 align-items-start align-items-sm-end">
                        <div>
                            <b>@lang('Doctor name')</b>
                            {{$describe->appointment->doctor?->name}}
                        </div>
                        <div>
                            <b> @lang('Doctor signature') {{$describe->appointment->doctor?->name}}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
