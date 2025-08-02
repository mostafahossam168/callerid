<div class="table-responsive">
    <table class="table main-table">
        <tr>
            <td>#</td>
            <td>{{__('admin.Content')}}</td>
            <td></td>
        </tr>
        @forelse($logs as $log)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$log->content}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">{{__('admin.There is no activity')}}</td>
        </tr>
        @endforelse
    </table>
    {{ $logs->links() }}
</div>
