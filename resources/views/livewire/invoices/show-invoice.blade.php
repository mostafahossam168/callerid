<div>
    <!-- <div class="mb-4 container text-center mt-4 not-print">
        <a class="btn btn-warning btn-sm"
            href="{{ route('front.invoices.show', [$invoice->id, 'type' => 'thermal']) }}">حرارية</a>
        <a class="btn btn-primary btn-sm" href="{{ route('front.invoices.show', [$invoice->id, 'type' => 'a4']) }}">A4</a>
    </div> -->
    @if (request('type') && request('type') == 'thermal')
    @include('livewire.invoices.form2')
    @else
    @include('livewire.invoices.form1')
    @endif
    <div class="my-3 text-center not-print">
        <a class="btn btn-warning btn-sm px-4 not-print " href="javascript:print()"><i class="fa-solid fa-print"></i>
            {{ __('print') }} </a>
        <a class="btn btn-warning btn-sm" href="{{ route('front.invoices.show', [$invoice->id, 'type' => 'thermal']) }}">حرارية</a>
        <a class="btn btn-primary btn-sm" href="{{ route('front.invoices.show', [$invoice->id, 'type' => 'a4']) }}">A4</a>

    </div>

</div>
