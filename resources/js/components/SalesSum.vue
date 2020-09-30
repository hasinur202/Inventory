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
                                        <h3 class="card-title">Sales Summary</h3>
                                        <div class="card-tools">
                                            <button v-on:click="isHidden = !isHidden" class="btn btn-success">
                                                <i class="fas fa-eye fa-fw"></i> Show Report
                                            </button>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-6" style="float:left;">
                                            <div class="form-group">
                                                <label>Beginning Date</label>
                                                <input type="date" name="bday" max="3000-12-31"
                                                    min="1000-01-01" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="float:right;">
                                            <div class="form-group">
                                                <label >Ending Date</label>
                                                <input type="date" name="bday" min="1000-01-01"
                                                    max="3000-12-31" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                <div v-if="!isHidden" class="card">
                                    <div class="card-header" style="text-align:center;">
                                        <h3 class="card-title">Prothoma Publications</h3>
                                        <p>43-44 Aziz Co-op Super Market, Shahbag, Dhaka - 1000</p>
                                        <h4>Sales Summary: 17-05-2020 to 20-05-2020</h4>

                                </div>


                             <div class="col-md-10" style="margin:auto">
                                <div class="card-header">
                                    <h3 class="card-title">Consignment:</h3>
                                    <div class="card-tools">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                                    </ul>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table">
                                    <tbody><tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th style="width: 40px">Amount</th>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td>Books Purchased</td>
                                        <td><span class="badge bg-primary">0</span></td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Total Purchased Value</td>
                                        <td><span class="badge bg-primary">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Paid To Supplier:</td>
                                        <td><span class="badge bg-primary">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Credit To Supplier:</td>
                                        <td><span class="badge bg-primary">0.00</span></td>
                                    </tr>
                                    </tbody></table>
                                </div>
              <!-- /.card-body -->
                             </div>

                             <div class="col-md-10" style="margin:auto">
                                <div class="card-header">
                                    <h3 class="card-title">Sales:</h3>
                                    <div class="card-tools">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                                    </ul>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table">
                                    <tbody><tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th style="width: 40px">Amount</th>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td>Books Sold:</td>
                                        <td><span class="badge bg-info">0</span></td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Gross Sales</td>
                                        <td><span class="badge bg-info">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Discount:</td>
                                        <td><span class="badge bg-info">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Net Sales:</td>
                                        <td><span class="badge bg-info">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Credit to Customer:</td>
                                        <td><span class="badge bg-info">0.00</span></td>
                                    </tr>
                                    </tbody></table>
                                </div>
              <!-- /.card-body -->
                             </div>


                             <div class="col-md-10" style="margin:auto">
                                <div class="card-header">
                                    <h3 class="card-title">Overview:</h3>
                                    <div class="card-tools">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                                    </ul>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table">
                                    <tbody>

                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th style="width: 40px">Amount</th>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td><strong>Outstanding Received</strong></td>
                                        <td><span class="badge bg-success">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td><strong>Outstanding Paid</strong></td>
                                        <td><span class="badge bg-success">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td><strong>Other Received</strong></td>
                                        <td><span class="badge bg-success">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td><strong>Other Paid</strong></td>
                                        <td><span class="badge bg-success">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td><strong>Sales Return Cash</strong></td>
                                        <td><span class="badge bg-success">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td><strong>Total Cash Received</strong></td>
                                        <td><span class="badge bg-success">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td><strong>Total Cash Paid</strong></td>
                                        <td><span class="badge bg-success">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td><strong>Net Cash Received</strong></td>
                                        <td><span class="badge bg-success">0.00</span></td>
                                    </tr>

                                    </tbody></table>
                                </div>
              <!-- /.card-body -->
                             </div>



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

        data(){
            return{
                isHidden: true
            }
        },
        created(){

        },

        computed:{


        },

        methods:{



        },

        components: {
            headerComponent,
            footerComponent
        },
        mounted() {

        }
    };

</script>
<style scoped>



</style>
