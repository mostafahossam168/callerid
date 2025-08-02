@extends('front.layouts.front')
@section('title')
طفيليات الدم
@endsection
@section('content')
<section class="main-section notice">
    @php($notifications=App\Models\Notification::latest()->paginate(10))
    <div class="container">
        <h4 class="main-heading">طفيليات الدم</h4>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <th>
                        اسم العميل
                    </th>
                    <th>
                        نوع الحيوان
                    </th>
                    <th>
                        اسم الحيوان
                    </th>
                    <th>
                        التاريخ
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            حمدان حيان السبيعي
                        </td>
                        <td>
                            ابل
                        </td>
                        <td>
                            ناقه
                        </td>
                        <td>
                            4/3/2024
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr class="mb-3">
        <h5 class="text-center mb-3">
            <u>
                Blood Parasites
            </u>
        </h5>
        <div class="table-responsive" dir="ltr">
            <div class="row g-0 mb-2 row-cols-2 text-center">
                <div class="col">
                    <h5>
                        Test
                    </h5>
                </div>
                <div class="col">
                    <h5>
                        Result
                    </h5>
                </div>
            </div>
            <table class="table main-table">
                <tbody>
                    <tr>
                        <th class="w-50">
                            Trypanosoma
                        </th>
                        <td>
                            -ve سلبي
                        </td>
                    </tr>
                    <tr>
                        <th class="w-50">
                            Anaplsma
                        </th>
                        <td>
                            -ve سلبي
                        </td>
                    </tr>
                    <tr>
                        <th class="w-50">
                            Babesia
                        </th>
                        <td>
                            +ve إيجابي
                        </td>
                    </tr>
                    <tr>
                        <th class="w-50">
                            Thieleria
                        </th>
                        <td>
                            -ve سلبي
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection