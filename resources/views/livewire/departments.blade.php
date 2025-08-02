<section class="main-section users">
    <!-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning">{{$error}}</div>


        @endforeach
    @endif -->
    <x-alert></x-alert>
    @include('front.departments.add_or_update')
    <div class="container">
        <h4 class="main-heading">{{ __('admin.departments') }}</h4>
        <div class="section-content bg-white shadow rounded-3 p-4">
            <div class="d-flex align-items-center flex-wrap justify-content-end mb-2">
                @can('create_departments')
                <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
                    {{ __('admin.Add department') }}
                    <i class="icon fa-solid fa-plus me-1"></i>
                </button>
                @endcan
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th class="text-center">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->name }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    @can('update_departments')

                                    <button data-bs-toggle="modal" data-bs-target="#add_or_update"
                                        class="btn btn-sm btn-info text-white ms-1"
                                        wire:click='edit({{ $department }})'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    @endcan
                                    <a class="btn btn-danger btn-sm space-noWrap"
                                        href="{{ route('front.invoices.index',['department_id'=>$department->id]) }}">
                                        {{ __('admin.invoices') }}
                                        <i class="fa fa-file-invoice-dollar"></i>
                                    </a>
                                    @can('delete_departments')
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete_agent{{ $department->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                    @endcan

                                </div>
                            </td>
                        </tr>
                        @include('front.departments.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->

    </div>
</section>