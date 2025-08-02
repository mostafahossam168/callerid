<table class="main-table">
    <thead>
        <tr>
            <th>#</th>
            <th>الجوال</th>
            <th>الاسم</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
            <tr>

                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $client->phone_number }}</td>
                <td>
                    {{ $client->contactNames()->first()?->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
