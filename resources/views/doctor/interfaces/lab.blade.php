<div class="p-3">
    <div class="d-flex gap-2 align-items-center justify-content-end ">
        <h6>
            حدد النموذج الخاص بالتحليل:
        </h6>
        <ul class="nav   gap-3  justify-content-center choice-register">
            <li class="item">
                <input type="radio" wire:model="form_type" id="lab-1" value="first_form">
                <label for="lab-1">
                    نموذج1
                </label>
            </li>
            <li class="item">
                <input type="radio" wire:model="form_type" id="lab-2" value="second_form">
                <label for="lab-2">
                    نموذج2
                </label>
            </li>
            <li class="item">
                <input type="radio" wire:model="form_type" id="lab-3" value="third_form">
                <label for="lab-3">
                    نموذج3
                </label>
            </li>
            <li class="item">
                <input type="radio" wire:model="form_type" id="lab-4" value="fourth_form">
                <label for="lab-4">
                    نموذج4
                </label>
            </li>
        </ul>
    </div>
    <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2"> {{__('admin.Attach files')}}</label>
        <input type="file" wire:model.defer='file' class="form-control w-auto">
    </section>
    <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2">{{__('admin.Doctor report')}}</label>
        <textarea class="form-control" rows="3" wire:model.defer="dr_content"></textarea>
    </section>
    {{-- <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2 d-block">خدمة المختبر</label>
        <select wire:model.defer="lab_product_id" class="main-select w-auto" id="">
            <option value="">اختر خدمة المختبر</option>
            @foreach ($lab_products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
    @endforeach
    </select>
    </section> --}}
    <button type="button" class="btn btn-sm btn-primary" wire:click='saveLab'>{{ __('admin.save') }}</button>
    <div class="table-responsive mt-4">
        <table id="prt-content" class="table main-table ">
            <thead>
                <tr>
                    <th>{{ __('admin.animal') }}</th>
                    <th>{{__('admin.Diagnosis')}}</th>
                    <th>{{ __('admin.File') }}</th>
                    <th>{{__('admin.Date')}}</th>
                    <th class="text-center not-print">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dump() --}}
                @forelse($patient->labs()->where('animal_id',$animal->id)->get() as $lab)
                <tr>
                    <td>{{ $lab->animal?->name }}</td>
                    <td>{{ $lab->file_name }}</td>
                    <td>
                        @if($lab->file_path)
                        <a target="_blank" href="{{ display_file($lab->file_path) }}">عرض الملف</a>
                        @endif
                    </td>
                    <td>{{ $lab->created_at->diffForHumans() }}</td>
                    <td>
                        <div class="btn_holder d-flex align-items-center justify-content-center gap-2">
                            @if ($lab->file)
                            <a target="_blank" href="{{ display_file($lab->file) }}" class="btn btn-sm btn-info text-white">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endif
                            <a target="_blank" href="{{route('front.lab-table-2')}}} }}" title="عرض النموذج" class="btn btn-sm btn-secondary text-white">
                                <i class="fa-solid fa-file"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
