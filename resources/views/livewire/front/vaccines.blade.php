<section class="main-section users">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('Vaccinations') }} <small
                class="text-danger fs-12px">{{ __('admin.All prices here include tax in the event of an automatic sale') }}</small>
        </h4>
        <div class="modal fade" id="add_or_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
             wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="collectData-box mb-2">
                            <label for="" class="small-label">الاسم</label>
                            <input type="text" wire:model.defer="name" id="" class="form-control w-100">
                        </div>
                        <div class="collectData-box mb-2">
                            <label for="" class="small-label">السلاله</label>
                            <select class="main-select w-100" wire:model.defer="category_id" id="">
                                <option value="">اختر السلاله</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="collectData-box mb-2">
                            <label for="" class="small-label">السعر</label>
                            <input type="number" wire:model.defer="price" id="" class="form-control w-100">
                        </div>
                        <div class="collectData-box mb-2">
                            <label for="" class="small-label">أعلى نسبة خصم</label>
                            <input type="number" wire:model.defer="discount_rate" id="" class="form-control w-100">
                        </div>

                        <div class="col-sm-12">
                            <div class="inp-holder d-flex align-items-center gap-1">
                                <div class="inp-holder d-flex align-items-center gap-1">
                                    <label class="small-label d-block mb-0" for="">{{ __('admin.sell_with_tax') }}</label>
                                    <input type="checkbox" wire:model.defer="tax_enabled">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger"
                                data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                        <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                                wire:click='submit'>{{ __('admin.Save') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3 shadow p-3">
            <div class="d-flex align-items-center flex-wrap gap-2 mt-2 justify-content-between mb-2">
                <div class="d-flex align-items-center gap-1">
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" wire:model="search"
                               placeholder="{{ __('admin.Search by name') }}">
                    </div>
                </div>

                <div class="btn-holder-option d-flex gap-1">
                    <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
                        {{ __('Add vaccination') }}
                        <i class="icon fa-solid fa-plus me-1"></i>
                    </button>
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <button class="btn  btn-sm btn-outline-primary" id="export-btn">
                        {{ __('admin.Export') }}
                        <i class="fa-solid fa-file-import"></i>
                    </button>

                </div>
            </div>
            <div class="table-responsive" id="data-table">
                <table class="table main-table" id="prt-content">
                    <thead>
                    <tr>
                        <th>{{ __('Vaccination number') }}</th>
                        <th>{{ __('admin.name') }}</th>
                        <th>سلالة الأليف</th>
                        <th>{{ __('admin.price') }}</th>
                        <th>{{ __('admin.max_discount_rate') }}</th>
                        <th>{{ __('admin.tax') }}</th>
                        <th class="text-center not-print">{{ __('admin.managers') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vaccines as $vaccine)
                        <tr>
                            <td>{{ $vaccine->id }}</td>
                            <td>{{ $vaccine->name }}</td>
                            <td>{{ $vaccine->category?->name }}</td>
                            <td>{{ $vaccine->price }}</td>
                            <td> {{$vaccine->discount_rate}}</td>
                            <td>{{$vaccine->tax_enabled ? 'مفعل' : 'غير مفعل'}}</td>
                            <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <a href="{{route('front.vaccine_report',['vaccine' =>$vaccine->id])}}"
                                       class="btn btn-sm trans-btn text-white space-noWrap">{{ __('admin.financial report') }}</a>
                                    <button data-bs-toggle="modal" data-bs-target="#add_or_update"
                                            class="btn btn-sm btn-info text-white" wire:click='edit({{$vaccine->id}})'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{$vaccine->id}}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @include('deleteModal',['item'=>$vaccine])
                                </div>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                    {{$vaccines->links()}}
                </table>
            </div>
        </div>
    </div>
</section>
