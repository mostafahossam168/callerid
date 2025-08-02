<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Patient') }}</th>
                <th>{{ __('admin.dr') }}</th>
                <th>{{ __('admin.Hour') }}</th>
                <th>{{ __('admin.Day') }}</th>
                <th>{{ __('admin.Period') }}</th>
                <th>{{ __('admin.Clinic') }}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diagnoses as $diagnose)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $diagnose->dr->name }}</td>
                <td>{{ $diagnose->time }}</td>
                <td>{{ $diagnose->day }}</td>
                <td>{{ __($diagnose->period) }}</td>
                <td>{{ $diagnose->department?->name }}</td>
                <td>
                    <a target="blank" class="preview-btn btn btn-sm btn-purple mx-1" href="{{ route('doctor.diagnose.show',$diagnose) }}">
                        <i class="fa-solid fa-eye"></i>
                    </a>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $diagnoses->links() }}
</div>
