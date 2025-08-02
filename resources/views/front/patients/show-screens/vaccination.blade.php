<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Patient') }}</th>
                <th>{{ __('admin.dr') }}</th>
                <th>اسم التطعيم</th>
                <th>سلالة الأليف</th>
                <th>اسم الأليف</th>
                <th>{{ __('admin.Date') }}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>

        @foreach($vaccines as $invoice_item)
            <tr>
                <td>{{$invoice_item->invoice?->patient?->name}}</td>
                <td>{{$invoice_item->invoice?->dr?->name}}</td>
                <td>{{$invoice_item->vaccine?->name}}</td>
                <td>{{$invoice_item->animal?->name}}</td>
                <td>{{$invoice_item->animal?->strain?->name}}</td>
                <td>{{$invoice_item->next_vaccine_date}}</td>
                <td>
                    <a href="" target="_blank" data-bs-toggle="modal" data-bs-target="#exampleModal{{$invoice_item->id}}" class="preview-btn btn btn-sm btn-purple">
                        <i class="fa-solid fa-eye"></i>
                    </a>

                    <div class="modal  fade" id="exampleModal{{$invoice_item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class=" modal-xl modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">عرض التطعيم</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table main-table">
                                        <thead>
                                        <tr>
                                            <th>{{ __('admin.Patient') }}</th>
                                            <th>{{ __('admin.dr') }}</th>
                                            <th>اسم التطعيم</th>
                                            <th>سلالة الأليف</th>
                                            <th>اسم الأليف</th>
                                            <th>{{ __('admin.Date') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$invoice_item->invoice?->patient?->name}}</td>
                                                <td>{{$invoice_item->invoice?->dr?->name}}</td>
                                                <td>{{$invoice_item->vaccine?->name}}</td>
                                                <td>{{$invoice_item->animal?->name}}</td>
                                                <td>{{$invoice_item->animal?->strain?->name}}</td>
                                                <td>{{$invoice_item->next_vaccine_date}}</td>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
