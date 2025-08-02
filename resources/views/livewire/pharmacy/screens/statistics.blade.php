<div class=" main-tab-content border-0 pt-3 px-2 pb-0">
    <h4 class="small-heading mb-3">@lang('Pharmacy statistics')</h4>
    @can('read_pharmacy_statistics')
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="bg-white shadow p-3 rounded h-100">
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="box-status blue">
                            <div class="icon-style">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                            <div class="text">
                                <div class="count">
                                    {{\App\Models\PharmacyWarehouse::count()}}
                                </div>
                                <div class="title">
                                    @lang('stocks')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="box-status green">
                            <div class="icon-style">
                                <i class="fa-solid fa-suitcase-medical"></i>
                            </div>
                            <div class="text">
                                <div class="count">
                                    {{\App\Models\PharmacyMedicine::count()}}

                                </div>
                                <div class="title">
                                    @lang('All medicines')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="box-status red">
                            <div class="icon-style">
                                <i class="fa-solid fa-capsules"></i>
                            </div>
                            <div class="text">
                                <div class="count">
                                    {{\App\Models\PharmacyMedicine::where('quantity',0)->count()}}
                                </div>
                                <div class="title">
                                    @lang('Medicines unavailable')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="box-status purple">
                            <div class="icon-style">
                                <i class="fa-solid fa-pills "></i>
                            </div>
                            <div class="text">
                                <div class="count">
                                    {{\App\Models\PharmacyMedicine::expired()->count()}}
                                </div>
                                <div class="title">
                                    @lang('Expired medications')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="box-status orange">
                            <div class="icon-style">
                                <i class="fa-solid fa-user-doctor"></i>
                            </div>
                            <div class="text">
                                <div class="count">
                                    {{\App\Models\PharmacyPrescription::count()}}
                                </div>
                                <div class="title">
                                    @lang('All recipes')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="bg-white shadow p-3 rounded">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    @endcan
</div>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'line'
        , data: {
            labels: ["{{__('Medicines unavailable')}}", "{{__('stocks')}}", "{{__('All medicines')}}", "{{__('Expired medications')}}", "{{__('All recipes')}}"]
            , datasets: [{
                label: "{{__('stocks')}}"
                , data: [parseInt("{{\App\Models\PharmacyWarehouse::count()}}")]
                , borderWidth: 1
            }, {
                label: "{{__('Medicines unavailable')}}"
                , data: [parseInt("{{\App\Models\PharmacyMedicine::where('quantity',0)->count()}}")]
                , borderWidth: 1
            }, {
                label: "{{__('All recipes')}}"
                , data: [parseInt("{{\App\Models\PharmacyPrescription::count()}}")]
                , borderWidth: 1
            }, {
                label: "{{__('Expired medications')}}"
                , data: [parseInt("{{\App\Models\PharmacyMedicine::expired()->count()}}")]
                , borderWidth: 1
            }, {
                label: "{{__('All medicines')}}"
                , data: [parseInt("{{\App\Models\PharmacyMedicine::count()}}")]
                , borderWidth: 1
            }, ]
        }
        , options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
@endpush
