<div class="row">
    <div class="col-12">
        <div class="content mb-4">
            <div class="text align-items-center">
                <h4 class="mb-0">المالطية</h4>
            </div>
        </div>
        <table class=" mb-3">
            <tr>
                <td><b>الاختبار</b></td>
                <td><b>Brucellosis</b></td>
            </tr>
            <tr>
                <td>
                    <input type="text" {{ isset($analysis) ? 'disabled' : '' }} wire:model="results.maltese.test"
                        class="form-control w">
                </td>
                <td>
                    <input type="text" {{ isset($analysis) ? 'disabled' : '' }} wire:model="results.maltese.brucellosis"
                        class="form-control">
                </td>
            </tr>
        </table>
    </div>
</div>
