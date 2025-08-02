@extends(auth()->user()->type == 'admin' ? 'front.layouts.front' : 'doctor.layouts.index')
@section('title')
{{ __('admin.Diagnoses') }}
@endsection
@section('content')

<section class="main-section py-4">
    <div class=" container">
        <h3 class="main-heading">{{__('admin.Modifying medical diagnoses')}}</h3>
        <div class="bg-white p-3 rounded-2 shadow">
            <form action="{{ route('front.diagnoses.update',$diagnose) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="small-heading d-block mb-2 fw-normal text-white p-2 alt2-bg-color">@lang('admin.clinical_examination')</label>
                        <textarea class="w-100 form-control" rows="2" name="clinical_examination" id="clinical_examination">{{ $diagnose->clinical_examination }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="small-heading d-block mb-2 fw-normal text-white p-2 alt2-bg-color">@lang('admin.current_examination')</label>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 g-3">
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for="">@lang('admin.temperature_rate')</label>
                                    <input type="text" name="temperature_rate" value="{{ $diagnose->temperature_rate }}" placeholder="@lang('admin.temperature_rate')" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for=""> {{__('admin.Age')}}</label>
                                    <input type="text" name="age" value="{{ $diagnose->age }}" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for=""> {{__('admin.the weight')}}</label>
                                    <input type="text" name="weight" value="{{ $diagnose->weight }}" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for=""> @lang('admin.breathing_rate')</label>
                                    <input type="text" name="breathing_rate" value="{{ $diagnose->breathing_rate }}" placeholder="@lang('admin.breathing_rate')" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="inp-holder">
                                    <label class="small-label" for=""> @lang('admin.heart_rate')</label>
                                    <input type="text" name="heart_rate" value="{{ $diagnose->heart_rate }}" class="form-control" placeholder="@lang('admin.heart_rate')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="mb-2 small-heading fw-normal text-white p-2 alt2-bg-color w-100">@lang('admin.current_symptoms')</label>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="current_symptoms" id="current_symptoms">{{ $diagnose->current_symptoms }}</textarea>
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
                                    <textarea class="form-control" name="pharmaceutical" id="pharmaceutical">{{ $diagnose->pharmaceutical }}</textarea>
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
                                    <textarea class="form-control" name="treatment_plan" id="treatment_plan">{{ $diagnose->treatment_plan }}</textarea>
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
                                    <textarea class="form-control" name="treatment" id="">{{ $diagnose->treatment }}</textarea>
                                    <label for="">{{ __('Diagnose') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="mb-2 small-heading fw-normal text-white p-2 alt2-bg-color w-100">
                                    {{__('admin.Upcoming dates and reviews')}}
                                </label>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="next_visit" id="">{{ $diagnose->next_visit }}</textarea>
                                    <label for="">{{__('admin.Upcoming dates and reviews')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn-main-sm" type="submit">{{__("admin.Modify the diagnosis")}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
