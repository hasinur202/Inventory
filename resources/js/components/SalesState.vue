<template>
    <div>
        <headerComponent></headerComponent>
        <div class="content-wrapper height-wrap">
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

                                <div v-if="!isHidden" class="card" >
                                    <!-- <div class="card-tools" style="background: #4AA0E6">
                                            <button class="btn btn-success" @click="download" style="float:right;">Download PDF</button>
                                    </div> -->
                                    <div id="printMe">
                                        <div class="card-header" style="text-align:center;">
                                            <h3 class="card-title">{{ settingData.title }}</h3>
                                            <p>{{ settingData.address }} <br>Contact: {{ settingData.mobile }}</p>
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
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card-header">
                                        <button class="btn btn-success" @click="download" style="float:right;">Download PDF</button>
                                    </div>
                                    <!-- /.card-body -->
                                    <!-- <div class="col-md-6 card" style="margin:auto">

                                    </div> -->
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
                output:null,
                isHidden: true,
                errors: {},
                formData: {
                    toDate: "",
                    fromDate: "",
                    fixedDate: ""
                },
                statementData:[],

                dataList:'',
                settingData:{
                    logo:"",
                    mobile:"",
                    address:"",
                    title:"",
                },

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
            },

            download(){
                this.$htmlToPaper('printMe');
            },

             viewSettingsData(){
                axios.get('/getSettingData')
                    .then((response)=>{
                        this.dataList = response.data.data;

                        this.dataList.forEach(el => {
                            this.settingData.title = el.title;
                            this.settingData.mobile = el.mobile;
                            this.settingData.address = el.address;
                            this.settingData.logo = el.logo;

                        });
                    })
            },





        },

        components: {
            headerComponent,
            footerComponent
        },
        mounted() {
            this. viewSettingsData();
        }
        };
</script>
<style scoped>
</style>
