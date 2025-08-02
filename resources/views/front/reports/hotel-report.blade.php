@extends('front.layouts.front')
@section('title')
    تقرير الفندقة
@endsection
@section('content')
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
                    <a href="#" class="btn btn-sm btn-primary">
                        كل النزلاء: 5
                    </a>
                    <a href="#" class="btn btn-sm btn-success">
                        نزلاء موجودين: 2
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                        نزلاء تم المغادرة: 3
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
                                <th>الفاتورة</th>
                                <th>الملاحظات</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
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
@endsection
