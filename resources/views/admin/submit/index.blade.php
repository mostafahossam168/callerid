@extends('admin.layouts.admin')
@section('title','تعبئات الاستبيانات')

@section('content')
<div class="content-header">
<!-- Main content -->
<div class="content">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">تعبئات الاستبيانات</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المريض</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submits as $submit)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td >
                                    {{$submit->patient->name}}
                                </td>
                                <td>
                                    <a target="_blank" href="{{ route('admin.submits.show',$submit) }}" class="btn btn-info btn-sm float-right mr-1 ml-1"><i class="fa fa-eye"></i></a>
                                    <form action="{{ route('admin.submits.destroy',$submit->id) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm float-right mr-1 ml-1"><i
                                                class="fa fa-trash " style="position:relative;top:3px"></i>حدف</button>
                                    </form>
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
</div>
@section('js')


<script src="{{asset('adminlte-rtl/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('adminlte-rtl/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte-rtl/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte-rtl/plugins/fastclick/fastclick.js')}}"></script>

<!-- AdminLTE for demo purposes
<script src="../../dist/js/demo.js"></script>
 page script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>

@endsection
@endsection
