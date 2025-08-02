@section('title')
@lang('pharmacy')
@endsection
<section class="main-section home">
    <div class="container">
        <ul class="nav nav-tabs d-flex flex-wrap gap-2 align-items-center" id="pills-tab"
            role="tablist" style="flex-wrap: wrap !important;">
            @can('read_pharmacy_statistics')
                <li class="nav-item" role="presentation">
                    <button wire:click="$set('screen','statistics')"
                            class="main-head btn-head {{$screen === 'statistics' ? 'active':''}}" type="button">@lang('pharmacy')
                    </button>
                </li>
            @endcan
            @can('read_pharmacy_warehouse')
                <li class="nav-item" role="presentation">
                    <button wire:click="$set('screen','warehouse')"
                            class="main-head btn-head  {{$screen === 'warehouse' ? 'active':''}}" type="button">
                        @lang('pharmacy_warehouse')
                    </button>
                </li>
            @endcan
            @can('read_pharmacy_medicine')
                <li class="nav-item" role="presentation">
                    <button wire:click="$set('screen','medicine')"
                            class="main-head btn-head {{$screen === 'medicine' ? 'active':''}}" type="button">@lang('pharmaceutical')
                    </button>
                </li>
            @endcan
            @can('read_pharmacy_types')

                <li class="nav-item" role="presentation">
                    <button wire:click="$set('screen','types')"
                            class="main-head btn-head {{$screen === 'types' ? 'active':''}}" type="button">@lang('Types')
                    </button>
                </li>
            @endcan
            @can('read_pharmacy_dangerous')

                <li class="nav-item" role="presentation">
                    <button wire:click="$set('screen','dangerous')"
                            class="main-head btn-head {{$screen === 'dangerous' ? 'active':''}}" type="button">@lang('Danger')
                    </button>
                </li>
            @endcan
            @can('read_pharmacy_descriptions')

                <li class="nav-item" role="presentation">
                    <button wire:click="$set('screen','describe')"
                            class="main-head btn-head {{$screen === 'describe' ? 'active':''}}" type="button">@lang('Recipes')
                            <span class="badge bg-danger">{{\App\Models\PharmacyPrescription::count()}}</span>
                    </button>
                </li>
            @endcan
        </ul>
        <x-message-admin/>

    @includeIf('livewire.pharmacy.screens.'.$screen)
</section>
