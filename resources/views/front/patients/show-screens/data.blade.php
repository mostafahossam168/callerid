<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Medical number') }}</th>
                <th>{{ __('admin.name') }}</th>
                <th>{{ __('admin.phone') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $patient->id }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->phone?: '2523632152' }}</td>
            </tr>
        </tbody>
    </table>
</div>
@if(!($patient instanceof App\Models\Animal))
<h3 class="small-heading my-3 fs-18px"><th>{{__('admin.Pets')}}</h3>

<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{__('admin.name')}}</th>
                <th>{{__('admin.Type')}}</th>
                <th>{{__('admin.category')}}</th>
                <th>{{__('admin.Owner')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->animals as $animal)
            <tr>
                <td>{{ $animal->name ?? 'لا يوجد' }}</td>
                <td>{{ $animal->gender ?? 'لا يوجد' }}</td>
                <td>{{ $animal->category?->name }}</td>
                <td>{{ $animal->patient?->first_name ?? null }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div><br><br><br>
@endif
