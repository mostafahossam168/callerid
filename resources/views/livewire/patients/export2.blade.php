<div class="appoints-section main-section">
    <div class="container">
        <h4 class="main-heading mb-4">
            تصدير شركات التامين
        </h4>

        <div class="appoints-content bg-white p-4 rounded-2 shadow">
            <div class="available-appointments section-content">
                <div class="btn_holder d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">

                    <div class="d-flex align-items-center justify-content-end flex-wrap  gap-2">
                        {{-- <button class="btn  btn-sm btn-outline-primary" wire:click="export">
                            {{ __('admin.Export') }}
                            <i class="fa-solid fa-file-import"></i>
                        </button> --}}
                        <a class="btn btn-sm btn-outline-primary rounded-0" href="{{ route('front.insurances.export') }}">
                            {{ __('admin.Export') }} Excel
                            <i class="fa-solid fa-file-import"></i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <div class="table-print" id="prt-content">
                    <table class="table main-table">
                        <thead>
                            <th>{{ __('admin.insurance') }}</th>
                            {{-- @can('رؤية جوال المريض')
                            <th>{{ __('admin.Mobile') }}</th>
                            @endcan --}}
                        </thead>
                        <tbody>
                            @forelse(App\Models\Insurance::all() as $nsurance)
                            <tr>
                                <td class="text-nowrap">{{ $nsurance->name ?? __('admin.Undefined') }}</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="12"></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- @push('js')

    @endpush --}}
</div>
