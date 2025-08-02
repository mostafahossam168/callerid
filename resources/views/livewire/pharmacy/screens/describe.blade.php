<div class="main-tab-content border-0 pt-3 px-2 pb-0">
    <div class="d-flex justify-content-between mb-3">
        <h4 class="small-heading mb-3">@lang('Prescriptions')</h4>
        <div class="btn-holder">
            <button wire:click="$set('is_dispensed_by_pharmacist','inactive')"
                    class="btn btn-warning btn-sm"> @lang('Recipes awaiting dispensing')
                : {{\App\Models\PharmacyPrescription::where('is_dispensed_by_pharmacist',0)->count()}}</button>
            <button wire:click="$set('is_dispensed_by_pharmacist','active')"
                    class="btn btn-success btn-sm"> @lang('Recipes dispensed')
                : {{\App\Models\PharmacyPrescription::where('is_dispensed_by_pharmacist',1)->count()}}</button>
        </div>
        <div></div>
    </div>
    <div class="bg-white shadow p-4 rounded-3">
        <div
            class="amountPatients-holder gap-2 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-xl-row">
            <div class="row my-3 g-2">
                <div class="col-12 col-sm-12 col-md-12 col-lg-10 d-flex flex-column flex-lg-row gap-2 px-0">
                    <div dir="ltr" class="input-group mb-2 mb-md-0">
                        <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                            @lang('Search')
                        </button>
                        <input dir="rtl" type="text" class="form-control" wire:model.live="prescription_search_by_id"
                               placeholder="@lang('Search by recipe number')">
                    </div>
                    <div dir="ltr" class="input-group mb-2 mb-md-0">
                        <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                            @lang('Search')
                        </button>
                        <input dir="rtl" type="text" class="form-control" wire:model="prescription_search_by_name"
                               placeholder="@lang('Search by mobile number or patient name')">
                    </div>
                </div>
            </div>
            <div class="btn-holders d-flex align-items-center gap-1 flex-wrap">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle" data-bs-toggle="tooltip"
                        data-bs-placement="top" data-bs-custom-class="custom-tooltip fs-10px"
                        data-bs-title="@lang('Providing information about diseases and medical conditions, advising patients about available treatments, and disease prevention')"
                        data-bs-original-title="" title="">
                    <i class="fa-solid fa-question"></i>
                </button>
                <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                    <i class="fa-solid fa-print"></i>
                </button>
                <a class="btn btn-sm btn-outline-primary rounded-0" href="">
                    @lang('Export') Excel
                    <i class="fa-solid fa-file-import"></i>
                </a>
            </div>
        </div>

        <div class="">
            <div id="prt-content" class="table-print">
                <div class="box-header-invoice ">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h6 class="text-center "><b> {{setting()->site_name}}</b></h6>

                        </div>
                        <div class="col-md-4 ">
                            <small class="mb-1 d-block"><b>@lang('Tax number') </b>{{setting()->tax_no}}</small>
                            <small class="mb-1 d-block">
                                <b> @lang('address') </b> {{setting()->address}}
                            </small>
                            <small class="mb-1 d-block"><b> @lang('phone') </b>{{setting()->phone}}</small>
                        </div>
                        <div class="text-center col-md-4  d-flex align-items-center justify-content-center">
                            <img class="img-fluid img-logo mx-auto" src="" alt="">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">

                    <table class="table main-table">
                        <thead>
                        <tr>
                            <th>@lang('Recipe number')</th>
                            <th>@lang('patient')</th>
                            <th>@lang('admin.animal')</th>
                            <th>@lang('Doctor')</th>
                            <th>@lang('(Dispensed by) pharmacist')</th>
                            <th>@lang('Date')</th>
                            <th>@lang('Exchange')</th>
                            <th class="text-center not-print">@lang('actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prescriptions as $prescription)
                            <tr>
                                <td>{{$prescription->id}}</td>
                                <td>{{$prescription->appointment->patient?->name}}</td>
                                <td>{{$prescription->appointment->animal?->name}}</td>
                                <td>{{$prescription->appointment->doctor?->name}}</td>
                                <td>{{$prescription->pharmacist?->name}}</td>
                                <td>{{$prescription->created_at->format('Y-m-d')}}</td>
                                <td>
                                    @if($prescription->is_dispensed_by_pharmacist)
                                        <span class="badge bg-success fs-14">@lang('paid off')</span>
                                    @else
                                        <span class="badge bg-warning fs-14">@lang('Waiting')</span>
                                    @endif
                                </td>
                                <td class="not-print">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        @if(!$prescription->is_dispensed_by_pharmacist)
                                            <button class="btn btn-sm btn-primary"
                                                    wire:click="dispense({{$prescription}})">
                                                @lang('Exchange')</button>
                                        @endif
                                        <a href="{{route('front.describe-show',$prescription->id)}}"
                                           class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('delete_pharmacy_descriptions')
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-placement="top" data-bs-custom-class="fit-tooltip"
                                                    data-bs-title="حذف" data-bs-target="#delete{{$prescription->id}}"
                                                    data-bs-original-title="" title="">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            @include('deleteModal',['item' => $prescription])
                                        @endcan
                                    </div>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
