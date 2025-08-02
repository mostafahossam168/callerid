<div>
    <div class="row justify-content-center ">
        <div class="col-12 col-md-9">
            <div class="content">
                <div class="text align-items-center">
                    <p>{{ setting()->site_name }}</p>
                    <h4 class="mb-0">نموذج 2</h4>
                </div>
            </div>
            <table class="table  ">
                <tbody>
                    <tr>
                        <td colspan="4"><b>وظائف الكلي</b></td>
                        <td colspan="4">
                            <b>
                                صورة الدم الكاملة CBC
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>النسبة الطبيعية</b></td>
                        <td><b>وحدة القياس</b></td>
                        <td><b>العدد</b></td>
                        <td></td>
                        <td><b>النسبة الطبيعية</b></td>
                        <td><b>وحدة القياس</b></td>
                        <td><b>العدد</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.kidney.creatinine.normal_ratio"
                                    class="form-control py-0 ">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.kidney.creatinine.unit"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.kidney.creatinine.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>Creatinine</b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.wbcs.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.wbcs.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.wbcs.number" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>WBCs</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.kidney.urea.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.kidney.urea.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.kidney.urea.number" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>Urea</b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.lym.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.lym.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.lym.number" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>LYM%</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>وظائف الكبد</b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.mon.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.mon.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.mon.number" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>MON%</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.ast.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.ast.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.ast.number" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>AST</b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.neut.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.neut.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.neut.number" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>NEUT%</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.alt.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.alt.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.alt.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>ALT</b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.eos.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.eos.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.cbc.eos.number" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>EOS%</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.ggt.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.ggt.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.ggt.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>GGT%</b>
                        </td>
                        <td colspan="4">
                            <b>
                                كريات الدم الحمراء RBCs
                            </b>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.albumin.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.albumin.unit"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.albumin.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>Albumin</b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.rbcs.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.rbcs.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.rbcs.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>RBCs</b>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.protien.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.protien.unit"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.liver.protien.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>Protien</b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.hgb.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.hgb.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.hgb.number" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>HGB</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>
                                الجلوكوز Glucose
                            </b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.hct.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.hct.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.hct.number" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>HCT</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.glucose.glucose.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.glucose.glucose.unit"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.glucose.glucose.number"
                                    class="form-control py-0">
                            </div>
                        </td>



                        <td>
                            <b>
                                Glucose
                            </b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.mcv.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.mcv.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.mcv.number" class="form-control py-0">
                            </div>
                        </td>

                        <td>
                            <b>MCV</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>
                                العضلات Muscle Profile
                            </b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.mch.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.mch.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.mch.number" class="form-control py-0">
                            </div>
                        </td>

                        <td>
                            <b>MCH</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.muscle.cardiac_enzyme.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.muscle.cardiac_enzyme.unit"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.muscle.cardiac_enzyme.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>انزيم القلب</b>
                        </td>

                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.mchc.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.mchc.unit" class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.rbcs.mchc.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>MCHC</b>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <b>
                                الاملاج المعدنية Minerals
                            </b>
                        </td>
                        <td colspan="4">
                            <b>
                                الصفائح الدموية Platelets
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.minerals.ca.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.minerals.ca.unit"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.minerals.ca.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>
                                Ca
                            </b>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.platelets.plt.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.platelets.plt.unit"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.platelets.plt.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>
                                Plt
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.minerals.iron.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.minerals.iron.unit"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.minerals.iron.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b>
                                Iron
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.minerals.phos.normal_ratio"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.minerals.phos.unit"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around ">
                                <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.minerals.phos.number"
                                    class="form-control py-0">
                            </div>
                        </td>
                        <td>
                            <b> Phos
                            </b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="content mb-4">
                <div class="text align-items-center">
                    <h4 class="mb-0">الطفيليات الدم</h4>
                </div>
            </div>
            <table class=" mb-3">
                <tr>
                    <td><b>الاختبار</b></td>
                    <td><b>Trypanosoma</b></td>
                    <td><b>Anapisma</b></td>
                    <td><b>Babesia</b></td>
                    <td><b>Thieleria</b></td>
                </tr>
                <tr>
                    <td><b>النتائج</b></td>
                    <td>
                        <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.blood_parasites.trypanosoma" class="form-control w"
                            id="">
                    </td>
                    <td>
                        <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.blood_parasites.anapisma" class="form-control"
                            id="">
                    </td>
                    <td>
                        <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.blood_parasites.babesia" class="form-control"
                            id="">
                    </td>
                    <td>
                        <input type="text" {{isset($analysis) ? 'disabled' : ''}} wire:model="results.blood_parasites.thieleria" class="form-control"
                            id="">
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>
