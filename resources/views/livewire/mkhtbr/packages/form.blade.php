<section class="addPatient-section py-5">
    <x-message-admin></x-message-admin>

    <div class="container">
        <div class="p-4 bg-white rounded-3 shadow">
            <div
                class="holder mb-3 flex-column-reverse flex-sm-row d-flex align-items-start align-items-sm-center justify-content-between gap-2 ">
                <h4 class="main-heading mb-0">{{ $screen == 'add' ? __('Add') : __('Edit') }}</h4>
                <a wire:click="back()" class="btn btn-sm  me-auto px-3 btn-secondary">@lang('back') <i
                        class="fa-solid fa-arrow-left-long"></i></a>
            </div>
            <div class="addPatient-content ">
                <h4 class="section-title px-2 py-3 fs-18px rounded-3 mb-4 text-center">
                    @lang('Analysis departments')
                </h4>
                <div class="row g-3 Patient-form-data">
                    <div class="col-sm-12 col-md-6">
                        <div class="fild-control">
                            <input type="text" id="Patient-id" class="form-control Patient-id"
                                wire:model.defer="name" placeholder="@lang('name')" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="fild-control">
                            <select wire:model="breed_id" class="form-select">
                                <option value="">اختر السلالة</option>
                                @foreach ($breeds as $breed)
                                    <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>@lang('name')</th>
                                    <th width="50%">@lang('Normal value type')</th>
                                   {{--  <th>@lang('Sort')</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $index => $department)
                                    <tr>
                                        <td>
                                            @if ($index == 0)
                                                <button class="btn btn-sm btn-success" wire:click="addItem"><i
                                                        class="fa fa-plus"></i></button>
                                            @endif

                                            @if ($index > 0)
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="removeItem({{ $index }})"><i
                                                        class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <select class="form-select"
                                                    wire:model="departments.{{ $index }}.analysis_department_id">
                                                    <option value="">اختر القسم</option>
                                                    @foreach ($analysis_departments as $analysis_department)
                                                        <option value="{{ $analysis_department->id }}">
                                                            {{ $analysis_department->name_ar . ' - ' . $analysis_department->name_en }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="col-12 col-md-3">
                                                <div class="Patient-info right-side">
                                                    <div class="fild-control mb-3">
                                                        <label class="d-block">@lang('admin.Normal value type')</label>
                                                        <input type="radio"
                                                            wire:model.lazy="departments.{{ $index }}.range_type"
                                                            value="text" /> @lang('admin.Text')
                                                        <input type="radio"
                                                            wire:model.lazy="departments.{{ $index }}.range_type"
                                                            value="number" /> @lang('admin.Number')
                                                    </div>
                                                </div>
                                            </div>
                                            @if (isset($department['range_type']))
                                                @if ($department['range_type'] == 'text')
                                                    <div class="fild-control mb-3">
                                                        <input type="text" class="form-control Patient-phone"
                                                            wire:model.lazy="departments.{{ $index }}.reference_range"
                                                            placeholder="@lang('admin.Normal value')" />
                                                    </div>
                                                @elseif($department['range_type'] == 'number')
                                                    <div class="fild-control mb-3">
                                                        <input type="text" class="form-control Patient-phone"
                                                            wire:model.lazy="departments.{{ $index }}.min_range"
                                                            placeholder="@lang('admin.The lowest number')" />
                                                    </div>


                                                    <div class="fild-control mb-3">
                                                        <input type="text" class="form-control Patient-phone"
                                                            wire:model.lazy="departments.{{ $index }}.max_range"
                                                            placeholder="@lang('admin.The biggest number')" />
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @php
                                                $count = count($departments);
                                            @endphp
                                            <div>
                                                <select class="form-select"
                                                    wire:model="departments.{{ $index }}.sort">
                                                    <option value="">اختر الترتيب</option>
                                                    @for ($i = 1; $i <= $count; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-end">
                        <button class="send-data btn btn-primary btn-sm px-4"
                            wire:click.prevent='submit'>@lang('admin.Save')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
