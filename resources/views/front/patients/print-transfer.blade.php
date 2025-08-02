@extends('front.layouts.front')
@section('title')
{{ __("طباعة تحويلة المريض") }}
@endsection
@section('content')
<section class="main-section py-5">
    <div class="container">
        <!-- <div class="section-content bg-white  rounded-3 p-4">
            <div class="content" id="prt-contenst">
                <div class="d-flex align-items-start justify-content-start flex-column flex-md-row align-items-md-center gap-2 mb-3">
                    <div class="bg-black text-white rounded-3 px-3 py-2 mb-1 mb-md-0" id="staticBackdropLabel">
                        <span>
                            {{ __('Transfer of the patient')}}
                            {{$appointment->patient?->name }}
                            {{ __('to the doctor')}}
                        </span>
                    </div>
                    <div class="date text-white rounded-3 px-3 py-2 mb-1 mb-md-0 bg-black">
                        <small class="ms-2">
                            {{ __('Date')}} :
                            <span class="">{{date('Y-m-d')}}</span>
                        </small>
                        <small class="ms-2">
                            {{ __('Day')}} :
                            <span class="">{{Carbon::now()->translatedFormat("D")}}</span>
                        </small>
                        <small>
                            {{ __('Hour')}} :
                            <span class="">{{date('H:i')}}</span>
                        </small>
                    </div>
                    {{--<livewire:select-doctor-for-transfer /> --}}
                    <div class=" rounded-3 px-3 py-2 text-white bg-black">{{ __('Direct Doctor Transfer')}}</div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4 text-end">
                        <div class="d-flex flex-column">
                            <label class="small-label mb-2" for=""> {{ __('Clinic')}} </label>
                            <input readonly type="text" class="form-control" value="{{ $appointment->clinic?->name }}" id="">
                        </div>
                    </div>

                    <div class="col-md-4 text-end">
                        <div class="d-flex flex-column">
                            <label class="small-label mb-2" for=""> {{ __('the Doctor')}} </label>
                            <input readonly class="form-control" type="text" value="{{ $appointment->doctor?->name }}" id="">
                        </div>
                    </div>

                    <div class="col-md-4 text-end">
                        <div class="d-flex flex-column">
                            <label for="appointment_date" class="mb-2 small-label">{{__('Period')}}</label>
                            <input type="text" class="form-control" readonly value="{{ __($appointment->appointment_duration) }}" id="">
                        </div>
                    </div>

                    <div class="col-sm-3 text-end">
                        <label class="small-label" for=""> {{ __('waiting number')}} </label>
                        <input type="number" value="{{ request('waiting') }}" readonly class="form-control">
                    </div>
                </div>
                <button class="not-print btn btn-warning btn-sm px-3 mt-4" id="print-btn" onclick="print()">
                    {{ __('print')}}
                </button>
            </div>
        </div> -->
        <div class="fi-invoice text-center bg-white p-3 rounded-3 shadow-sm mt-5 mt-md-0" id="prt-content">
            <!-- <h4 class="mb-4"> {{ __('Transfer of the patient')}}
                {{$appointment->patient?->name }}
                {{ __('to the doctor')}}
            </h4> -->
            <div class="logo-holder m-auto mb-2">
                <img class="the_image rounded-3" src="{{display_file(setting()->logo)}}" alt="logo" width="80" />
            </div>
            <h5 class="title mb-2">{{ setting()->site_name }}</h5>
            <p class="mb-2">العنوان: {{ setting()->address }}</p>
            <p class="mb-2">رقم الجوال: {{ setting()->phone }}</p>
            <p class="mb-2">الرقم الضريبيى: {{ setting()->tax_no }}</p>
            <div class="holder mb-2 d-flex align-items-center justify-content-between gap-3">
                <span class="time">{{date('H:i')}}</span>
                <small class="">
                    {{ __('Day')}} :
                    <span class="">{{Carbon::now()->translatedFormat("D")}}</span>
                </small>
                <span class="date">{{date('Y-m-d')}}</span>
            </div>
            <h4 class="title-bg">تــفـاصــيـل</h4>
            <!-- <table class="table-des-1">
                <thead>
                    <tr>
                        <th>رقم الفاتورة</th>
                        <th>تاريخ التفصيل</th>
                        <th>تاريخ التسليم</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>13</td>
                        <td>2024-07-16</td>
                        <td></td>
                    </tr>
                </tbody>
            </table> -->
            <table class="table-des-1">
                <tbody>
                    <tr>
                        <th>اسم الاليف</th>
                        <td>{{$appointment->animal?->name}}</td>
                    </tr>
                    <tr>
                        <th>العيادة</th>
                        <td>{{ $appointment->clinic?->name }}</td>
                    </tr>

                    <tr>
                        <th>الطبيب</th>
                        <td>{{ $appointment->doctor?->name }}</td>
                    </tr>
                    <tr>
                        <th>الفترة</th>
                        <td>{{ __($appointment->appointment_duration) }}</td>
                    </tr>
                    <tr>
                        <th>رقم الانتظار</th>
                        <td>{{ request('waiting') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="bar_code_holder text-center d-flex justify-content-center mb-2">
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="125" height="125" viewBox="0 0 125 125">
                    <rect x="0" y="0" width="125" height="125" fill="#ffffff"></rect>
                    <g transform="scale(3.378)">
                        <g transform="translate(0,0)">
                            <path fill-rule="evenodd" d="M8 0L8 1L9 1L9 2L8 2L8 5L9 5L9 4L12 4L12 3L14 3L14 8L13 8L13 5L12 5L12 7L11 7L11 5L10 5L10 9L9 9L9 8L8 8L8 10L10 10L10 11L9 11L9 12L8 12L8 16L9 16L9 17L8 17L8 18L6 18L6 17L7 17L7 16L6 16L6 15L7 15L7 14L5 14L5 13L4 13L4 11L5 11L5 12L6 12L6 13L7 13L7 12L6 12L6 11L7 11L7 10L6 10L6 9L7 9L7 8L6 8L6 9L4 9L4 8L0 8L0 9L2 9L2 10L0 10L0 11L2 11L2 12L0 12L0 15L1 15L1 14L2 14L2 15L4 15L4 17L1 17L1 16L0 16L0 20L1 20L1 22L0 22L0 25L1 25L1 27L0 27L0 28L1 28L1 27L2 27L2 29L8 29L8 30L9 30L9 31L10 31L10 32L9 32L9 33L8 33L8 37L9 37L9 36L10 36L10 37L11 37L11 36L12 36L12 37L13 37L13 36L14 36L14 37L15 37L15 36L17 36L17 37L18 37L18 36L19 36L19 37L21 37L21 36L20 36L20 35L19 35L19 32L18 32L18 31L19 31L19 30L20 30L20 31L22 31L22 29L23 29L23 30L25 30L25 31L26 31L26 32L25 32L25 34L26 34L26 33L27 33L27 34L31 34L31 35L30 35L30 36L29 36L29 37L32 37L32 35L33 35L33 36L34 36L34 37L37 37L37 36L35 36L35 35L34 35L34 34L35 34L35 32L36 32L36 33L37 33L37 32L36 32L36 31L37 31L37 30L35 30L35 29L36 29L36 28L37 28L37 27L36 27L36 26L35 26L35 25L34 25L34 24L35 24L35 22L34 22L34 20L33 20L33 22L32 22L32 21L30 21L30 20L31 20L31 19L32 19L32 18L31 18L31 17L32 17L32 16L31 16L31 15L32 15L32 14L33 14L33 15L35 15L35 18L34 18L34 19L35 19L35 21L36 21L36 20L37 20L37 18L36 18L36 17L37 17L37 15L36 15L36 14L37 14L37 11L36 11L36 14L35 14L35 11L33 11L33 10L32 10L32 9L35 9L35 10L36 10L36 9L37 9L37 8L36 8L36 9L35 9L35 8L32 8L32 9L31 9L31 10L30 10L30 11L29 11L29 9L30 9L30 8L28 8L28 7L29 7L29 0L28 0L28 7L27 7L27 6L26 6L26 5L25 5L25 4L23 4L23 3L22 3L22 4L21 4L21 3L20 3L20 4L16 4L16 2L19 2L19 0L14 0L14 2L13 2L13 0L12 0L12 1L9 1L9 0ZM20 0L20 1L21 1L21 0ZM26 0L26 2L24 2L24 1L23 1L23 2L24 2L24 3L26 3L26 4L27 4L27 0ZM15 1L15 2L16 2L16 1ZM11 2L11 3L12 3L12 2ZM15 5L15 7L16 7L16 6L17 6L17 7L18 7L18 8L15 8L15 9L14 9L14 11L16 11L16 10L15 10L15 9L17 9L17 10L18 10L18 8L20 8L20 9L19 9L19 11L20 11L20 9L21 9L21 12L23 12L23 11L22 11L22 10L24 10L24 13L23 13L23 14L22 14L22 13L20 13L20 12L19 12L19 14L18 14L18 15L17 15L17 13L16 13L16 14L15 14L15 13L14 13L14 12L13 12L13 9L12 9L12 8L11 8L11 10L12 10L12 12L13 12L13 14L12 14L12 13L11 13L11 11L10 11L10 13L11 13L11 17L10 17L10 22L9 22L9 21L6 21L6 20L8 20L8 19L9 19L9 18L8 18L8 19L5 19L5 21L4 21L4 19L3 19L3 18L1 18L1 20L3 20L3 21L2 21L2 22L3 22L3 23L4 23L4 22L5 22L5 21L6 21L6 22L8 22L8 23L6 23L6 24L2 24L2 23L1 23L1 25L6 25L6 26L4 26L4 28L7 28L7 27L8 27L8 28L9 28L9 30L10 30L10 31L11 31L11 32L10 32L10 33L9 33L9 35L10 35L10 36L11 36L11 34L12 34L12 35L17 35L17 36L18 36L18 34L14 34L14 33L13 33L13 32L14 32L14 30L13 30L13 31L12 31L12 29L16 29L16 28L14 28L14 27L13 27L13 26L11 26L11 25L12 25L12 23L11 23L11 25L10 25L10 22L11 22L11 20L13 20L13 21L12 21L12 22L13 22L13 23L16 23L16 24L15 24L15 27L17 27L17 29L18 29L18 28L19 28L19 29L20 29L20 27L22 27L22 26L23 26L23 27L25 27L25 28L26 28L26 29L25 29L25 30L26 30L26 31L27 31L27 33L28 33L28 30L26 30L26 29L27 29L27 28L26 28L26 27L28 27L28 28L30 28L30 26L31 26L31 28L32 28L32 27L33 27L33 29L34 29L34 28L35 28L35 26L34 26L34 25L33 25L33 23L34 23L34 22L33 22L33 23L32 23L32 22L31 22L31 23L30 23L30 24L31 24L31 25L29 25L29 23L28 23L28 22L26 22L26 21L24 21L24 20L22 20L22 19L24 19L24 17L25 17L25 20L27 20L27 19L26 19L26 18L27 18L27 17L28 17L28 16L29 16L29 15L28 15L28 8L27 8L27 7L26 7L26 6L25 6L25 8L24 8L24 9L23 9L23 7L24 7L24 5L23 5L23 7L22 7L22 6L21 6L21 8L20 8L20 6L19 6L19 7L18 7L18 5ZM8 6L8 7L9 7L9 6ZM25 8L25 10L26 10L26 11L25 11L25 12L26 12L26 13L27 13L27 10L26 10L26 9L27 9L27 8ZM3 9L3 11L4 11L4 9ZM5 10L5 11L6 11L6 10ZM17 11L17 12L18 12L18 11ZM30 11L30 12L31 12L31 11ZM2 12L2 14L4 14L4 13L3 13L3 12ZM24 13L24 16L25 16L25 15L26 15L26 14L25 14L25 13ZM30 13L30 15L31 15L31 14L32 14L32 13ZM13 14L13 15L15 15L15 17L16 17L16 16L17 16L17 17L18 17L18 18L17 18L17 20L16 20L16 18L14 18L14 19L15 19L15 20L14 20L14 22L15 22L15 21L16 21L16 23L19 23L19 25L20 25L20 23L19 23L19 22L20 22L20 21L22 21L22 22L21 22L21 23L22 23L22 24L21 24L21 25L23 25L23 26L25 26L25 27L26 27L26 26L29 26L29 25L27 25L27 24L26 24L26 23L25 23L25 22L23 22L23 21L22 21L22 20L21 20L21 19L22 19L22 18L23 18L23 16L22 16L22 15L20 15L20 14L19 14L19 15L18 15L18 16L17 16L17 15L15 15L15 14ZM9 15L9 16L10 16L10 15ZM19 15L19 16L20 16L20 15ZM5 16L5 17L4 17L4 18L5 18L5 17L6 17L6 16ZM21 16L21 17L22 17L22 16ZM30 16L30 17L31 17L31 16ZM12 17L12 19L13 19L13 17ZM18 18L18 20L17 20L17 22L18 22L18 20L20 20L20 19L21 19L21 18ZM29 18L29 19L28 19L28 20L29 20L29 19L30 19L30 18ZM3 21L3 22L4 22L4 21ZM22 22L22 23L23 23L23 24L24 24L24 23L23 23L23 22ZM8 23L8 24L9 24L9 23ZM36 23L36 25L37 25L37 23ZM6 24L6 25L7 25L7 26L6 26L6 27L7 27L7 26L8 26L8 25L7 25L7 24ZM13 24L13 25L14 25L14 24ZM25 24L25 25L26 25L26 24ZM16 25L16 26L18 26L18 27L20 27L20 26L18 26L18 25ZM31 25L31 26L33 26L33 27L34 27L34 26L33 26L33 25ZM10 26L10 28L11 28L11 29L12 29L12 28L11 28L11 26ZM23 28L23 29L24 29L24 28ZM29 29L29 32L32 32L32 29ZM30 30L30 31L31 31L31 30ZM15 31L15 33L16 33L16 32L17 32L17 33L18 33L18 32L17 32L17 31ZM23 31L23 33L20 33L20 34L23 34L23 35L24 35L24 36L26 36L26 37L27 37L27 36L28 36L28 35L24 35L24 34L23 34L23 33L24 33L24 31ZM34 31L34 32L35 32L35 31ZM22 36L22 37L23 37L23 36ZM0 0L7 0L7 7L0 7ZM1 1L1 6L6 6L6 1ZM2 2L5 2L5 5L2 5ZM30 0L37 0L37 7L30 7ZM31 1L31 6L36 6L36 1ZM32 2L35 2L35 5L32 5ZM0 30L7 30L7 37L0 37ZM1 31L1 36L6 36L6 31ZM2 32L5 32L5 35L2 35Z" fill="#000000"></path>
                        </g>
                    </g>
                </svg>
            </div>
        </div>

        <div class="my-3 text-center not-print">
            <button id="btn-prt-content" class="btn btn-warning btn-sm px-4 text-white not-print">
                <i class="fa-solid fa-print"></i>
                طباعة
            </button>
        </div>
    </div>
</section>
@push('js')

@endpush
@endsection
