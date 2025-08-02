<section class="addPatient-section py-5 main-section">
    <x-message-admin/>
    @if ($screen == 'index')
        <div class="container" id="data-table">
            <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
                <h4 class="main-heading mb-0">@lang('Laboratory Departments')</h4>
            </div>
            <div class="bg-white shadow p-4 rounded-3">
                <div class="">
                    <div class="d-flex align-items-center my-3 gap-3 flex-wrap justify-content-between">
                        <div dir="ltr" class="input-group w-auto">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                @lang('Search')
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model='key'
                                placeholder="@lang('Search by name')" />
                        </div>

                        <div class="addBtn-holder ">
                            @can('delete_analysis_departments')
                                <button wire:click="$set('screen','create')" class="btn-main-sm">
                                    @lang('Controlling medical analysis departments')
                                    <i class="icon fa-solid fa-plus"></i>
                                </button>
                            @endcan
                        </div>

                    </div>
                    <div class="table-print">
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('Main section')</th>
                                        <th>@lang('Subsection')</th>
                                        <th>@lang('Unit')</th>
                                        <th>@lang('Natural ratio')</th>
                                        <th>@lang('price')</th>
                                        <th>@lang('Status')</th>

                                        <th class="text-center not-print">@lang('actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="text-nowrap">{{ $department->name_ar }}</td>
                                            <td>{{ $department->main?->name_ar }}</td>
                                            <td>{{ $department->unit }}</td>
                                            <td>
                                                @if ($department->reference_range)
                                                    {{ $department->reference_range }}
                                                @elseif($department->min_range && $department->max_range)
                                                    {{ $department->min_range . ' - ' . $department->max_range }}
                                                @endif
                                            </td>
                                            <td>{{ $department->price }}</td>
                                            <td><span
                                                    class="badge bg-{{ $department->status ? 'success' : 'danger' }}">{{ $department->status ? __('active') : __('inactive') }}</span>
                                            </td>

                                            <td class="not-print">
                                                <div class="d-flex align-items-center justify-content-center gap-1">

                                                    @can('update_analysis_departments')
                                                        <button class="btn btn-sm btn-info"
                                                            wire:click="edit({{ $department->id }})">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </button>
                                                    @endif
                                                    @can('delete_analysis_departments')
                                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#delete"
                                                            wire:click='departmentId({{ $department->id }})'>
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @include('front.analysis_departments.delete')
                        </div>
                    </div>
                    {{ $departments->links() }}
                </div>
            </div>
        </div>
    @else
        @include('front.analysis_departments.form')
    @endif

</section>
