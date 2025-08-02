<section class="main-section home">

    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.Add invoice') }}</h4>
        <div class="addNvoice-content bg-white p-4 shadow">
            <div class="tip">
                <p class="tip-text text-danger"> {{ __('admin.There is a ratio') }} {{ setting()->tax_rate }}%
                    {{ __('admin.tax on the invoice') }} </p>

                <div
                    class="main-container mb-4 d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-center">
                    <div class="right-side w-md-75 ms-3 mb-4 mb-md-0">
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-2 w-100">
                                <label for=""
                                    class="small-label">{{ __('admin.Patient file number or ID number') }}</label>
                                <input type="text" wire:model="patient_key" class="form-control w-100"
                                    wire:keyup='get_patient' />
                            </div>
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.patient') }}</label>
                                <input type="text" value="{{ $patient?->name }}" readonly id=""
                                    class="form-control w-100" />
                            </div>
                            @can('check_phone_patients')
                                <div class="inp-container ms-2 w-100">
                                    <label for="" class="small-label">{{ __('admin.phone') }}</label>
                                    <input type="tel" value="{{ $patient?->phone }}" readonly id=""
                                        class="form-control w-100" />
                                </div>
                            @endcan

                            @if ($patient)
                                @if ($patient->animals->count() > 0)

                                    <div class="inp-container ms-0 ms-md-2 w-100">
                                        <label for="" class="small-label">@lang('admin.Choose the pet')</label>
                                        <select wire:model="animals" multiple disabled
                                            class=" js-example-basic-multiple main-select w-100">
                                            @foreach ($patient->animals as $ani)
                                                <option value="{{ $ani->id }}"
                                                    {{ $ani->id == $animal_id ? 'selected' : '' }}>
                                                    {{ $ani->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <p class="tip-text text-danger">{{ __('admin.Please add an animal') }}</p>
                                @endif
                            @endif

                        </div>
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Status') }}</label>
                                <select wire:model="status" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.Status') }}</option>
                                    <option value="Paid">{{ __('admin.Paid') }}</option>
                                    <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                                    <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                                    {{-- <option value="cash">{{ __('admin.cash') }}</option> --}}
                                    {{-- <option value="card">{{ __('admin.card') }}</option> --}}
                                    {{-- <option value="bank_transfer">{{ __('admin.bank_transfer') }}</option> --}}
                                    <option value="retrieved">{{ __('admin.retrieved') }}</option>
                                </select>
                            </div>
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Clinic') }}</label>
                                <select wire:model="department_id" id="" class="main-select w-100">
                                    <option value="">
                                        {{ __('admin.Choose Clinic') }}
                                    </option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.dr') }}</label>
                                <select wire:model="dr_id" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.dr') }}</option>
                                    @foreach ($doctors as $dr)
                                        <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if ($this->department?->is_hotel_service)
                                <div class="inp-container ms-0 ms-md-2 w-50">
                                    <label for="" class="small-label">تاريخ الدخول</label>
                                    <input type="date" wire:model="entry_date" id=""
                                        class="form-control w-100" />
                                </div>
                                <div class="inp-container ms-0 ms-md-2 w-50">
                                    <label for="" class="small-label">تاريخ المغادرة</label>
                                    <input type="date" wire:model="departure_date" id=""
                                        class="form-control w-100" />
                                </div>
                            @endif

                            {{-- <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Period') }}</label>
                                <select name="" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.Period') }}</option>
                                    <option value="">{{ __('admin.morning') }}</option>
                                    <option value="">{{ __('admin.evening') }}</option>
                                </select>
                            </div> --}}
                        </div>
                        <p>{{ __('You can choose services or search by number') }}</p>
                        <div class="info-box d-flex flex-column flex-md-row">

                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="">{{ __('admin.Service name') }}</label>
                                <input type="text" class="form-control" wire:model="product_name"
                                    wire:keyup="getProduct($event.target.value)">
                            </div>

                            {{-- <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.product') }}</label>
                                <select wire:model="product_id" id="" class="main-select w-100"
                                    wire:change='add_product'>
                                    <option value="">{{ __('admin.product') }}</option>
                                    @foreach ($all_products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.product') }}</label>
                                <input type="number" wire:model='product_id' class="form-control"
                                    wire:keyup='add_product'>
                            </div> --}}
                            <div class="inp-container ms-2 w-100">
                                <a target="_blank" href="{{ route('front.products.index') }}"
                                    class="btn btn-sm btn-primary">{{ __('admin.services') }}</a>
                            </div>
                        </div>

                        @if ($all_products && count($all_products) > 0)
                            <div class="inp-container w-100 mt-3">
                                <table class="table table-bordered">
                                    @foreach ($all_products as $key => $pro)
                                        <tr>
                                            <td>{{ $pro['name'] }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-success"
                                                    wire:click="chooseProduct({{ $pro['id'] }})"><i
                                                        class="fa fa-check"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif

                        <p class="sm-heading fs-13px my-2">{{ __('admin.You can choose the products') }}</p>
                        <div
                            class="info-box d-flex align-items-end justify-content-center gap-3 flex-column flex-md-row">
                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.item_categories') }}</label>
                                <select wire:model.live="category_id" id="" class="main-select w-100">
                                    <option value="">
                                        {{ __('admin.Choose') }}
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.The product') }}</label>
                                <select wire:model="item_id" id="" class="main-select w-100"
                                    wire:change='add_item'>
                                    <option value="">{{ __('admin.The product') }}</option>
                                    @foreach ($all_items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="inp-container ms-0 ms-md-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Barcode search') }}</label>
                                <input type="number" wire:model='item_id' class="form-control"
                                    wire:keyup='add_item'>
                            </div>

                            <div class="inp-container w-100 ">
                                <a target="_blank" href="{{ route('front.items') }}"
                                    class="btn btn-sm btn-primary px-4">{{ __('admin.Products') }}</a>
                            </div>

                            <!-- <div class="inp-container d-flex align-items-center mb-2 w-100">
                        <label for="split" class="small-label ms-2 form-check-label text-danger">{{ __('admin.split bill') }}</label>
                        <input type="checkbox" wire:model="split" id="split" class="form-check-input mt-0">
                    </div> -->

                        </div>
                        <div class="d-flex gap-2 flex-wrap align-items-center">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" wire:model="is_has_vaccines"
                                    id="flexCheckDefault">
                                <label class="form-check-label fw-bold" for="flexCheckDefault">
                                    تطعيمات
                                </label>
                            </div>
                            @if ($is_has_vaccines)
                                <div class="inp-container ms-0 ms-md-2 w-20">
                                    <label class="small-label">سلالة الأليف</label>
                                    <select wire:model="vaccine_category_id" id=""
                                        class="main-select w-100">
                                        <option value="">اختر سلالة الأليف</option>
                                        @foreach (\App\Models\Category::get() as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="inp-container ms-0 ms-md-2 w-20">
                                    <label class="small-label">التطعيم</label>
                                    <select wire:model="vaccine_id" class="main-select w-100">
                                        <option value="">
                                            اختر التطعيم
                                        </option>
                                        @foreach (\App\Models\Vaccine::where('category_id', $vaccine_category_id)->get() as $vacc)
                                            <option value="{{ $vacc->id }}">{{ $vacc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="inp-container ms-0 ms-md-2 w-20">
                                    <label class="small-label">اختر الحيوان</label>
                                    <select wire:model="vaccine_animal_id" class="main-select w-100">
                                        <option value="">
                                            اختر الحيوان
                                        </option>
                                        @foreach (\App\Models\Animal::whereIn('id', $animals)->get() as $animal)
                                            <option value="{{ $animal->id }}">{{ $animal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="inp-container ms-0 ms-md-2 w-20 align-items-center">
                                    <label class="small-label">موعد التطعيم القادم</label>
                                    <input class="form-control" wire:model="next_vaccine_date" type="date">
                                </div>
                                @if ($vaccine_id && $vaccine_category_id && $vaccine_animal_id)
                                    <div class="w-20 mt-auto">
                                        <button wire:click="add_vaccine" class="btn btn-sm btn-purple">اضافة التطعيم
                                        </button>
                                    </div>
                                @endif
                            @endif
                        </div>

                    </div>
                    <div class="left-side w-md-25">
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.amount') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="amount" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Percentage discount') }} :</span>
                            <input {{ $discount_amount ? 'readonly' : '' }} type="text" placeholder="0"
                                class="text-center form-control w-50" wire:model="discount_rate"
                                wire:keyup="calculateNet" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Discount amount') }} :</span>
                            <input {{ $discount_rate ? 'readonly' : '' }} type="text" placeholder="0"
                                class="text-center form-control w-50" wire:model="discount_amount"
                                wire:keyup="calculateNet" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Discount_Offers') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="offers_discount" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Amount after discount of offers') }} :</span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="amount_after_offers_discount" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Total with tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="total" />
                        </div>


                        {{-- @can('خصم الفاتورة')
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.discount') }}:</span>
                            <input type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="discount" wire:keyup="calculateNet" />
                        </div>
                        @endcan --}}
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.cash') }}</span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="cash" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.bank') }} :</span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="bank" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.card') }} : </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model="card" />
                        </div>
                        @if (setting()->payment_gateways)
                            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                <span class="a_word ms-2"> {{ __('admin.visa') }} :</span>
                                <input type="text" placeholder="0" class="text-center form-control w-50"
                                    wire:model="visa" />
                            </div>
                            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                <span class="a_word ms-2"> {{ __('admin.mastercard') }} :</span>
                                <input type="text" placeholder="0" class="text-center form-control w-50"
                                    wire:model="mastercard" />
                            </div>
                        @endif
                        @if (setting()->tamara)
                            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                <span class="a_word ms-2"> {{ __('admin.tamara') }} :</span>
                                <input type="text" placeholder="0" class="text-center form-control w-50"
                                    wire:model="tamara" />
                            </div>
                        @endif
                        @if (setting()->tabby)
                            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                <span class="a_word ms-2"> {{ __('admin.tabby') }} :</span>
                                <input type="text" placeholder="0" class="text-center form-control w-50"
                                    wire:model="tabby" />
                            </div>
                        @endif


                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Paid tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="paid_tax" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Paid without tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="paid_without_tax" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.rest') }} : </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="rest" />
                        </div>
                    </div>
                </div>
                @if (count($items) > 0)
                    <h5 class="text-center">{{ __('admin.services') }}</h5>
                    <div class="table-responsive ">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>{{ __('admin.department') }}</th>
                                    <th>{{ __('admin.product') }}</th>
                                    <th>{{ __('admin.quantity') }}</th>
                                    <th>{{ __('admin.Tax type') }}</th>
                                    <th>{{ __('admin.price') }}</th>
                                    <th>{{ __('admin.Tax rate') }}</th>
                                    <th>{{ __('admin.Total') }}</th>
                                    <th>{{ __('admin.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td>{{ __($item['department']) }}</td>
                                        <td>{{ $item['product_name'] }}</td>
                                        <td><input type="text" class="form-control w-150px text-center mx-auto"
                                                wire:keyup="computeForAll"
                                                wire:model="items.{{ $key }}.quantity"></td>
                                        <td>{{ isset($item['tax_type_ar']) ? $item['tax_type_ar'] : '-' }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td>{{ $item['tax'] }}</td>
                                        @can('discount_invoices')
                                            <td>
                                                <input type="number" wire:model="items.{{ $key }}.sub_total"
                                                    id="" wire:keyup='changeItemTotal({{ $key }})'
                                                    class="form-control w-150px text-center mx-auto" readonly disabled>
                                            </td>
                                        @else
                                            <td>{{ $item['price'] }}</td>
                                        @endcan
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="delete_item({{ $key }})">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif

                @if (count($products) > 0)
                    <h5 class="text-center">{{ __('admin.Products') }}</h5>
                    <div class="table-responsive ">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>{{ __('admin.department') }}</th>
                                    <th>{{ __('admin.product') }}</th>
                                    <th>{{ __('admin.quantity') }}</th>
                                    <th>{{ __('admin.Tax type') }}</th>
                                    <th>{{ __('admin.price') }}</th>
                                    <th>{{ __('admin.Tax rate') }}</th>
                                    <th>{{ __('admin.Total') }}</th>
                                    <th>{{ __('admin.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{ __($item['department']) }}</td>
                                        <td>{{ $item['product_name'] }}</td>
                                        <td><input type="text" class="form-control w-150px text-center mx-auto"
                                                wire:keyup="computeForAll"
                                                wire:model="products.{{ $key }}.quantity">
                                        </td>
                                        <td>{{ isset($item['tax_type_ar']) ? $item['tax_type_ar'] : '-' }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td>{{ $item['tax'] }}</td>
                                        @can('discount_invoices')
                                            <td>
                                                <input type="number"
                                                    wire:model="products.{{ $key }}.sub_total" id=""
                                                    wire:keyup='changeItemTotal({{ $key }})'
                                                    class="form-control w-150px text-center mx-auto" readonly disabled>
                                            @else
                                            <td>{{ $item['price'] }}</td>
                                            </td>
                                        @endcan
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="delete_product({{ $key }})">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif
                @if (count($vaccines) > 0)

                    <h5 class="text-center">{{ __('admin.Vaccinations') }}</h5>
                    <div class="table-responsive ">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th> السلاله</th>
                                    <th>{{ __('admin.product') }}</th>
                                    <th>{{ __('admin.quantity') }}</th>
                                    {{-- <th>نوع الضريبة</th> --}}
                                    <th>{{ __('admin.price') }}</th>
                                    <th>{{ __('admin.Tax rate') }}</th>
                                    <th>{{ __('admin.Total') }}</th>
                                    <th>تاريخ التطعيم القادم</th>
                                    <th>اسم الحيوان</th>
                                    <th>{{ __('admin.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vaccines as $key => $item)
                                    <tr>
                                        <td>{{ __($item['department']) }}</td>
                                        <td>{{ $item['product_name'] }}</td>
                                        <td><input type="text" class="form-control w-150px text-center mx-auto"
                                                wire:keyup="changeQtyAndComputeVaccines({{ $key }})"
                                                wire:model="vaccines.{{ $key }}.quantity"></td>
                                        {{-- <td>{{ $item['tax_type_ar'] }}</td> --}}
                                        <td>{{ $item['price'] }}</td>
                                        <td>{{ $item['tax'] }}</td>
                                        @can('discount_invoices')
                                            <td>
                                                <input type="number"
                                                    wire:model="vaccines.{{ $key }}.sub_total" id=""
                                                    wire:keyup='changeVaccineTotal({{ $key }})'
                                                    class="form-control w-150px text-center mx-auto" readonly disabled>
                                            @else
                                            <td>{{ $item['sub_total'] }}</td>
                                        @endcan
                                        <td>{{ $item['next_vaccine_date'] }}</td>
                                        <td>{{ \App\Models\Animal::find($item['animal_id'])?->name }}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="delete_vaccine({{ $key }})">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="Thetext-area w-100">
                    <textarea wire:model.defer="notes" id="" class="form-control w-100 p-2"
                        placeholder="{{ __('admin.notes') }}"></textarea>
                </div>
                <div class="submitBtn-holder text-center mt-3">
                    <button wire:click='submit' class="btn btn-success">
                        {{ __('admin.Save') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>
