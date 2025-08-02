 @section('content')
     <section class="invoice-section py-5">
         <div class="container">
             <div class="invoice-content bg-white shadow rounded-3 p-3">
                 <p class="text-center">فاتورة ضريبية مبسطة</p>
                 <h1 class="invoice-name text-center rounded-3 fw-bold mb-0 pt-2">
                     {{ __('admin.Bill_Number') }}
                     <br>
                     #{{ $order->id }}
                 </h1>
                 <h4 class="  mb-2 fw-bold mb-3 text-center mt-2">
                     {{ setting()->site_name }}
                 </h4>
                 <div class="the_date d-flex align-items-center justify-content-evenly mb-3">
                     <div class="date-holder ">
                         <small>{{ $order->date }}</small>
                     </div>
                     <div class="date-holder ">
                         <small>{{ $order->created_at->format('H:i a') }}</small>
                     </div>
                 </div>
                 <div class="logo-holder m-auto text-center  rounded-3 mb-3">
                     <img class="the_image mx-auto  h-auto rounded-3" src="{{ display_file(setting()->logo) }}"
                         width="150" alt="logo">
                 </div>
                 <div class="me-2">
                     <div class="tax-number  mb-2 fw-bold">
                         <small>{{ __('admin.Tax_number') }} : <span class="">{{ setting()->tax_no }}</span></small>
                     </div>
                     <div class="the_address mb-4 fw-bold">
                         <div class="address-holder">
                             <small>{{ setting()->address }}</small>
                         </div>
                     </div>
                 </div>
                 <div class="">
                     <table class="table main-table text-center rounded-3 w-100">
                         <thead class="border-0">
                             <tr>

                                 <th class="">
                                     <div>الوصف</div>
                                     <div class="">Description</div>
                                 </th>

                                 <th class="">
                                     <div class="">السعر
                                     </div>
                                     <div class="">price</div>
                                 </th>

                                 <th>
                                     <div class="">الكمية</div>
                                     <div class="">Qty</div>
                                 </th>

                                 <th>
                                     <div class="">الضريبة</div>
                                     <div class="">Vat</div>
                                 </th>
                                 <th>
                                     <div class="">الإجمالي</div>
                                     <div class="">Total</div>
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($order->items as $item)
                                 <tr>
                                     <td>
                                         {{ $item->name }}
                                     </td>
                                     <td>
                                         {{ $item->sale_price }}
                                     </td>
                                     <td>
                                         {{ $item->quantity }}
                                     </td>
                                     <td>
                                         {{ $item->tax }}
                                     </td>
                                     <td>
                                         {{ $item->total * $item->quantity + $item->tax }}
                                     </td>
                                 </tr>
                             @endforeach

                         </tbody>
                     </table>
                 </div>
                 <div class="second-table mt-2">
                     <table class="table main-table" id="data-table">
                         <tbody>
                             <tr>
                                 <td colspan="2" class="text-end ">
                                     <div class="text-center spechial-text">المجموع قبل الخصم و الضريبه
                                     </div>
                                     <div class="text-center spechial-text">Total before deduction and tax</div>
                                 </td>
                                 <td colspan="2"> {{ $order->amount }}</td>
                             </tr>

                             <tr>
                                 <td colspan="2" class="text-end ">
                                     <div class="text-center spechial-text">ضريبة القيمة المضافة</div>
                                     <div class="text-center spechial-text">value added tax</div>
                                 </td>
                                 <td colspan="2"> {{ $order->tax }}</td>
                             </tr>
                             <tr>
                                 <td colspan="2" class="text-end ">
                                     <div class="text-center spechial-text"> الخصم Disc</div>
                                     <!-- <div class="text-center spechial-text"></div> -->
                                 </td>
                                 <td colspan="2"> {{ $order->discount }}</td>
                             </tr>
                             <tr>
                                 <td colspan="2" class="text-end ">
                                     <div class="text-center spechial-text"> كاش Cash</div>
                                     <!-- <div class="text-center spechial-text"></div> -->
                                 </td>
                                 <td colspan="2"> {{ $order->cash }}</td>
                             </tr>
                             <tr>
                                 <td colspan="2" class="text-end ">
                                     <div class="text-center spechial-text"> شبكة Card</div>
                                     <!-- <div class="text-center spechial-text"></div> -->
                                 </td>
                                 <td colspan="2"> {{ $order->card }}</td>
                             </tr>
                             <tr>
                                 <td colspan="2" class="text-end ">
                                     <div class="text-center spechial-text"> المتبقي Rest</div>
                                     <!-- <div class="text-center spechial-text"></div> -->
                                 </td>
                                 <td colspan="2"> {{ $order->rest }}</td>
                             </tr>
                             <tr class="">
                                 <td colspan="1" class="text-end ">
                                     <div class="text-center spechial-text"> الإجمالي Total</div>
                                     <!-- <div class="text-center spechial-text"></div> -->
                                 </td>
                                 <td colspan="3 " class="">{{ $order->total }}</td>
                             </tr>
                         </tbody>
                     </table>
                 </div>


                 <div class="bar_code_holder text-center">
                     {!! $qrCode ?? '' !!}
                 </div>

                 <div class="d-flex justify-content-center not-print mt-3">
                     <button class="btn btn-sm btn-info" onclick="print()">{{ __('site.Print') }}</button>
                 </div>


             </div>
         </div>

     </section>
 @endsection
