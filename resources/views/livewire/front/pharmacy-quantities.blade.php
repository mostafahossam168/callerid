<section class="diagnostics-section main-section py-5">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading mb-4">عمليات المنتج {{$pharmacyMedicine?->name}}</h4>
        <div class="diagnostics-content bg-white p-4 rounded-2 shadow">
            <div class="row mb-3 g-3">
                <div class="col-md-8">
                    <!-- important component -->
                    <div class="row g-3">
                        <div class="col-12 col-md-3">
                            <div class="small-label">
                                <input type="text" class="ser-patirnt-id form-control mb-3 mb-md-0" wire:model="filter_patient" id="ser-patirnt-id" placeholder="بحث بالرقم التشغيلي" />
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="small-label">
                                <select class="main-select w-100 doctor-name mb-3 mb-md-0" wire:model='type'>
                                    <option value="">نوع العملية</option>
                                    <option value="charge">شحن</option>
                                    <option value="expense">صرف</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- important component -->
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-end">
                    <div class="small-label">
                        <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="prt-content" class="table-print">
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <th>الرقم التشغيلي</th>
                            <th>اسم المستودع</th>
                            <th>من المستودع</th>
                            <th>الي المستودع</th>
                            <th>التاريخ</th>
                            <th>الكمية</th>
                            <th>نوع العملية</th>
                            <th class="not-print">{{__('actions')}}</th>
                        </thead>

                        <tbody>
                            @foreach($quantities as $item)
                            <tr>
                                <td>{{$item->operational_number}}</td>
                                <td>{{$item->pharmacyWarehouse?->name ?? '--'}}</td>
                                <td>{{$item->fromWarehouse?->name ?? '--'}}</td>
                                <td>{{$item->toWarehouse?->name ?? '--'}}</td>
                                <td>{{$item->created_at->format('Y-m-d') ?? '--'}}</td>
                                <td>{{$item->quantity ?? '--'}}</td>
                                <td>{{__($item->type)}}</td>
                                <td class="not-print space-noWrap">
                                    @if($item->trashed())
                                    تم ارجاع العملية في {{$item->deleted_at->format('a g:i  d-m-Y ')}}

                                    @else
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$item->id}}">
                                        ارجاع
                                    </button>
                                    @include('deleteModal',['item' => $item])
                                    @endif
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    {{ $quantities->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
