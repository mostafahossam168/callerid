<section class="main-section users">
    <x-alert></x-alert>
    @include('doctor.diagnose_keywords.add_or_update')
    <div class="container">
        <h4 class="main-heading">الكلمات الدلالية</h4>
        <div class="section-content bg-white shadow rounded-3 p-4">
            <div class="d-flex align-items-center flex-wrap justify-content-end mb-2">
                <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
                    {{ __('admin.Add') }}
                    <i class="icon fa-solid fa-plus me-1"></i>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الكلمات الدلالية</th>
                            <th class="text-center">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diagnose_keywords as $keyword)
                            <tr>
                                <td>{{ $keyword->id }}</td>
                                <td>{{ $keyword->keywords }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button data-bs-toggle="modal" data-bs-target="#add_or_update"
                                            class="btn btn-sm btn-info text-white ms-1"
                                            wire:click='edit({{ $keyword }})'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete_agent{{ $keyword->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('doctor.diagnose_keywords.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->

    </div>
</section>
