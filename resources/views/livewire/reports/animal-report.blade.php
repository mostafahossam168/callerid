<section class="ClidocReport main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">{{__("admin.animal_reports")}}</h4>
        </div>
        <div class="Cli&doc-report-content bg-white p-4 rounded-2 shadow">
            <div class="left-holder d-flex justify-content-end mb-2">
                <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                    <span>{{ __('admin.print') }}</span>
                </button>
                <button class="btn btn-sm btn-outline-info" id="export-btn">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>{{ __('admin.Export') }} Excel</span>
                </button>
            </div>
            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                @if (count($categories) > 0)
                <div class="table-responsive">
                    <table class="table main-table" id="data-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.count') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->animals_count }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td>{{ __('admin.Sorry, there are no results') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>