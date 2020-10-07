<template>
    <div>
        <headerComponent></headerComponent>
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Sales Statement</h3>
                                        <div class="card-tools">
                                        <button v-on:click="showReport" class="btn btn-success">
                                            <i class="fas fa-eye fa-fw"></i> Show Report
                                        </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-6" style="float:left;">
                                        <div class="form-group">
                                            <label>Beginning Date</label>
                                            <input
                                            v-model="formData.fromDate"
                                            :class="errors.hasOwnProperty('fromDate')?'is-invalid':''"
                                            type="date"
                                            name="bday"
                                            max="3000-12-31"
                                            min="1000-01-01"
                                            class="form-control"
                                            />
                                            <span
                                            class="text-danger"
                                            v-if="errors.hasOwnProperty('fromDate')"
                                            >{{errors.fromDate[0]}}</span>
                                        </div>
                                        </div>
                                        <div class="col-md-6" style="float:right;">
                                        <div class="form-group">
                                            <label>Ending Date</label>
                                            <input
                                            v-model="formData.toDate"
                                            :class="errors.hasOwnProperty('toDate')?'is-invalid':''"
                                            type="date"
                                            name="bday"
                                            min="1000-01-01"
                                            max="3000-12-31"
                                            class="form-control"
                                            />
                                            <span
                                            class="text-danger"
                                            v-if="errors.hasOwnProperty('toDate')"
                                            >{{errors.toDate[0]}}</span>
                                        </div>
                                        </div>

                                        <div class="col-md-6" style="float:left;">
                                        <div class="form-group">
                                            <label>Fixed Date</label>
                                            <input
                                            v-model="formData.fixedDate"
                                            :class="errors.hasOwnProperty('fixedDate')?'is-invalid':''"
                                            type="date"
                                            name="bday"
                                            max="3000-12-31"
                                            min="1000-01-01"
                                            class="form-control"
                                            />
                                            <span
                                            class="text-danger"
                                            v-if="errors.hasOwnProperty('fixedDate')"
                                            >{{errors.fixedDate[0]}}</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="!isHidden" class="card">
                                    <div class="card-header" style="text-align:center;">
                                        <h3 class="card-title">Prothoma Publications</h3>
                                        <p>43-44 Aziz Co-op Super Market, Shahbag, Dhaka - 1000</p>
                                        <h4 v-if="formData.fixedDate == ''">Sales Statement: {{ formData.fromDate }} to {{ formData.toDate }}</h4>
                                        <h4 v-else>Sales Statement: {{ formData.fixedDate }}</h4>

                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>SI No.</th>
                                                    <th>ISBN</th>
                                                    <th>Book Name</th>
                                                    <th>Author</th>
                                                    <th>Sales Price</th>
                                                    <th>Quantity</th>
                                                    <th>Available</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr v-for="statement in statementData" :key="statement.id">
                                                    <td>1</td>
                                                    <td>{{ statement.book.isbn }}</td>
                                                    <td>{{ statement.book.book_name }}</td>
                                                    <td>{{ statement.book.author }}</td>
                                                    <td>{{ statement.unit_price }}</td>
                                                    <td>{{ statement.qty }}</td>
                                                    <td>{{ statement.book.available_quantity }}</td>
                                                    <td>3</td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <footerComponent></footerComponent>
    </div>
</template>

<script>
    import headerComponent from "./header";
    import footerComponent from "./footer";
    export default {
        name: "Stock",
        data() {
            return {
                isHidden: true,
                errors: {},
                formData: {
                    toDate: "",
                    fromDate: "",
                    fixedDate: ""
                },
                statementData:[],
                
            };
        },
        created() {},

        computed: {},

        methods: {
            showReport() {
            this.errors = {};
            axios
                .get(
                `sales-statement-report?fromDate=${this.formData.fromDate}&toDate=${this.formData.toDate}&fixedDate=${this.formData.fixedDate}`
                )
                .then(response => {
                this.isHidden = false;
                this.statementData = response.data.statementData;

                })
                .catch(err => {
                if (err.response.status == 422) {
                    this.errors = err.response.data.errors;
                    console.log("Error!");
                }
                });
            }
        },

        components: {
            headerComponent,
            footerComponent
        },
        mounted() {}
        };
</script>
<style scoped>
</style>