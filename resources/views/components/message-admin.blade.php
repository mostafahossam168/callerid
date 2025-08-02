@if(session()->has('error'))
<div class="alert w-100 my-2 d-block px-2  alert-warning alert-dismissible fade show ">
    <h6 class="me-4"><i class="icon fas fa-exclamation-triangle"></i> {{ trans('admin.alert') }}!</h6>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('success'))
<div class="alert w-50 my-2 d-block m-auto px-3 top-0 alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(count($errors->all()) > 0)
<div class="alert   my-2 d-block px-2  alert-warning alert-dismissible fade show" role="alert">
    <h6 class="me-4"><i class="icon fas fa-exclamation-triangle"></i> تحذير</h6>
    <ol class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ol>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
