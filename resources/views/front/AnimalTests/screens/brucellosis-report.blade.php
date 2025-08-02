@extends('front.layouts.front')
@section('title')
تقرير مالطية
@endsection
@section('content')
    <section class="main-section notice">
        @php($notifications=App\Models\Notification::latest()->paginate(10))
        <div class="container">
        <h4 class="main-heading">تقرير مالطية</h4>
        <div class="table-responsive">
            <table class="table main-table" dir="ltr">
                <tbody>
                        <tr>
                            <th>
                            NAME
                            </th>
                            <td>
                            -
                            </td>
                            <th>
                            Spx
                            </th>
                            <td>
                            -
                            </td>
                        </tr>
                        <tr>
                            <th>
                            ANIMAL TYPE
                            </th>
                            <td>
                            -
                            </td>
                            <th>
                            Age
                            </th>
                            <td>
                            -
                            </td>
                        </tr>
                        <tr>
                            <th>
                            Refered 
                            </th>
                            <td>
                            -
                            </td>
                            <th>
                            Date
                            </th>
                            <td>
                            -
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
        <hr class="mb-3">
        <h5 class="text-center mb-3">
            <u>
            المالطية
            Brucellosis 
            </u>
        </h5>
        <div class="row g-4 row-cols-2" dir="ltr">
            <div class="col">
            <b>
                Test:
            </b>
            .....
            </div>
            <div class="col">
            <b>
                Result:
            </b>
            .....
            </div>
            <div class="col">
            <b>
                Brucellosis:
            </b>  
            .....
            </div>
        </div>
        </div>
    </section>

@endsection
