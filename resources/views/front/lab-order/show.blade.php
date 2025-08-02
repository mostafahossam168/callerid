@extends('front.layouts.front')
@section('title')
{{ __('admin.appointments') }}
@endsection
@section('content')

<section class="main-section users">
    <div class="container">
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __('Lap Requests')}}</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="table-responsive mt-4">
                <div class="table-responsive ">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>العيادة</th>
                                <th>منتج</th>
                                <th>@lang('Current quantity')</th>

                                <th>السعر</th>
                                <th>قيمة الضريبة</th>
                                <th>الإجمالي</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>مختبر</td>
                                <td>تحليل دم</td>
                                <td><input type="text" class="form-control w-150px text-center mx-auto" disabled ></td>

                                <td>2000</td>
                                <td>300</td>
                                <td>2300</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button class="btn btn-sm btn-danger" wire:click="delete_item(1)">
                                            <svg class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"></path>
                                            </svg><!-- <i class="fa-solid fa-trash-can"></i> Font Awesome fontawesome.com -->
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
