@extends('admin.layouts.admin')
@section('title','الأسئلة')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('admin.questions.create') }}" class="btn btn-info float-right mr-1 ml-1"><i
                                class="fa fa-plus " style="position:relative;top:3px"></i>إضافة سؤال </a>
                        </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان السؤال</th>
                                <th>إجابات السؤال</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($questions) > 0)
                            @foreach($questions as $question)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$question->title}}</td>
                                <td>
                                    @foreach ($question->answers as $answer)
                                    <li> {!! $answer !!}</li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('admin.questions.edit',$question->id) }}"
                                        class="btn btn-sm btn-info float-right mr-1 ml-1"><i class="fa fa-edit "
                                            style="position:relative;top:3px"></i>
                                            {{__('admin.Update')}}</a>
                                    <form action="{{ route('admin.questions.destroy',$question->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm float-right mr-1 ml-1"><i
                                                class="fa fa-trash " style="position:relative;top:3px"></i>حدف</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    @endsection
