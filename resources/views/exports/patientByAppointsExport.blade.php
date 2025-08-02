<table class="table main-table mt-3" style="min-width:1000px">
    <thead>
        <tr>
            <th scope="col">اس المريض</th>
            <th scope="col">{{__('admin.Mobile_number')}}</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($patients as $patient)
        <tr>
            <th scope="row">{{ $patient->first_name }}</th>
            <td>{{ $patient->phone }}</td>
        </tr>
        @endforeach


    </tbody>
</table>
