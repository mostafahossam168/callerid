<section>

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="alert alert-info" role="alert">
                {{__("admin.The nWhen adding new vaccinations, please register them here to be saved and added to the diagnosis")}}
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th class="d-flex align-items-center justify-content-between">
                            {{__("admin.Vaccinations")}}
                        </th>
                        <th>
                            <button wire:click.prevent="addNewVaccination" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($vaccinations as $key => $vaccination)
                    <tr>
                        <td>
                            <input type="text" wire:model="vaccinations.{{ $key }}" id="" class="form-control" placeholder="{{__("admin.Type the name of the vaccination")}}">
                        </td>
                        <td style="vertical-align: middle;">
                            @if ($key != 0)
                            <button class="btn btn-danger btn-sm" wire:click.prevent="removeVaccination({{ $key }})"><i class="fa fa-trash"></i></button>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th class="d-flex align-items-center justify-content-between">
                            {{__("admin.Allergies")}}
                        </th>
                        <th>
                            <button wire:click.prevent="addNewSensitivity" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sensitivity as $index => $sens)
                    <tr>
                        <td>
                            <input type="text" wire:model="sensitivity.{{ $index }}" id="" class="form-control" placeholder="{{__("admin.Type the name of the allergy")}}">
                        </td>
                        <td style="vertical-align: middle;">
                            @if ($index != 0)
                            <button class="btn btn-danger btn-sm" wire:click.prevent="removeSensitivity({{ $index }})"><i class="fa fa-trash"></i></button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label for="" class="small-label">
                {{__("admin.Session attachment")}}
            </label>
            <div class="d-flex">
                <input type="file" class="form-control" wire:model='session_attachment' id="" cols="30" rows="10">
                <button class="btn btn-primary btn-sm " wire:click='saveSessionAttachment' style="border-top-right-radius: 0;border-bottom-right-radius: 0">{{ __('admin.Upload') }}</button>
            </div>
            @if($appointment?->session_attachment)
            <img src="{{ display_file($appointment->session_attachment) }}" alt="">
            @endif
        </div>
    </div>
    <div class="submitBtn-holder text-center mt-3">
        <button class="btn btn-secondary w-25">
            {{__("admin.previous")}}
        </button>
        <button wire:click='updatePatientData({{ $patient->id }})' class="btn btn-success w-25">
            {{__("admin.next")}}
        </button>
    </div>

</section>
