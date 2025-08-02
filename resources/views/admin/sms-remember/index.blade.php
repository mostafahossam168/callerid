@extends('admin.layouts.admin')
@section('title','رسائل التذكير')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('admin.sms.create') }}" class="btn btn-info float-right mr-1 ml-1"><i
                                class="fa fa-plus " style="position:relative;top:3px"></i>{{ __('admin.Add') }}</a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان الرسالة</th>
                                <th> الرسالة</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sms as $sm)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$sm->title}}</td>
                                <td>{{$sm->message}}</td>


                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <a href="{{ route('admin.sms.edit',$sm->id) }}"
                                            class="btn btn-sm btn-info float-right mr-1 ml-1"><i class="fa fa-edit "
                                                style="position:relative;top:3px"></i>
                                                {{__('admin.Update')}}</a>
                                        <form action="{{ route('admin.sms.destroy',$sm->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm float-right mr-1 ml-1"><i
                                                    class="fa fa-trash " style="position:relative;top:3px"></i>حدف</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                            </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    @endsection
