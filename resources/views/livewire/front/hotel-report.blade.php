@php use App\Models\Animal; @endphp
@section('title')
تقرير الفندقة
@endsection
<section class="ClidocReport main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading m-0">تقرير الفندقة</h4>
        </div>
        <div class="Cli&doc-report-content bg-white p-4 rounded-2 shadow">
            <div class="d-flex gap-2 mb-2 flex-wrap justify-content-between">

                <div class="gap-1 flex-wrap d-flex">
                    <a wire:click="$set('filter','')" href="#" class="btn btn-sm btn-primary">
                        كل النزلاء: {{ $invoices->count() }}
                    </a>
                    <a wire:click="$set('filter','present')" href="#" class="btn btn-sm btn-success">
                        نزلاء موجودين: {{ $present }}
                    </a>
                    <a wire:click="$set('filter','left')" href="#" class="btn btn-sm btn-danger">
                        نزلاء تم المغادرة: {{ $left }}
                    </a>
                </div>
                <div class="gap-1 flex-wrap d-flex">
                    <button class="btn btn-sm btn-outline-warning" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                        <span>{{ __('admin.print') }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                </div>
            </div>
            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table" id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المالك</th>
                                <th>الأليف</th>
                                <th>تاريخ الدخول</th>
                                <th>تاريخ المغادرة</th>
                                <th>عدد الايام</th>
                                <th>الفاتورة</th>
                                <th>الملاحظات</th>
                                {{-- <th>التحكم</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->patient?->name }}</td>
                                <td>
                                    @foreach ($invoice->animals as $animal)
                                    {{ $animal->name }}
                                    @if ($loop->iteration > 1)
                                    '-'
                                    @endif
                                    @endforeach
                                </td>
                                <td>{{ $invoice->entry_date }}</td>
                                <td>{{ $invoice->departure_date }}</td>
                                <td>{{ $invoice->num_of_days }}</td>
                                <td><a href="{{ route('front.invoices.show', $invoice->id) }}"><i class="fa fa-money-bills text-danger"></i></a></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" wire:click="getNotes({{ $invoice->id }})" data-bs-target="#notes{{ $invoice->id }}">اضف ملاحظة</button>
                                    <button type="button" class="btn btn-secondary btn-sm" title='عرض الملاحظات' data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-file"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">عرض الملاحظات</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ Str::limit($invoice->notes) }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">رجوع</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="notes{{ $invoice->id }}" data-bs-keyboard="false" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                {{ __('notes') }}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <textarea wire:model="notes" class="form-control" rows="3">{{ $invoice->notes }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">{{ __('admin.Back') }}</button>
                                            <button type="button" wire:click="saveNotes({{ $invoice->id }})" data-bs-dismiss="modal" class="btn btn-success btn-sm px-3 print-btn">
                                                {{ __('Save') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
<script>
    function printData() {
        let divToPrint = document.getElementById("data-table");
        newWin = window.open("");
        newWin.document.head.replaceWith(document.head.cloneNode(true));
        newWin.document.body.appendChild(divToPrint.cloneNode(true));
        setTimeout(() => {
            newWin.print();
            newWin.close();
        }, 600);
    }
    document.getElementById("print-btn").addEventListener("click", printData);

    function downloadCSVFile(csv, filename) {
        var csv_file, download_link;
        csv_file = new Blob(["\uFEFF" + csv], {
            type: "text/csv"
        });
        download_link = document.createElement("a");
        download_link.download = filename;
        download_link.href = window.URL.createObjectURL(csv_file);
        download_link.style.display = "none";
        document.body.appendChild(download_link);
        download_link.click();
    }

    function htmlToCSV(html, filename) {
        var data = [];
        var rows = document.querySelectorAll("table tr");
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");
            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }
            data.push(row.join(","));
        }
        downloadCSVFile(data.join("\n"), filename);
    }
    document.getElementById("export-btn").addEventListener("click", function() {
        var html = document.getElementById("data-table").outerHTML;
        htmlToCSV(html, "report.csv");
    });
</script>
@endpush
