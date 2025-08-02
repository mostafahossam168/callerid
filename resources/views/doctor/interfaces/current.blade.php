<section class="pt-1 pb-2">
    <div class="form-group mb-3 {{ setting()->complaint ? '' : 'd-none' }}">
        <label for="exampleFormControlTextarea1" class="mb-2">الشكوى</label>
        <textarea class="form-control" rows="3" wire:model.defer="diagnosis.complaint"></textarea>
    </div>
    <div class="form-group mb-3 {{ setting()->complaint ? '' : 'd-none' }}">
        <label for="exampleFormControlTextarea1" class="mb-2">@lang('admin.clinical_examination')</label>
        <textarea class="form-control" rows="3" wire:model.defer="diagnosis.clinical_examination"></textarea>
    </div>


    <div class="row g-3">
        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <label
                        class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">@lang('admin.pet_info')</label>
                </div>
                <div class="col-12">
                    <section class="table-responsive">
                        <table class="table main-table">
                            <tr>
                                <thead>
                                <th>{{__('admin.name')}}</th>
                                <th>{{__('admin.Pet Gender')}}</th>
                                <th>{{__('admin.Pet Age')}}</th>
                                </thead>
                                <tbody>
                                {{-- @dump($appointment)  --}}
                                <td>{{ $selected_appointment?->animal?->name }}</td>
                                <td>{{ $selected_appointment?->animal?->gender }}</td>
                                <td>{{ $selected_appointment?->animal?->age }}</td>
                                </tbody>
                            </tr>
                            <tr>
                                <thead>
                                <th colspan="2">نوع الأليف</th>
                                <th colspan="3">نوع السلالة</th>
                                </thead>
                                <tbody>
                                <td colspan="2"><input type="text" class="form-control" wire:model.defer='animal_type'>
                                </td>
                                <td colspan="3">
                                    {{ $selected_appointment?->animal?->strain?->name ?? 'لايوجد'}}
                                </td>
                                </tbody>
                            </tr>
                        </table>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <label
                        class="small-heading d-block mb-3 fw-normal text-white p-2 alt2-bg-color"> @lang('admin.current_examination')</label>
                </div>
                <div class="col-12">
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <div class="inp-holder">
                                <label class="small-label" for="">@lang('admin.temperature_rate')</label>
                                <input type="text" wire:model.defer="temperature_rate"
                                       placeholder="@lang('admin.normal')" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="inp-holder">
                                <label class="small-label" for=""> {{__('admin.the weight')}}</label>
                                <input type="text" wire:model.defer="weight" class="form-control"
                                       placeholder="@lang('admin.normal')">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="inp-holder">
                                <label class="small-label" for=""> @lang('admin.breathing_rate')</label>
                                <input type="text" wire:model.defer="breathing_rate" placeholder="@lang('admin.normal')"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="inp-holder">
                                <label class="small-label" for=""> @lang('admin.heart_rate')</label>
                                <input type="text" wire:model.defer="heart_rate" class="form-control"
                                       placeholder="@lang('admin.normal')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row g-1">
                <div class="col-md-12">
                    <label
                        class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">@lang('admin.current_symptoms')</label>
                </div>
                <div class="col-12 col-md-12">
                    <!-- <label for="" class="small-label mb-2 fw-bold">@lang('admin.The current display that appears promptly?')</label> -->
                    <div class="form-floating">
                        <textarea class="form-control" wire:model.defer="diagnosis.current_symptoms"
                                  placeholder="Leave a comment here" id="current_symptoms"
                                  style="min-height: 100px;"></textarea>
                        <label for="current_symptoms">@lang('admin.current_symptoms')</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row g-1">
                <div class="col-md-12">
                    <label class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">
                        @lang('admin.pharmaceutical')</label>
                </div>
                <div class="col-12 col-lg-12">
                    <!-- <label for="" class="small-label mb-2 fw-bold">@lang('admin.pharmaceutical') </label> -->
                    <div class="form-floating">
                        <textarea class="form-control" wire:model.defer="diagnosis.pharmaceutical"
                                  placeholder="Leave a comment here" id="pharmaceutical"
                                  style="min-height: 100px;"></textarea>
                        <label for="pharmaceutical">{{__("admin.nothing")}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row g-1">
                <div class="col-12 col-md-12">
                    <label for="exampleFormControlTextarea1"
                           class="mb-2 small-heading fw-normal d-block text-white p-2 alt2-bg-color">{{ __('Diagnose') }}</label>
                </div>
                <div class="col-12 col-md-12">
                    <div class="form-floating">
                        <input list="diagnoses" class="form-control" wire:model.defer="diagnosis.treatment"
                               style="min-height: 100px;">
                        <datalist id="diagnoses">
                            @foreach ($keywords as $item)
                                <option value="{{ $item->keywords }}">
                            @endforeach
                        </datalist>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="col-md-12">
                <label
                    class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">@lang('admin.treatment_plan')</label>
            </div>
            <div class="col-12 col-lg-12">
                <div class="form-floating">
                    <textarea class="form-control" wire:model.defer="diagnosis.treatment_plan"
                              placeholder="Leave a comment here" id="treatment_plan"
                              style="min-height: 100px;"></textarea>
                    <label for="treatment_plan">@lang('admin.treatment_plan')</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="col-md-12">
                <label
                    class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{__('admin.Upcoming dates and reviews')}}</label>
            </div>
            <div class="col-12 col-lg-12">
                <div class="form-floating">
                    <textarea class="form-control" wire:model.defer="diagnosis.next_visit"
                              placeholder="Leave a comment here" id="" style="min-height: 100px;"></textarea>
                    <label for="">{{__('admin.Upcoming dates and reviews')}}</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="col-md-12">
                <label
                    class="mb-2 small-heading d-block fw-normal text-white p-2 alt2-bg-color">{{__('admin.Attach files related to diagnosis, for example (radiography - laboratory - medical report)')}}</label>
            </div>
            <div class="col-12 col-lg-12">
                <div class="inp-holder">
                    <input type="file" class="form-control" wire:model.defer='diagnosis.files' multiple id="">
                </div>
                @if($files)
                    <div class="row">
                        @foreach ($files as $file)
                            <div class="col-md-4 mt-2">
                                <a class="btn btn-dark" href="{{ display_file($file->file) }}">عرض الملف</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="submitBtn-holder text-center mt-3">
        <button class="btn btn-secondary w-25">
            {{__("admin.previous")}}
        </button>
        <button class="btn btn-success w-25" wire:click="saveDiagnose">
            {{__("admin.next")}}
        </button>
    </div>
</section>
