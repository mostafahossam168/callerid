<section class="addPatient-section py-5 main-section">
    <x-message-admin />
    {{-- @dump($selectedOwner)  --}}
    @if ($screen == 'index')
        <div class="container" id="data-table">
            <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
                <h4 class="main-heading mb-0">@lang('Animal analyses')</h4>
            </div>
            <div class="bg-white shadow p-4 rounded-3">
                <div class="">
                    <div class="row my-3 g-2">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-10 d-flex flex-column flex-lg-row gap-2 px-0">

                            <div dir="ltr" class="input-group mb-2 mb-md-0">
                                <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                    @lang('Search')
                                </button>
                                <input dir="rtl" type="text" class="form-control" wire:model='key'
                                    placeholder="@lang('Search by name')" />
                            </div>

                        </div>

                        <div class="col-12 col-sm-12 col-lg-2 d-flex align-items-center justify-content-end px-0">
                            <div class="addBtn-holder ">
                                @can('create_analysis')
                                    <button wire:click="$set('screen','create')" class="btn-main-sm">
                                        @lang('Add new analysis')
                                        <i class="icon fa-solid fa-plus"></i>
                                    </button>
                                @endcan
                            </div>
                        </div>

                    </div>
                    <div class="table-print">
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('Owner name')</th>
                                        <th>@lang('Name animal')</th>
                                        <th>@lang('Analysis name')</th>
                                        <th>@lang('Analysis date')</th>
                                        <th>@lang('results')</th>
                                        <th>@lang('Results PDF')</th>
                                        <th>@lang('Send result')</th>
                                        <th class="text-center not-print">@lang('actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($analyses as $analysis)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="text-nowrap">{{ $analysis->owner?->name }}</td>
                                            <td class="text-nowrap">{{ $analysis->animal?->name }}</td>
                                            <td class="text-nowrap">{{ $analysis->package?->name }}</td>
                                            <td class="text-nowrap">{{ $analysis->date }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('front.analysis.show', $analysis->id) }}"><i
                                                        class="fa fa-eye"></i></a>
                                            </td>
                                            <td>
                                                @if ($analysis->hash_code)
                                                    <a class="btn btn-sm btn-danger" target="_blank"
                                                        href="{{ route('front.showAnalysisExternal', $analysis->hash_code) }}">PDF</a>
                                                @endif

                                            </td>
                                            @php
                                                $whatsapp_text = 'معمل ' . setting()->site_name;
                                                $whatsapp_text .= '...';
                                                $whatsapp_text .=
                                                    'تم الانتهاء من تحليل المريض الخاص بكم ' .
                                                        $analysis->animal?->name .
                                                        ' نرجو القدوم لاستلام نتيجة التحليل .. شكرا لزيارتكم وثقتكم فى معمل ' .
                                                        setting()->site_name ??
                                                    '';
                                            @endphp
                                            <td>
                                                <a class="btn-whatsapp fs-3 text-success" target="_blank"
                                                    href="https://wa.me/{{ $analysis->owner?->phone }}?text={{ $whatsapp_text }}">
                                                    <i class="fa-brands fa-whatsapp"></i> </a>
                                            </td>

                                            <td class="not-print">
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    @can('update_analysis')
                                                        <button class="btn btn-sm btn-info"
                                                            wire:click="edit({{ $analysis->id }})">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </button>
                                                    @endcan

                                                    @can('delete_analysis')
                                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#delete{{ $analysis->id }}"
                                                            wire:click='analysisId({{ $analysis->id }})'>
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    @endcan
                                                </div>
                                                @include('front.analysis.delete')
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $analyses->withQueryString()->links() }}
                </div>
            </div>
        </div>
    @else
        @include('front.analysis.form')
    @endif

</section>
