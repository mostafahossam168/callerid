@extends('admin.layouts.admin')
@section('title','الاستبيانات')

@section('content')
<div class="content-header">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="text-right card-title fheader"></h4>
            </div>
            <div class="card-body">
                <div class="progress mb-3">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="" class="control-label">{{__('admin.name')}}</label>
                            <input disabled type="text" name="name" value="{{ $submit->patient->name }}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row mb-3 g-2">
                    @foreach ($questions as $key=>$question)
                    @if(array_key_exists($key,$submit->choices))
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group l-border">
                            <label for="" class="control-label mb-3 question-bg">{{ $question->title }}</label>
                            <div class="d-flex flex-column align-items-start ">
                                @foreach ($question->answers as $answer)
                                <div class="d-flex mb-1">
                                    <label for="" class='control-label mb-0 ml-2'>{{ $answer }}</label>
                                    <input disabled type="radio"  id="" {{
                                        $submit->choices[$key]==$answer?'checked':'' }} value="{{ $answer }}" required>
                                </div>
                                <div class="mb-2"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                </form>
            </div>
        </div>


    </div>
    @endsection
