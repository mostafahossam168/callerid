<section id="app" class="main-section">
    <div class="container">
        <h4 class="main-heading mb-4">
            إضافة سند قيد
        </h4>
        <div class="p-3 shadow rounded-3 bg-white">
            <x-message-admin />
            <form action="" method="POST">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <input type="text" class="form-control" placeholder="الشرح البيان" v-model="voucherDescription"
                            id="">
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="date" class="form-control" v-model="date" id="">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table main-table table-bordered table-inp">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">مسلسل</th>
                                <th scope="col">التحكم</th>
                                <th scope="col">الحساب</th>
                                <th scope="col">مركز التكلفة</th>
                                <th scope="col">{{ __('debtor') }}</th>
                                <th scope="col">{{ __('creditor') }}</th>
                                <th scope="col">الشرح</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(tr,i) in dataTable">
                                <td>@{{i}}</td>
                                <td>
                                    <div class="btn-holder d-flex gap-1 justify-content-center">
                                        <button @click="addRow()" class="btn btn-sm btn-success xs-btn-icon "
                                            type="button">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button v-if="i > 0" @click="removeRow(i)"
                                            class="btn btn-sm btn-danger xs-btn-icon" type="button">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <select v-model="tr.account_id" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </td>
                                <td>
                                    <input required v-model="tr.debit" type="number" class="form-control" id="">
                                </td>
                                <td>
                                    <input required v-model="tr.credit" type="number" class="form-control" id="">
                                </td>
                                <td>
                                    <input required v-model="tr.description" type="text" class="form-control" id="">
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">الإجمالي</td>
                                <td class="bg-light-green">@{{totalDebit}}</td>
                                <td class="bg-light-green"> @{{totalCredit}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="holder-btn text-center">
                    <button type="button" class="btn btn-sm btn-primary px-3">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@push('js')
<script src="{{ asset('js/vue.js') }}"></script>
<script>
    const {
        ref,
        computed,
        createApp,
    } = Vue
    createApp({
        setup() {
            // voucher description
            var voucherDescription = ref("")

            // Date
            var date = ref("{{now()->format('Y-m-d')}}")

            // Table Rows
            var dataTable = ref([])
            // Add Row
            function addRow() {
                dataTable.value.push({
                    account_id: "",
                    debit: 0,
                    credit: 0,
                    description: ""
                })
            }
            addRow();
            // Remove Row
            function removeRow(id) {
                dataTable.value.splice(id, 1);
            }

            // total Debit
            const totalDebit = computed(() => {
                return dataTable.value.reduce((sum, row) => sum + parseFloat(row.debit || 0), 0)
            })
            // total Credit
            const totalCredit = computed(() => {
                return dataTable.value.reduce((sum, row) => sum + parseFloat(row.credit || 0), 0)
            })
            return {
                voucherDescription,
                date,
                dataTable,
                addRow,
                removeRow,
                totalDebit,
                totalCredit,
            };
        }
    }).mount("#app");
</script>
