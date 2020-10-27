<template>
    <div>
        <headerComponent></headerComponent>
        <div class="content-wrapper height-wrap">
            <div class="content">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row mt-5">

                            <div class="col-md-12" style="float:left;">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Invoice History</h3>
                                        <div class="card-tools">
                                            <input class="form-control" v-model="searchQuery" placeholder="Search" type="text">
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Invoice Ref#</th>
                                                    <th>Invoice Date</th>
                                                    <th>Customer Name</th>
                                                    <th>Total Price</th>
                                                    <th>Pay Mode</th>
                                                    <th>Modify</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="invoice, key in temp">
                                                    <td>{{ invoice.invoice_ref }}</td>
                                                    <td>{{ invoice.created_at | formatDate }}</td>
                                                    <td>{{ invoice.cus_name }}</td>
                                                    <td>{{ invoice.total_price }}</td>
                                                    <td>{{ invoice.pay_mode }}</td>
                                                    <td>
                                                         <button v-if="invoice.pay_mode == 'Due' && invoice.status == 1" @click="addInventoryByid(invoice)"
                                                            class="btn btn-primary btn-sm">
                                                            Add to Inventory
                                                        </button>
                                                        <button @click="invoiceByid(invoice)" data-toggle="modal" data-target="#editInvoice"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </button>

                                                        <button @click="deleteSalesHistory(invoice)"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                        <!-- <a href="#">
                                                           <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                        </a> -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>


                        <div class="modal fade" id="editInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <!-- /.card-header -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addNewLabel">Edit Invoice</h5>
                                    </div>
                                        <div class="modal-body">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ISBN/Code</th>
                                                        <th>Title</th>
                                                        <th>Copies</th>
                                                        <th>Unit Price</th>
                                                        <th>Sales Price</th>
                                                        <th>Total Price</th>
                                                        <th>Discount</th>
                                                        <th>Modify</th>
                                                    </tr>
                                                </thead>
                                                <tbody v-for="(item, index) in invoiceDetails" :key="index">

                                                    <tr>
                                                        <td>{{ item.book.isbn }}</td>
                                                        <td>{{ item.book.book_name }}</td>
                                                        <td>{{ item.qty }}</td>
                                                        <td>{{ item.unit_price }} Tk.</td>
                                                        <td>{{ item.unit_price }} Tk.</td>
                                                        <td>{{ item.total_price }} Tk.</td>
                                                        <td>{{ item.total_dis }} Tk.</td>
                                                        <td>
                                                            <button @click="showEditModal(item)"
                                                                class="float-left btn btn-primary btn-sm"><i
                                                                    class="fa fa-edit"></i></button>
                                                            <button @click="deleteSingleDetails(item.id)"
                                                                class="float-left btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!--- end col md-12 -->


                        </div>

                    </div>
                </div>
            </div>
        </div>
        <footerComponent></footerComponent>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <!-- /.card-header -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">Edit Invoice</h5>
                    </div>
                    <form @submit.prevent="updateIvoiceSingleDetails">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div style="width:48%; float: left;">
                                    <div class="form-group">
                                        <input v-model="editDetails.book.isbn" readonly type="text"
                                            class="form-control">
                                    </div>
                                </div>

                                <div style="width:48%; float: right;">
                                    <div class="form-group">
                                        <input v-model="editDetails.consign_ref" readonly type="text"
                                            class="form-control">
                                    </div>
                                </div>

                                <div>
                                    <div class="form-group">
                                        <input v-model="editDetails.book.book_name" readonly type="text"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding-left:0px !important; float:left">
                                    <div class="form-group">
                                        <label>Publishers Price</label>
                                        <input v-model="editDetails.pub_price" readonly type="text"
                                            class="form-control">
                                    </div>

                                    <div style="width:48%; float: left;">
                                        <div class="form-group">
                                            <label>Balance</label>
                                            <input v-model="editDetails.book.available_quantity" readonly type="text"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div style="width:48%; float: right;">
                                        <div class="form-group">
                                            <label>Copies</label>
                                            <input v-model="editDetails.qty" @keyup="costBd" type="number"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Discount [%]</label>
                                        <input v-model="editDetails.discount_p" @keyup="costBd" type="text"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6" style="padding-right:0px !important; float:left;">
                                    <div style="width:48%; float: left;">
                                        <div class="form-group">
                                            <label>Rate</label>
                                            <input v-model="editDetails.rate" @keyup="costBd" type="text"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div style="width:48%; float: right;">
                                        <div class="form-group">
                                            <label>Unit Price</label>
                                            <input readonly v-model="editDetails.unit_price" type="text"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Total Price</label>
                                        <input readonly v-model="editDetails.total_price" type="text"
                                            class="form-control">
                                        <input hidden v-model="editDetails.cost_price" type="text" class="form-control">
                                        <input hidden v-model="editDetails.total_costprice" type="text" class="form-control">
                                    </div>
                                    <div style="width:48%; float: left;">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input v-model="editDetails.discount" @keyup="costBd" type="text"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div style="width:48%; float: right;">
                                        <div>
                                            <label>Total Discount (TK)</label>
                                            <input v-model="editDetails.total_dis" readonly type="text"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    >Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--- end col md-12 -->

    </div>
</template>

<script>
    import headerComponent from "./header";
    import footerComponent from "./footer";

    export default {
        name: "Sales-history",
        data() {
            return {
                invoiceList: [],
                invoiceDetails: [],
                searchQuery:'',
                temp:[],
                editDetails: {
                    'book': {
                        'book_name': '', 'isbn':'', 'available_quantity':'',
                    },
                    'qty': '',
                    'consign_ref': '',
                    'pub_price': '',
                    'cost_price':'',
                    'unit_price': '',
                    'discount_p': '',
                    'rate': '',
                    'total_price': '',
                    'total_costprice':'',
                    'discount': '',
                },
            };
        },

        watch:{
            searchQuery(){
                if(this.searchQuery.length > 0){
                    this.temp = this.invoiceList.filter((invoice) => {
                        return Object.keys(invoice).some((key)=>{
                            let string = String(invoice[key])
                            return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
                        })
                    });
                }else{
                    this.temp = this.invoiceList
                }
            }
        },


        methods: {

            deleteSalesHistory(invoice){
                axios
                .post(`/deleteSalesById/`,invoice)
                .then(response => {
                    this.viewInvoice();
                    if(response.data.message){
                        Toast.fire({
                            icon: "warning",
                            title: "Invoice Details Delete First"
                        });
                    }else{
                        Toast.fire({
                            icon: "success",
                            title: "Deleted Successfully"
                        });
                    }
                });
            },

            showEditModal(item) {
                this.editDetails = item;
                console.log(item);
                $("#exampleModal").modal("toggle");
            },

            viewInvoice() {
                axios.get("/getInvoices").then(response => {
                    this.invoiceList = response.data.data;
                    this.temp = response.data.data;
                });
            },

            invoiceByid(invoice) {
                // console.log(consignment.consign_ref)
                axios.get(`/getInvoiceId?id=${invoice.id}`).then(response => {
                    this.invoiceDetails = response.data;

                });
            },

            addInventoryByid(invoice){
                axios.post(`/storeCusInventory?id=${invoice.id}`).then(response => {
                    this.viewInvoice();
                    Toast.fire({
                        icon: 'success',
                        title: 'Added Successfully'
                    })
                });
            },

            deleteSingleDetails(id) {
                axios.post(`/delete-invoice`, {
                    id: id
                }).then(response => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Invoice Item Deleted Successfully'
                    })
                });
            },

            updateIvoiceSingleDetails() {
                if(this.editDetails.qty <= 0){
                    Toast.fire({
                        icon: 'warning',
                        title: 'Does not exist 0. You can delete this item from item-list'
                    })
                }else{
                    let balance = this.editDetails.book.available_quantity+this.editDetails.qty;
                    if(balance < this.editDetails.qty){
                        Toast.fire({
                            icon: 'warning',
                            title: 'Your required Qty is not available in Stock!'
                        })
                    }else{
                        axios
                            .post(`/update-invoice-details`, this.editDetails)
                            .then(response => {
                            this.viewInvoice();
                            Toast.fire({
                                icon: 'success',
                                title: 'Item Updated Successfully'
                            })
                        });
                    }
                }
            },

            pub_price: function (event) {
                this.editDetails.pub_price = event.target.value;
            },
            cost_price: function (event) {
                this.editDetails.cost_price = event.target.value;
            },
            rate: function (event) {
                this.editDetails.rate = event.target.value;
            },
            discount_p: function (event) {
                this.editDetails.discount_p = event.target.value;
            },
            discount: function (event) {
                this.editDetails.discount = event.target.value;
            },
            copies: function (event) {
                this.editDetails.qty = event.target.value;
            },

            costBd(){
                if(parseInt(this.editDetails.qty) > 0){
                    this.editDetails.total_costprice = parseFloat(this.editDetails.cost_price)*parseInt(this.editDetails.qty);
                }

                if(parseFloat(this.editDetails.pub_price) > 0 && parseFloat(this.editDetails.rate) > 0){
                    this.editDetails.unit_price = (parseFloat(this.editDetails.pub_price) * parseFloat(this.editDetails.rate))
                }

                if(parseFloat(this.editDetails.pub_price) > 0 && parseFloat(this.editDetails.rate) > 0 && parseInt(this.editDetails.qty) > 0){
                    this.editDetails.total_price = (parseFloat(this.editDetails.rate) * parseFloat(this.editDetails.pub_price) * parseInt(this.editDetails.qty))
                    var total_dis1 = parseFloat(this.editDetails.pub_price) * parseInt(this.editDetails.qty);

                    this.editDetails.total_dis = total_dis1 - this.editDetails.total_price;

                    if(parseFloat(this.editDetails.discount) > 0){
                            this.editDetails.total_dis = this.editDetails.total_dis + parseFloat(this.editDetails.discount);
                            this.editDetails.total_price = parseFloat(this.editDetails.total_price) - parseFloat(this.editDetails.discount);
                        }
                }

                if(parseFloat(this.editDetails.discount_p) > 0){
                    if(parseFloat(this.editDetails.pub_price) > 0 && parseInt(this.editDetails.qty) > 0){
                        var uunit_price = parseFloat(this.editDetails.pub_price);
                        var b_unit_price = ((parseFloat(this.editDetails.pub_price) * parseFloat(this.editDetails.discount_p))/100);
                        var most_unit = uunit_price - b_unit_price;

                        this.editDetails.total_dis = b_unit_price * parseInt(this.editDetails.qty);
                        this.editDetails.unit_price = most_unit;
                        this.editDetails.total_price = most_unit * parseInt(this.editDetails.qty);

                        if(parseFloat(this.editDetails.discount) > 0){
                            this.editDetails.total_dis = this.editDetails.total_dis + parseFloat(this.editDetails.discount);

                            this.editDetails.total_price = parseFloat(this.editDetails.total_price) - parseFloat(this.editDetails.discount);
                        }
                    }
                }

            },
        },

        components: {
            headerComponent,
            footerComponent
        },

        mounted() {
            this.viewInvoice();
        }
    };

</script>
