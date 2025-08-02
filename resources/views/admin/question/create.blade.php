@extends('admin.layouts.admin')
@section('title','انشاء سؤال جديد')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">انشاء سؤال جديد</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.questions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">عنوان السؤال</label>
                    <input type="text" name="title" id="" class="form-control" value="{{ old('title') }}">
                </div><br>
                <div class="form-group">
                    <label for="">إجابات السؤال</label>

                    <div class="form-group">
                        <div ng-app="gaigDemo">
                            <div class="with-bg" ng-controller="DemoCtrl as demo" class="demo">
                                <div class="wrapper" style="padding: 0px;">
                                    <div class="navbar navbar-static-top">
                                        <div class="navbar-inner"></div>
                                    </div>
                                    <div class="navhelper">
                                        <div class="navhelper-inner"></div>
                                    </div>

                                    <div class="gaig-main">
                                        <div class="gaig-stage">
                                            <div class="gaig-stage-inner">
                                                <div>
                                                    <textarea name="answers" id="editor0" rows="10" cols="80">

                                                          </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div><br>
                <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
            </form>
        </div>
    </div>
</div>
<script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script>
<script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/jquery.min.js"></script>
  <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/angular.min.js"></script>
  <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/gaig-ui-bootstrap.js"></script>
  <script src="{{ asset('js') }}/sweetalert2.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <!-- script for handle textarea ckeditor -->
<script>
    function DemoCtrl() {

          this.foo = 'foo';

          CKEDITOR.editorConfig = function(config) {
              config.extraPlugins = 'confighelper';
          };
          CKEDITOR.replace('editor0');
          CKEDITOR.replace('editor1');
          CKEDITOR.replace('editor2');
          CKEDITOR.replace('editor3');

      }

      angular
          .module('gaigDemo', ['gaigUiBootstrap'])
          .controller('DemoCtrl', DemoCtrl);
</script>
@endsection
