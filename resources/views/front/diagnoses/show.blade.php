@extends(auth()->user()->type == 'admin' ? 'front.layouts.front' : 'doctor.layouts.index')
@section('title')
    {{ __('admin.Diagnoses') }}
@endsection
@section('content')

    <section class="main-section py-4">
        <div class=" container">
            <h3 class="main-heading">{{__('admin.View medical diagnoses')}} للمريض ( {{ $diagnose->patient?->name }}
                )
                الحيوان : ({{$diagnose->animal?->name}})
            </h3>

            <div>
              <p>  السلالة : ({{$diagnose->animal?->strain?->name ?? 'لايوجد'}}) </p>
              <p>  العمر : ({{$diagnose->animal?->age ?? 'لايوجد'}}) </p>
            </div>

            <div class="bg-white p-3 rounded-2 shadow">
                <div class="row g-3">
                    <div class="col-12 col-md-12 col-lg-6">
                        <label
                            class="small-heading d-block mb-2 fw-normal text-white p-2 alt2-bg-color">@lang('admin.clinical_examination')</label>
                        <textarea readonly class="w-100 form-control" style="min-height: fit-content;"
                                  id="clinical_examination">{{ $diagnose->clinical_examination }}</textarea>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6">
                        <label
                            class="small-heading d-block mb-2 fw-normal text-white p-2 alt2-bg-color">@lang('admin.current_examination')</label>
                        <div class="row row-cols-1 row-cols-sm-3 row-cols-md-5 g-1">
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for="">@lang('admin.temperature_rate')</label>
                                    <input readonly type="text" value="{{ $diagnose->temperature_rate }}"
                                           placeholder="@lang('admin.temperature_rate')" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for=""> {{__('admin.Age')}}</label>
                                    <input readonly type="text" value="{{ $diagnose->age }}" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for=""> {{__('admin.the weight')}}</label>
                                    <input readonly type="text" value="{{ $diagnose->weight }}" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for=""> @lang('admin.breathing_rate')</label>
                                    <input readonly type="text" value="{{ $diagnose->breathing_rate }}"
                                           placeholder="@lang('admin.breathing_rate')" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for=""> @lang('admin.heart_rate')</label>
                                    <input readonly type="text" value="{{ $diagnose->heart_rate }}" class="form-control"
                                           placeholder="@lang('admin.heart_rate')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label
                                    class="mb-2 small-heading fw-normal text-white p-2 alt2-bg-color w-100">@lang('admin.current_symptoms')</label>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <textarea readonly class="form-control" style="min-height: fit-content;"
                                              id="current_symptoms">{{ $diagnose->current_symptoms }}</textarea>
                                    <label for="current_symptoms">@lang('admin.current_symptoms')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="mb-2 small-heading fw-normal text-white p-2 alt2-bg-color w-100">
                                    @lang('admin.pharmaceutical')
                                </label>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <textarea readonly class="form-control" style="min-height: fit-content;"
                                              id="pharmaceutical">{{ $diagnose->pharmaceutical }}</textarea>
                                    <label for="pharmaceutical">@lang('admin.pharmaceutical')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="mb-2 small-heading fw-normal text-white p-2 alt2-bg-color w-100">
                                    @lang('admin.treatment_plan')
                                </label>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <textarea readonly class="form-control" style="min-height: fit-content;"
                                              id="treatment_plan">{{ $diagnose->treatment_plan }}</textarea>
                                    <label for="treatment_plan">@lang('admin.treatment_plan')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="mb-2 small-heading fw-normal text-white p-2 alt2-bg-color w-100">
                                    {{ __('Diagnose') }}
                                </label>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <textarea readonly class="form-control" style="min-height: fit-content;"
                                              id="">{{ $diagnose->treatment }}</textarea>
                                    <label for="">{{ __('Diagnose') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="mb-2 small-heading fw-normal text-white p-2 alt2-bg-color w-100">
                                    {{__('admin.Upcoming dates and reviews')}}
                                </label>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <textarea readonly class="form-control" style="min-height: fit-content;"
                                              id="">{{ $diagnose->next_visit }}</textarea>
                                    <label for="">{{__('admin.Upcoming dates and reviews')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="mb-2 small-heading fw-normal text-white p-2 alt2-bg-color w-100">
                                    {{__('admin.Attach files related to diagnosis, for example (radiography - laboratory - medical report)')}}
                                </label>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="btn-holder">
                                    @foreach($diagnose->attachments as $file)
                                        <a target="_blank" href="{{ display_file($file->file) }}"
                                           class="btn btn-sm btn-success px-3 mt-2"> <i class="fa-solid fa-eye"></i> عرض
                                            المرفق </a>
                                    @endforeach
                                    {{-- <a href="{{ display_file($diagnose->file_path) }}" target="_blank" class="btn btn-sm btn-primary"
                                    style="margin-bottom: 2px;"><i class="fa-solid fa-file"></i>
                                    معاينة المرفق</a> --}}
                                    {{-- @if($diagnose->file) --}}
                                    {{-- <a target="_blank" href="{{ display_file($diagnose->file_path) }}">المرفق</a> --}}
                                    {{-- @endif --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @if(setting()->pharmacy_status)
                <div class="table-responsive mt-3">
                    <table class="table main-table">
                        <thead>
                        <tr>
                            <th>رقم الوصفة</th>
                            <th>المالك</th>
                            <th>الطبيب</th>
                            <th>(صرف بواسطة)الصيدلي</th>
                            <th>التاريخ</th>
                            <th>الصرف</th>
                            <th class="text-center not-print">الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($diagnose->appoint?->pharmacyPrescriptions ?? [] as $prescription)
                            <tr>
                                <td>{{$prescription->id}}</td>
                                <td>{{$diagnose->patient?->name}}</td>
                                <td>{{$diagnose->dr?->name}}</td>
                                <td>{{$prescription->pharmacist?->name}}</td>
                                <td>{{$prescription->created_at->format('Y-m-d')}}</td>
                                <td>
                                    @if($prescription->is_dispensed_by_pharmacist)
                                        <span class="badge bg-success fs-14"> تم الصرف</span>
                                    @else
                                        <span class="badge bg-danger fs-14">بالانتظار</span>
                                    @endif
                                </td>
                                <td class="not-print">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{route('front.describe-show',$prescription->id)}}" class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </section>

@endsection
