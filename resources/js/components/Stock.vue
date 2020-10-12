<template>
    <div>
        <headerComponent></headerComponent>
        <div class="content-wrapper height-wrap">
            <div class="content">
                <div class="container-fluid">
                    <div class="container">

                        <div class="row mt-5" id="printMe">
                            <div class="col-md-8" style="float:left;">
                                <div class="card">
                                    <div class="card-header" style="text-align:center;">
                                        <h3 class="card-title">Prothoma Publications</h3>
                                        <p>43-44 Aziz Co-op Super Market, Shahbag, Dhaka - 1000</p>
                                        <h4>Stock Report</h4>
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
                                                    <th>Available Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="stock in stocktList" :key="stock.id">
                                                    <td>{{ stock.id }}</td>
                                                    <td>{{ stock.isbn }}</td>
                                                    <td>{{ stock.book_name }}</td>
                                                    <td>{{ stock.author }}</td>
                                                    <td>{{ stock.available_quantity }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>


                            <div class="col-md-4" style="float:right;">
                                <div class="card">
                                    <div class="card-header" style="text-align:center;">
                                        <h3 class="card-title">Prothoma Publications</h3>
                                        <h4>Summary</h4>
                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Total Price</th>
                                                    <td>{{ totalAvailablePrice }} Tk.</td>
                                                </tr>

                                                <tr>
                                                    <th>Total Quantity</th>
                                                    <td>{{ totalq }}</td>
                                                </tr>

                                            </thead>

                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>

                        </div>

                        <div class="card-header">
                            <button class="btn btn-success" @click="download" style="float:right;">Download PDF</button>
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
                stocktList: [],
                totalq:'',
                totalAvailablePrice:'',

            }
        },
        created(){

        },

        computed:{


        },

        methods:{
            viewStockDetails() {
                axios.get("/getStockDetails").then(response => {
                    this.stocktList = response.data.data;
                    this.totalq = response.data.totalQty;
                    this.totalAvailablePrice = response.data.totalAvailable;
                    // console.log(response.data.totalQty)
                });
            },

            download(){
                this.$htmlToPaper('printMe');
            },

        },

        components: {
            headerComponent,
            footerComponent
        },
        mounted() {
            this.viewStockDetails();
        }
    };

</script>
<style scoped>



</style>
