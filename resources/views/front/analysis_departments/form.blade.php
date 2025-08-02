<div class="container">
    <div class="p-4 bg-white rounded-3 shadow">
        <div
            class="holder mb-3 flex-column-reverse flex-sm-row d-flex align-items-start align-items-sm-center justify-content-between gap-2 ">
            <h4 class="main-heading mb-0"> @lang('admin.Controlling medical analysis departments')</h4>
            <a wire:click="$set('screen','index')" class="btn btn-sm  me-auto px-3 btn-secondary">@lang('admin.back') <i
                    class="fa-solid fa-arrow-left-long"></i></a>
        </div>
        <div class="addPatient-content p-4">
            <div class="Patient-form-data">
                <div class="row g-3">

                    <div class="col-12 col-md-3">
                        <div class="fild-control">
                            <select wire:model.defer="parent" id="" class="main-select w-100">
                                <option value="">@lang('Main sections') </option>
                                @foreach ($main_deparments as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <input type="text" class="form-control Patient-name" wire:model.lazy="name_ar"
                                       placeholder="@lang('You can make it a master partition without selecting a master partition')" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <input type="text" class="form-control Patient-name" wire:model.lazy="name_en"
                                       placeholder="@lang('Name in English')" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <input type="number" min="0" class="form-control Patient-phone"
                                       wire:model.lazy="price" placeholder="@lang('admin.price')" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <input type="text" class="form-control Patient-phone" wire:model.lazy="unit"
                                       placeholder="@lang('Unit')" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <label class="d-block">@lang('admin.Normal value type')</label>
                                <input type="radio" wire:model.lazy="range_type" value="text" /> @lang('admin.Text')
                                <input type="radio" wire:model.lazy="range_type" value="number" /> @lang('admin.Number')
                            </div>
                        </div>
                    </div>
                    @if ($range_type)
                        @if ($range_type == 'text')
                            <div class="col-12 col-md-3">
                                <div class="Patient-info right-side">
                                    <div class="fild-control mb-3">
                                        <input type="text" class="form-control Patient-phone"
                                               wire:model.lazy="reference_range" placeholder="@lang('admin.Normal value')" />
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-md-3">
                                <div class="Patient-info right-side">
                                    <div class="fild-control mb-3">
                                        <input type="text" class="form-control Patient-phone"
                                               wire:model.lazy="min_range" placeholder="@lang('admin.The lowest number')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="Patient-info right-side">
                                    <div class="fild-control mb-3">
                                        <input type="text" class="form-control Patient-phone"
                                               wire:model.lazy="max_range" placeholder="@lang('admin.The biggest number')" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <label for="">
                                    @lang('admin.active')
                                    <input type="checkbox" class="form-switch" wire:model.defer='status' id="">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end">
                        <button class="send-data btn btn-primary btn-sm px-4" wire:click.prevent='submit'>@lang('admin.Save')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function select2init() {
            $(document).ready(function() {
                $('.select2').each(function() {
                    $(this).select2();

                    $(this).on('change', function() {
                        var data = $(this).val();
                        var name = $(this).attr('id');
                        @this.set(name, data);
                    });
                })

            });
        }

        select2init();

        document.addEventListener('refreshSelect2', () => {
            select2init();
        });
    </script>
@endpush
