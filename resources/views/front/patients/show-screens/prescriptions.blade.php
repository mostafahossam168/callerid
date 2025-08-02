
<div class="table-responsive">
    <table class="table main-table">
        <thead>
        <tr>
            <th>رقم الوصفة</th>
            <th>الطبيب</th>
            <th>(صرف بواسطة)الصيدلي</th>
            <th>التاريخ</th>
            <th>الصرف</th>
            <th class="text-center not-print">العمليات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prescriptions as $prescription)
            <tr>
                <td>{{$prescription->id}}</td>
                <td>{{$prescription->appointment->doctor?->name}}</td>
                <td>{{$prescription->pharmacist?->name}}</td>
                <td>{{$prescription->created_at->format('Y-m-d')}}</td>
                <td>
                    @if($prescription->is_dispensed_by_pharmacist)
                        <span class="badge bg-success fs-14">تم الصرف</span>
                    @else
                        <span class="badge bg-warning fs-14">بالانتظار</span>
                    @endif
                </td>
                <td class="not-print">
                    <div class="d-flex align-items-center justify-content-center gap-1">
                        <a href="{{route('front.describe-show',$prescription->id)}}" class="btn btn-sm btn-purple">
                            <i class="fa fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
    {{ $prescriptions->links() }}
</div>

