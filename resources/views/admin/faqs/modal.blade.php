<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $question ? 'تعديل' : 'إضافة' }} سؤال</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-12">
                        <label class="small-label" for="">السؤال</label>
                        <input class="form-control" type="text" wire:model.defer='question' placeholder="">
                    </div>
                    <div class=" col-sm-12">
                        <label class="small-label" for="">الترتيب</label>
                        <input class="form-control" type="text" wire:model.defer='sort' placeholder="">
                    </div>

                    <div class="col-sm-12">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th colspan="2">الإجابات</th>
                                </tr>
                                <tr>
                                    <th>الإجابة</th>
                                    <th>إجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($answers as $index => $answer)
                                    <tr>
                                        <td>
                                            <label class="small-label" for="">إجابة #{{ $index + 1 }}</label>
                                            <input class="form-control" type="text"
                                                wire:model.defer='answers.{{ $index }}' placeholder="">
                                        </td>
                                        <td>
                                            @if ($index == 0)
                                                <button class="btn btn-sm btn-success m-1" wire:click="addAnswer"><i
                                                        class="fa fa-plus"></i> أضف</button>
                                            @endif

                                            @if (count($answers) > 1)
                                                <button class="btn btn-danger btn-sm m-1"
                                                    wire:click.prevent="removeAnswer({{ $index }})"><i
                                                        class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12">
                        <label class="small-label" for="">رابط</label>
                        <input class="form-control" type="text" wire:model.defer='url' placeholder="">
                    </div>

                    <div class="col-sm-12">
                        <label class="small-label" for="">مرفقات</label>
                        <input class="form-control" type="file" wire:model.defer='files' multiple placeholder="">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                <button wire:click='save' class="btn btn-primary" data-bs-dismiss="modal">{{ __('admin.save') }}</button>
            </div>
        </div>
    </div>
</div>
