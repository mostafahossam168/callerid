<section class="py-3 px-1">
    <div class="invoice-content-fi bg-white p-3 rounded-3 shadow-sm">
        <div class="logo-holder m-auto text-center mb-3">
            <img class="the_image rounded-3" src="{{ display_file(setting()->logo) }}" alt="logo" width="150">
        </div>
        <div class="tax number text-center mb-2">
            {{ setting()->site_name }}
        </div>
        <p class=" text-center mb-1">
            {{__('admin.Simplified tax invoice')}} - {{ $invoice->id }}
        </p>
        @if(setting()->active_water_mark)
        <p class="text-mark">{{ setting()->water_mark_string }}</p>
        @endif
        <hr class="w-75 mx-auto mt-2 mb-3">
        <div class="holder-info text-center">
            <div class="the_date d-flex align-items-center justify-content-evenly mb-1">
                <div class="date-holder">
                    {{ now()->format('Y-m-d') }}
                </div>
                <div class="date-holder">
                    {{ now()->format('h:i A') }}
                </div>
            </div>
            <div class="mb-1">
                <b>{{__('admin.address')}}:</b> {{ setting()->address }}
            </div>
            <div class="mb-1">
                <b>{{__('admin.Mobile_number')}}:</b> {{ setting()->phone }}
            </div>
            <div class=" text-center mb-1">
                <b>الرقم الضرريبي: </b> {{ setting()->tax_no }}
            </div>
            <div> <b>اسم العميل:</b> {{ $invoice->patient?->name }}</div>
            <div>
                <b>{{__('admin.Pet name')}}:</b>
                @foreach ($invoice->animals as $animal)
                {{ $animal->name }} {{ ($loop->index + 1) < $invoice->animals->count() ? ' , ' : ''}}
                @endforeach
            </div>
            <div> <b>رقم الملف:</b> {{ $invoice->patient->id }}</div>
            <div class=" mb-3"> <b>الطبيب المعالج:</b> {{ $invoice->dr?->name }}</div>
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>
                            <div>النوع</div>
                            <div>Type</div>
                        </th>
                        <th>
                            <div>السعر</div>
                            <div>Price</div>
                        </th>
                        <th>
                            <div>عدد</div>
                            <div>Number</div>
                        </th>
                        <th>
                            <div>الخصم</div>
                            <div>Dis</div>
                        </th>
                        @if (setting()->tax_enabled)
                        <th>
                            <div>الضريبة</div>
                            <div>Tax</div>
                        </th>
                        @endif
                        <th>
                            <div>الاجمالي</div>
                            <div>Total</div>
                        </th>
                    </tr>
                </thead>
                <thead class="border-0">
                    <tr>
                        <th colspan="12" class="text-center fw-bold">
                            الخدمات العلاجية - Therapeutic services
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->products()->whereNull('item_id')->get() as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->discount }}</td>
                        @if (setting()->tax_enabled)
                        <td>{{ $item->tax }}</td>
                        @endif
                        <td>{{ $item->sub_total }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <thead class="border-0">
                    <tr>
                        <th colspan="12" class="text-center fw-bold">
                            منتجات - Products
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->products()->whereNull('product_id')->get() as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->discount }}</td>
                        @if (setting()->tax_enabled)
                        <td>{{ $item->tax }}</td>
                        @endif
                        <td>{{ $item->sub_total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table main-table table-fi-invoice">
                <tbody>
                    <tr>
                        <th>
                            الأجمالي:<br> Total:
                        </th>
                        <td>{{ $invoice->total }}</td>
                    </tr>
                    <tr>
                        <th>
                            الخصم:<br> Disc:
                        </th>
                        <td>{{ $invoice->discount + $invoice->offers_discount }}</td>
                    </tr>
                    <tr>
                        <th>
                            @if (setting()->tax_enabled)
                            الأجمالي قبل الخصم والضريبة:<br> Total before disc and tax:
                            @else
                            الأجمالي قبل الخصم :<br> Total before disc:
                            @endif
                        </th>
                        <td>{{ $invoice->amount - $invoice->discount }}</td>
                    </tr>
                    <tr>
                        @if (setting()->tax_enabled)
                        <th>
                            الضريبه :<br> tax:
                        </th>
                        @endif
                        @if (setting()->tax_enabled)
                            <td>{{ $invoice->tax }}</td>
                        @endif
                    </tr>
                    <tr>
                        <th>
                            @if (setting()->tax_enabled)
                            الأجمالي شامل الصريبة:<br> Total including tax:
                            @else
                            الأجمالي :<br> Total:
                            @endif
                        </th>
                        <td>{{ $invoice->total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h5 class="wel-text text-primary my-3">
            شــكــرا لـــــزيـــارتـــكــم
        </h5>
        <div class="d-flex align-items-center flex-column gap-3">
            <div class="d-flex parent-boxes-info  flex-column gap-2">
                <div class="box-info-border w-100">
                    <b>دفع نقدا</b>
                    {{ $invoice->cash }}
                </div>
                <div class="box-info-border">
                    <b>دفع شبكة</b>
                    {{ $invoice->card }}
                </div>
                <div class="box-info-border">
                    <b> {{__('admin.rest')}}</b>
                    {{ $invoice->rest }}
                </div>
                <div class="box-info-border">
                    <b> البائع</b>
                    {{ $invoice->employee?->name }}
                </div>
            </div>
            <div class="bar_code_holder text-center">
                {!! $qrCode !!}
            </div>
        </div>
    </div>
</section>
