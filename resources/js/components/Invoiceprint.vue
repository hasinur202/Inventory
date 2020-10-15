<template>
    <div>
        <headerComponent></headerComponent>
        <div class="content-wrapper height-wrap">
            <div class="content">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-md-12" id="printMe">
                                <div class="card" >

                                    <div class="card-header" style="padding-bottom:0px">
                                        <div class="col-md-3" style="float:left;">
                                            <img style="height:75px; width:75px; margin-left:6.5rem;" class="img-style" :src="`/images/${settingData.logo}`"/>
                                        </div>

                                        <div class="col-md-6" style="float:left;">

                                            <h3 style="text-align:center;" class="card-title">{{ settingData.title }}</h3>
                                            <p style="text-align:center;margin-bottom:5px;">{{ settingData.address }}<br>{{ settingData.mobile }}</p>

                                        </div>
                                        <div class="col-md-3" style="float:right;">
                                            <span style="float:left; margin-top:3.5rem;"><b>Invoice #</b> : {{ lastInvoice.invoice_ref }}</span>
                                        </div>

                                        <!-- <div class="col-md-6" style="float:left;">
                                            <h3 style="text-align:center;" class="card-title">সন্ধিপাঠ লাইব্রেরি</h3>
                                            <p style="text-align:center;margin-bottom:5px;">১৪ পূর্ব শেওড়াপাড়া, মিরপুর,ঢাকা-১২১৬ <br>০১৮৬০৭২২৭২২</p>

                                        </div> -->

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <table>
                                                    <tr>
                                                        <th>Customer Name :</th>
                                                        <td>{{ lastInvoice.cus_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone :</th>
                                                        <td>{{ lastInvoice.phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email :</th>
                                                        <td>{{ lastInvoice.email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address :</th>
                                                        <td>{{ lastInvoice.address }}</td>
                                                    </tr>
                                                </table>

                                            </div>

                                            <!-- /.col -->
                                            <div class="card-header col-md-8">
                                                <h5 class="invoice_title">Invoice Summary</h5>
                                                <div class="col-md-6 mytable" style="float:left;">
                                                    <table>
                                                    <tr>
                                                        <th>Total Quantity</th>
                                                        <td>:</td>
                                                        <td style="padding-left:20px;">{{ totalQty }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Price</th>
                                                        <td>:</td>
                                                        <td style="padding-left:20px;">{{ lastInvoice.total_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Discount</th>
                                                        <td>:</td>
                                                        <td style="padding-left:20px;">{{ lastInvoice.total_discount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pay Mode</th>
                                                        <td>:</td>
                                                        <td style="padding-left:20px;">{{ lastInvoice.pay_mode }}</td>
                                                    </tr>
                                                </table>


                                                </div>

                                                <div class="col-md-6 mytable" style="float:left;">
                                                    <table>
                                                    <tr>
                                                        <th>Receivable</th>
                                                        <td>:</td>
                                                        <td style="padding-left:20px;">{{ lastInvoice.total_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Net Receivable</th>
                                                        <td>:</td>
                                                        <td style="padding-left:20px;">{{ lastInvoice.total_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Receivable</th>
                                                        <td>:</td>
                                                        <td style="padding-left:20px;">{{ lastInvoice.total_price }}</td>
                                                    </tr>
                                                </table>

                                                </div>
                                            </div>
                    <!-- /.col -->
                                    </div>


                                    <h3 class="card-title" style="margin-bottom:0px !important;">Invoice Items:</h3>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead style="line-height:10px;">
                                                <tr>
                                                    <th>ISBN/Code</th>
                                                    <th>Title</th>
                                                    <th>Copies</th>
                                                    <th>Unit Price</th>
                                                    <th>Sales Price</th>
                                                    <th>Total Price</th>
                                                    <th>Discount</th>
                                                </tr>
                                            </thead>
                                            <tbody style="line-height:10px;">
                                                <tr v-for="latestItem in lastInvoiceDetails" :key="latestItem.id">
                                                    <td>{{ latestItem.book.isbn }}</td>
                                                    <td>{{ latestItem.book.book_name }}</td>
                                                    <td>{{ latestItem.qty }}</td>
                                                    <td>{{ latestItem.unit_price }}</td>
                                                    <td>{{ latestItem.unit_price }}</td>
                                                    <td>{{ latestItem.total_price }}</td>
                                                    <td>{{ latestItem.total_dis }}</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                      </div>
                                    <!-- /.card-body -->

                                </div>

                                <!-- /.card -->
                            </div>
                                <div class="card-header" style="width:100%">
                                    <button style="float:right;" class="btn btn-info" @click="download">Print/Download PDF</button>
                                    <button style="float:left;" @click="salesMore" class="btn btn-primary">Go to Sales</button>
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
  name: "Sales",

  data(){
        return{
            lastInvoice:'',
            lastInvoiceDetails:'',
            totalQty:'',
            dataList:'',
            settingData:{
                logo:"",
                mobile:"",
                address:"",
                title:"",
            },

        }
    },

    created() {
        // axios.get("/getLatestInvoiceDetai").then(response => {
        //     this.lastInvoice = response.data.data;
        //     this.lastInvoiceDetails = response.data2.data;
        //     // console.log(response.data.data)
        // });
    },


    methods:{
        salesMore(){

            this.$router.push('sales');
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
      console.log('Component mounted.');
      axios.get("/getLatestInvoiceDetails").then(response => {
            this.lastInvoice = response.data.data;
            this.totalQty = response.data.totalqty;
            this.lastInvoiceDetails = response.data.data2;
        });

    this.viewSettingsData();
  },

};
</script>




<style scoped>


.invoice_title{
    text-align: center;
    font-weight: bold;
    margin-bottom: 10px;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
}

</style>
