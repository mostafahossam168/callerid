<section class="">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.Add invoice') }}</h4>
        <div class="addNvoice-content bg-white p-4 shadow">
            <div class="tip">
                <p class="tip-text text-danger"> {{ __('admin.There is a ratio') }} {{ setting()->tax_rate }}%
                    {{ __('admin.tax on the invoice') }} </p>
                <div
                    class="main-container mb-4 d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-center">
                    <div class="right-side w-75 ms-3 mb-4 mb-md-0">
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-2 w-100">
                                <label for=""
                                    class="small-label">{{ __('admin.Patient file number or ID number') }}</label>
                                <input type="text" wire:model="patient_key" class="form-control w-100"
                                    wire:keyup='get_patient' />
                            </div>
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.patient') }}</label>
                                <input type="text" value="{{ $patient->name }}" readonly id=""
                                    class="form-control w-100" />
                            </div>
                            @can('check_phone_patients')
                                <div class="inp-container ms-2 w-100">
                                    <label for="" class="small-label">{{ __('admin.phone') }}</label>
                                    <input type="tel" value="{{ $patient->phone }}" readonly id=""
                                        class="form-control w-100" />
                                </div>
                            @endcan
                        </div>
                        <div class="info-box d-flex flex-column flex-md-row mb-3">
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.Status') }}</label>
                                <select wire:model="status" id="" class="main-select w-100">
                                    <option value="">{{ __('admin.Status') }}</option>
                                    <option value="Paid">{{ __('admin.Paid') }}</option>
                                    <option value="Unpaid">{{ __('admin.Unpaid') }}</option>
                                    <option value="Partially Paid">{{ __('Partially Paid') }}</option>
                                    <option value="cash">{{ __('admin.cash') }}</option>
                                    <option value="card">{{ __('admin.card') }}</option>
                                    <option value="bank_transfer">{{ __('admin.bank_transfer') }}</option>
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
                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.product') }}</label>
                                <select wire:model="product_id" id="" class="main-select w-100"
                                    wire:change='add_product'>
                                    <option value="">{{ __('admin.product') }}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="inp-container ms-2 w-100">
                                <label for="" class="small-label">{{ __('admin.product') }}</label>
                                <input type="number" wire:model='product_id' class="form-control"
                                    wire:keyup='add_product'>
                            </div>
                            {{-- <div class="inp-container ms-2 w-100">
                                <a target="_blank" href="{{ route('front.products.index') }}"
                                    class="btn btn-sm btn-primary">{{ __('admin.Products') }}</a>
                            </div> --}}
                        </div>


                    </div>
                    <div class="left-side w-25">
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.amount') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="amount" />
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
                            <span class="a_word ms-2"> {{ __('admin.tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="tax" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.Total with tax') }}: </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="total" />
                        </div>


                        {{-- @can('خصم الفاتورة')
            <div class="output-box d-flex align-items-center justify-content-end mb-2">
              <span class="a_word ms-2"> {{ __('admin.discount') }}:</span>
              <input  type="text" placeholder="0" class="text-center form-control w-50" wire:model="discount" wire:keyup="calculateNet"/>
            </div>
            @endcan --}}
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.cash') }}</span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model.lazy="cash" />
                        </div>

                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.card') }} : </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model.lazy="card" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2">{{ __('admin.bank_transfer') }} : </span>
                            <input type="number" placeholder="0" class="text-center form-control w-50"
                                wire:model.lazy="bank" />
                        </div>
                        @if (setting()->payment_gateways)
                            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                <span class="a_word ms-2">فيزا </span>
                                <input type="number" placeholder="0" class="text-center form-control w-50"
                                    wire:model.lazy="visa" />
                            </div>
                            <div class="output-box d-flex align-items-center justify-content-end mb-2">
                                <span class="a_word ms-2">ماستركارد </span>
                                <input type="number" placeholder="0" class="text-center form-control w-50"
                                    wire:model.lazy="mastercard" />
                            </div>
                        @endif
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <span class="a_word ms-2"> {{ __('admin.rest') }} : </span>
                            <input readonly type="text" placeholder="0" class="text-center form-control w-50"
                                wire:model="rest" />
                        </div>
                        <div class="output-box d-flex align-items-center justify-content-end mb-2">
                            <button class="btn btn-dark btn-sm w-50" wire:click='manualCalculate'>
                                {{ __('admin.Update numbers') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.department') }}</th>
                                <th>{{ __('admin.product') }}</th>
                                <th>{{ __('admin.quantity') }}</th>
                                <th>{{ __('admin.price') }}</th>
                                <th>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                                <tr>
                                    <td>{{ __($item['department']) }}</td>
                                    <td>{{ $item['product_name'] }}</td>
                                    <td><input type="text" class="form-control" wire:keyup="computeForAll"
                                            wire:model="items.{{ $key }}.quantity"></td>
                                    @can('discount_invoices')
                                        <td><input type="number" wire:model="items.{{ $key }}.price"
                                                id="" wire:keyup='changeItemTotal({{ $key }})'></td>
                                        <td>
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
