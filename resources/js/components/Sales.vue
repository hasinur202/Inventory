<template>
    <div>
        <headerComponent></headerComponent>
        <div class="content-wrapper height-wrap">
            <div class="content">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="card">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Customer Information</h3>
                                            <div class="card-tools">
                                                <input
                                                    v-model="dataArray.invoice_ref"
                                                    type="text"
                                                    placeholder="Invoice. Ref#"
                                                    class="form-control"
                                                    style="width: 25.5rem;" readonly
                                                />
                                            </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input v-model="dataArray.cus_name" name="cus_name" required type="text" placeholder="Customer Name *" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <input v-model="dataArray.phone" name="phone" type="text" placeholder="Phone" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <input v-model="dataArray.email" type="text" name="email" placeholder="Email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <textarea v-model="dataArray.address" type="text" name="summary" placeholder="Address" class="form-control"></textarea>
                                                </div>

                                            </div>

                                            <!-- /.col -->
                                            <div class="card-header col-md-8">
                                                <h5 class="invoice_title">Invoice Summary</h5>
                                                <div class="col-md-6 mytable" style="float:left;">
                                                    <div class="row">
                                                        <div class="col-md-5" style="padding-left:0">
                                                            <label>Total Quantity :</label>
                                                        </div>
                                                        <div class="col-md-7" style="padding-left:0">
                                                            <input v-model="dataArray.total_qty" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5" style="padding-left:0">
                                                            <label>Total Price :</label>
                                                        </div>
                                                        <div class="col-md-7" style="padding-left:0">
                                                            <input v-model="dataArray.total_price" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5" style="padding-left:0">
                                                            <label>Total Discount :</label>
                                                        </div>
                                                        <div class="col-md-7" style="padding-left:0">
                                                            <input v-model="dataArray.total_discount" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5" style="padding-left:0">
                                                            <label>Pay Mode :</label>
                                                        </div>
                                                        <div class="col-md-7" style="padding-left:0;">
                                                                <select v-model="dataArray.pay_mode" id="type" style="width:97%;">
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="Cheque">Cheque</option></option>
                                                                    <option value="Card">Card</option>
                                                                    <option value="Due">Credit to Customer</option>
                                                                </select>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mytable" style="float:left;">
                                                    <div class="row">
                                                        <div class="col-md-5" style="padding-left:0">
                                                            <label>Receivable :</label>
                                                        </div>
                                                        <div class="col-md-7" style="padding-left:0">
                                                            <input v-model="dataArray.receivable" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5" style="padding-left:0">
                                                            <label>Net Receivable :</label>
                                                        </div>
                                                        <div class="col-md-7" style="padding-left:0">
                                                            <input v-model="dataArray.net_receivable" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5" style="padding-left:0">
                                                            <label>Total Receivable :</label>
                                                        </div>
                                                        <div class="col-md-7" style="padding-left:0">
                                                            <input v-model="dataArray.total_receivable" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12" style="float:right;">
                                                    <button @click.prevent="invoiceStore()" class="btn btn-info" style="float:right;">Save</button>
                                                    <button @click.prevent="cleanInvoice()" class="btn btn-danger" style="float:right; margin-right:10px;">Cancel</button>
                                                </div>
                                            </div>
                    <!-- /.col -->
                                    </div>
                                </div>


                            </div>


                                    <div class="card-header">
                                        <h3 class="card-title">Invoice Items</h3>
                                        <div class="card-tools">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"><i
                                                    class="fas fa-user-plus fa-fw"></i> Add Item</button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
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
                                            <tbody v-for="(item, index) in dataArray.details" :key="index">

                                                <tr>
                                                    <td>{{ item.isbn }}</td>
                                                    <td>{{ item.book_name }}</td>
                                                    <td>{{ item.copies }}</td>
                                                    <td>{{ item.unit_price }} Tk.</td>
                                                    <td>{{ item.unit_price }} Tk.</td>
                                                    <td>{{ item.total_price }} Tk.</td>
                                                    <td>{{ item.total_dis }} Tk.</td>
                                                    <td>

                                                        <button @click="deleteItem(index)" class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash"></i></button>
                                                        <button data-toggle="modal" data-target="#itemEdit" @click="editItem(item,index)" class="btn btn-primary btn-sm"><i
                                                                    class="fa fa-edit"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

                                </div>
                                <!-- /.card -->
                            </div>
                        </div>


<!-- Add New -->
                        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="padding-bottom:5px !important;">
                                        <h5 class="modal-title" id="addNewLabel">Add Invoice</h5>

                                        <div style="margin-left:6rem;">
                                            <div class="form-group" style="float:left; margin-bottom:0 !important;">
                                                <input
                                                @keyup.prevent="searchVal()"
                                                v-model="detailsFormData.isbn"
                                                type="text" placeholder="Search ISBN" class="form-control" style="width: 25.5rem;">
                                                <span
                                                class="text-danger"
                                                v-if="errors.hasOwnProperty('isbn')"
                                                >{{errors.isbn[0]}}</span>


                                                <ul v-show="getSearchValue" class="ulstyle">
                                                    <li v-for="val in allUniqueIsbn" :key="val.isbn">
                                                        <p @click.prevent="getVal(val)">{{ val.isbn }}</p>
                                                    </li>
                                                </ul>

                                                <!-- https://laracasts.com/discuss/channels/vue/unique-list-values -->
                                            </div>
                                        </div>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <select @change="getConsignmentData" v-model="selected_consign_ref" id="type" class="form-control">
                                                    <option v-for="(item, index) in allConsignRef" :key="index">{{ item.consign_ref }} </option>
                                                </select>
                                            </div>

                                            <div>
                                                <div class="form-group">
                                                    <input  v-model="detailsFormData.book_name" readonly type="text" placeholder="Select Book by ISBN "
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6" style="padding-left:0px !important; float:left">
                                                <div class="form-group">
                                                    <label>Publishers Price</label>
                                                    <input v-model="detailsFormData.pub_price" readonly type="text" placeholder="Publishers Price"
                                                        class="form-control">
                                                </div>

                                                <div style="width:48%; float: left;">
                                                    <div class="form-group">
                                                        <label>Balance</label>
                                                        <input  v-model="detailsFormData.balance" readonly type="text" placeholder="Available in Stock"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div style="width:48%; float: right;">
                                                    <div class="form-group">
                                                        <label>Copies</label>
                                                        <input v-model="detailsFormData.copies" @keyup="costBd" type="number" placeholder="Rate"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Discount [%]</label>
                                                    <input  v-model="detailsFormData.discount_p" @keyup="costBd" type="text" placeholder="Discount in %"
                                                        class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-6" style="padding-right:0px !important; float:left;">
                                                <div style="width:48%; float: left;">
                                                    <div class="form-group">
                                                        <label>Rate</label>
                                                        <input  v-model="detailsFormData.rate" @keyup="costBd" type="text" placeholder="Rate"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div style="width:48%; float: right;">
                                                    <div class="form-group">
                                                        <label>Unit Price</label>
                                                        <input readonly v-model="detailsFormData.unit_price" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Total Price</label>
                                                    <input readonly v-model="detailsFormData.total_price" type="text" class="form-control">
                                                </div>
                                                <div style="width:48%; float: left;">
                                                    <div class="form-group">
                                                        <label>Discount</label>
                                                        <input  v-model="detailsFormData.discount" @keyup="costBd" type="text" placeholder="Discount in TK"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div style="width:48%; float: right;">
                                                    <div>
                                                        <label>Total Discount (TK)</label>
                                                        <input v-model="detailsFormData.total_dis" readonly type="text" class="form-control">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" @click="createInvoice" class="btn btn-primary">Create</button>
                                        </div>
                                    </div>
                                </div>
                                <!--- end col md-12 -->
                            </div>
                        </div>


<!-- Edit Item -->
                        <div class="modal fade" id="itemEdit" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="padding-bottom:5px !important;">
                                        <h5 class="modal-title" id="addNewLabel">Edit Invoice</h5>

                                        <div style="margin-left:6rem;">
                                            <div class="form-group" style="float:left; margin-bottom:0 !important;">
                                                <input
                                                v-model="editingData.isbn"
                                                type="text" placeholder="Search ISBN" class="form-control" style="width: 25.5rem;">
                                            </div>
                                        </div>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="form-group">
                                                    <input  v-model="editingData.consign_ref" readonly type="text" placeholder="Select Batch by ISBN "
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div>
                                                <div class="form-group">
                                                    <input  v-model="editingData.book_name" readonly type="text" placeholder="Select Book by ISBN "
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6" style="padding-left:0px !important; float:left">
                                                <div class="form-group">
                                                    <label>Publishers Price</label>
                                                    <input v-model="editingData.pub_price" readonly type="text" placeholder="Publishers Price"
                                                        class="form-control">
                                                </div>

                                                <div style="width:48%; float: left;">
                                                    <div class="form-group">
                                                        <label>Balance</label>
                                                        <input  v-model="editingData.balance" readonly type="text" placeholder="Available in Stock"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div style="width:48%; float: right;">
                                                    <div class="form-group">
                                                        <label>Copies</label>
                                                        <input v-model="editingData.copies" @keyup="costBd" type="number" placeholder="Rate"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Discount [%]</label>
                                                    <input  v-model="editingData.discount_p" @keyup="costBd" type="text" placeholder="Discount in %"
                                                        class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-6" style="padding-right:0px !important; float:left;">
                                                <div style="width:48%; float: left;">
                                                    <div class="form-group">
                                                        <label>Rate</label>
                                                        <input  v-model="editingData.rate" @keyup="costBd" type="text" placeholder="Rate"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div style="width:48%; float: right;">
                                                    <div class="form-group">
                                                        <label>Unit Price</label>
                                                        <input readonly v-model="editingData.unit_price" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Total Price</label>
                                                    <input readonly v-model="editingData.total_price" type="text" class="form-control">
                                                </div>
                                                <div style="width:48%; float: left;">
                                                    <div class="form-group">
                                                        <label>Discount</label>
                                                        <input  v-model="editingData.discount" @keyup="costBd" type="text" placeholder="Discount in TK"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div style="width:48%; float: right;">
                                                    <div>
                                                        <label>Total Discount (TK)</label>
                                                        <input v-model="editingData.total_dis" readonly type="text" class="form-control">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" @click="createEditInvoice" class="btn btn-primary">Create</button>
                                        </div>
                                    </div>
                                </div>
                                <!--- end col md-12 -->
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
import moment from 'moment'
export default {
  name: "Sales",



  data(){
        return{
            errors: {},
            batchList:[],
            allConsignRef:[],
            editingIndex:0,
            getSearchValue: false,
            getSearchSupp: false,
            allBook:[],
            selected_consign_ref: '',
            allUniqueIsbn:[],
            selected_isbn : '',
            detailsFormData: {
                book_id: "",
                isbn: "",
                book_name: "",
                consign_ref: [],
                pub_price: "",
                balance: "",
                copies: "1",
                rate: "",
                unit_price: "0",
                total_price: "0",
                discount:"",
                discount_p:"",
                total_dis:'0',
            },
            dataArray: {
                cus_name:"",
                email:"",
                phone:"",
                address:"",
                invoice_ref: "",
                total_price: "0",
                total_discount:"0",
                pay_mode:"Cash",
                total_qty: "0",
                receivable:"0",
                net_receivable:"0",
                total_receivable:"0",
                details: [],
            },
            editingData : {
                book_id: "",
                consign_ref: "",
                pub_price: "",
                balance: "",
                copies: "1",
                rate: "",
                unit_price: "0",
                isbn: "",
                book_name: "",
                total_price: "0",
                discount:"",
                discount_p:"",
                total_dis:'0',
            },
        }
    },

    created() {
        axios.get("/getDetailsForInvoice").then(response => {
            this.allBook = response.data.data;
            // console.log(response.data.data)
        });

        axios.get("/uniqueConsignIsbn").then(response =>{
            this.allUniqueIsbn = response.data.data;
            // console.log(this.allUniqueIsbn)
        });
    },

    computed:{
        filterd() {
            return this.allBook.filter(val =>
                val.book.isbn.startsWith(this.detailsFormData.isbn)
            );
        },

        filterdUnique() {
            return this.allUniqueIsbn.filter(val =>
                val.book.isbn.startsWith(this.detailsFormData.isbn)
            );
        },

        unique () {
            return function (arr, key) {
                var output = []
                var usedKeys = {}
                for (var i = 0; i < arr.length; i++) {
                if (!usedKeys[arr[i][key]]) {
                    usedKeys[arr[i][key]] = true
                    output.push(arr[i])
                }
                }
                return output
            }
            }


    },

    methods:{
        getConsignmentData(){
            axios.get('get-consignment-data?consign_ref='+this.selected_consign_ref+'&isbn='+this.selected_isbn)
            .then(response=>{
                this.detailsFormData = response.data
            })
        },
        createEditInvoice(){
            if(this.editingData.balance >= 1){
                this.dataArray.details[this.editingIndex]= this.editingData;
            }else{
                Toast.fire({
                    icon: 'danger',
                    title: 'Stock Empty'
                })
            }

            this.dataArray.total_price = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(acc) + parseFloat(curr.total_price)
            }, 0);

            this.dataArray.receivable = this.dataArray.total_price;
            this.dataArray.total_receivable = this.dataArray.total_price;
            this.dataArray.net_receivable = this.dataArray.total_price;

            this.dataArray.total_qty = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(acc) + parseFloat(curr.copies)
            }, 0);

            this.dataArray.total_discount = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(acc) + parseFloat(curr.total_dis)
            }, 0);
        },



        deleteItem(index) {
            this.dataArray.details.splice(index,1);

            this.dataArray.total_price = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(curr.total_price) - parseFloat(acc)
            }, 0);

            this.dataArray.receivable = this.dataArray.total_price;
            this.dataArray.total_receivable = this.dataArray.total_price;
            this.dataArray.net_receivable = this.dataArray.total_price;

            this.dataArray.total_qty = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(curr.copies) - parseFloat(acc)
            }, 0);

            this.dataArray.total_discount = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(curr.total_dis) - parseFloat(acc)
            }, 0);


        },

        editItem(item, index) {
            this.editingIndex = index;
            this.editingData = item;

        },

        invoiceStore(){
            if(this.dataArray.cus_name == ""){
                Toast.fire({
                    icon: 'danger',
                    title: 'Customer name must not be empty!'
                })
            }else{
                axios.post("/storeInvoice", this.dataArray).then(() => {
                    this.getInvoiceRef();
                    this.$router.push('invoiceprint');
                    this.dataArray = {
                    cus_name:"",
                    email:"",
                    phone:"",
                    address:"",
                    invoice_ref: "",
                    total_price: "0",
                    total_discount:"0",
                    pay_mode:"Cash",
                    total_qty: "0",
                    receivable:"0",
                    net_receivable:"0",
                    total_receivable:"0",
                    details: [],
                };
                    Toast.fire({
                        icon: 'success',
                        title: 'Invoice Saved Successfully'
                    })
                });
            }

        },

        cleanInvoice(){
            this.dataArray = {
                cus_name:"",
                email:"",
                phone:"",
                address:"",
                invoice_ref: "",
                total_price: "0",
                total_discount:"0",
                pay_mode:"Cash",
                total_qty: "0",
                receivable:"0",
                net_receivable:"0",
                total_receivable:"0",
                details: [],
            };
        },
        createInvoice() {
            if(this.detailsFormData.balance >= 1){
                    this.dataArray.details.push(this.detailsFormData);
                    this.detailsFormData = {
                    book_id: "",
                    consign_ref: "",
                    pub_price: "",
                    balance: "",
                    copies: "1",
                    rate: "0.8",
                    unit_price: "0",
                    isbn: "",
                    book_name: "",
                    total_price: "0",
                    discount:"",
                    discount_p:"",
                    total_dis:"0",
                };

            }else{
                Toast.fire({
                    icon: 'warning',
                    title: 'Stock Empty'
                })
            }

            this.dataArray.total_price = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(acc) + parseFloat(curr.total_price)
            }, 0);

            this.dataArray.receivable = this.dataArray.total_price;
            this.dataArray.total_receivable = this.dataArray.total_price;
            this.dataArray.net_receivable = this.dataArray.total_price;

            this.dataArray.total_qty = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(acc) + parseFloat(curr.copies)
            }, 0);

            this.dataArray.total_discount = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(acc) + parseFloat(curr.total_dis)
            }, 0);
        },

        searchVal() {
            if (this.detailsFormData.isbn == "") {
                this.getSearchValue = false;
            } else {
                this.getSearchValue = true;
            }
            },
            //get value isbn and bookname from booktable
        getVal(val) {
            this.selected_isbn = val.isbn
            axios.post(`getConsignRef`, {isbn : val.isbn})
            .then(response=>{
                this.allConsignRef = response.data.data;
                this.getSearchValue = false;
            })
        },












        //this method for generate random number
        // myFunction: function(min, max) {
        //     if (this.dataArray.invoice_ref == "") {
        //         this.dataArray.invoice_ref =
        //         Math.floor(Math.random() * (max - min)) + min;
        //     } else {
        //         this.dataArray.invoice_ref = "";
        //     }
        // },


        pub_price: function (event) {
            this.detailsFormData.pub_price = event.target.value;
        },
        rate: function (event) {
            this.detailsFormData.rate = event.target.value;
        },
        discount_p: function (event) {
            this.detailsFormData.discount_p = event.target.value;
        },
        discount: function (event) {
            this.detailsFormData.discount = event.target.value;
        },
        copies: function (event) {
            this.detailsFormData.copies = event.target.value;
        },

        costBd(){
            if(parseFloat(this.detailsFormData.pub_price) > 0 && parseFloat(this.detailsFormData.rate) > 0){
                this.detailsFormData.unit_price = (parseFloat(this.detailsFormData.pub_price) * parseFloat(this.detailsFormData.rate))
            }

            if(parseFloat(this.detailsFormData.pub_price) > 0 && parseFloat(this.detailsFormData.rate) > 0 && parseInt(this.detailsFormData.copies) > 0){
                this.detailsFormData.total_price = (parseFloat(this.detailsFormData.rate) * parseFloat(this.detailsFormData.pub_price) * parseInt(this.detailsFormData.copies))
                var total_dis1 = parseFloat(this.detailsFormData.pub_price) * parseInt(this.detailsFormData.copies);

                this.detailsFormData.total_dis = total_dis1 - this.detailsFormData.total_price;

                if(parseFloat(this.detailsFormData.discount) > 0){
                        this.detailsFormData.total_dis = this.detailsFormData.total_dis + parseFloat(this.detailsFormData.discount);
                         this.detailsFormData.total_price = parseFloat(this.detailsFormData.total_price) - parseFloat(this.detailsFormData.discount);
                    }
            }

            if(parseFloat(this.detailsFormData.discount_p) > 0){
                if(parseFloat(this.detailsFormData.pub_price) > 0 && parseInt(this.detailsFormData.copies) > 0){
                    var uunit_price = parseFloat(this.detailsFormData.pub_price);
                    var b_unit_price = ((parseFloat(this.detailsFormData.pub_price) * parseFloat(this.detailsFormData.discount_p))/100);
                    var most_unit = uunit_price - b_unit_price;

                    this.detailsFormData.total_dis = b_unit_price * parseInt(this.detailsFormData.copies);
                    this.detailsFormData.unit_price = most_unit;
                    this.detailsFormData.total_price = most_unit * parseInt(this.detailsFormData.copies);

                    if(parseFloat(this.detailsFormData.discount) > 0){
                        this.detailsFormData.total_dis = b_unit_price + parseFloat(this.detailsFormData.discount);

                         this.detailsFormData.total_price = parseFloat(this.detailsFormData.total_price) - parseFloat(this.detailsFormData.discount);
                    }
                }
            }

            //editing Item
            if(parseFloat(this.editingData.pub_price) > 0 && parseFloat(this.editingData.rate) > 0){
                this.editingData.unit_price = (parseFloat(this.editingData.pub_price) * parseFloat(this.editingData.rate))
            }

            if(parseFloat(this.editingData.pub_price) > 0 && parseFloat(this.editingData.rate) > 0 && parseInt(this.editingData.copies) > 0){
                this.editingData.total_price = (parseFloat(this.editingData.rate) * parseFloat(this.editingData.pub_price) * parseInt(this.editingData.copies))
                var total_dis1 = parseFloat(this.editingData.pub_price) * parseInt(this.editingData.copies);

                this.editingData.total_dis = total_dis1 - this.editingData.total_price;

                if(parseFloat(this.editingData.discount) > 0){
                        this.editingData.total_dis = this.editingData.total_dis + parseFloat(this.editingData.discount);
                         this.editingData.total_price = parseFloat(this.editingData.total_price) - parseFloat(this.editingData.discount);
                    }
            }

            if(parseFloat(this.editingData.discount_p) > 0){
                if(parseFloat(this.editingData.pub_price) > 0 && parseInt(this.editingData.copies) > 0){
                    var uunit_price = parseFloat(this.editingData.pub_price);
                    var b_unit_price = ((parseFloat(this.editingData.pub_price) * parseFloat(this.editingData.discount_p))/100);
                    var most_unit = uunit_price - b_unit_price;

                    this.editingData.total_dis = b_unit_price * parseInt(this.editingData.copies);;
                    this.editingData.unit_price = most_unit;
                    this.editingData.total_price = most_unit * parseInt(this.editingData.copies);

                    if(parseFloat(this.editingData.discount) > 0){
                        this.editingData.total_dis = b_unit_price + parseFloat(this.editingData.discount);

                         this.editingData.total_price = parseFloat(this.editingData.total_price) - parseFloat(this.editingData.discount);
                    }
                }
            }


        },

        getInvoiceRef(){
          axios.get(`get-last-invoice-serial`)
          .then(response => {
              this.dataArray.invoice_ref = this.formatInvoiceRef(response.data)
          })
        },
        formatInvoiceRef(serial){
            let invoiceRef = `${moment().format('DD/MM/YY')}/${this.padString(serial)}`
            return invoiceRef
        },
        padString(serial){
            var str = "" + serial
            var pad = "000"
            var ans = pad.substring(0, pad.length - str.length) + str
            return ans
        }

    },

    components: {
        headerComponent,
        footerComponent
    },

  mounted() {
      console.log('Component mounted.')
        this.getInvoiceRef();
  },

};
</script>


<style scoped>
.ulstyle {
  list-style: none;
  padding-left: 0px;
  float: left;
  width: 100%;
}
.ulstyle > li:hover {
  background: #ddd;
  color: blue;
  border-radius: 5px;
}
.ulstyle > li > p {
  padding: 5px;
  cursor: pointer;
  margin-bottom: 4px;
  float: left;
  width: 100%;
}


</style>
<style scoped>
.ulstyle {
  list-style: none;
  padding-left: 0px;
  float: left;
  position: absolute;
    background: aliceblue;
    width: 50%;
    z-index: 999;
    overflow-y:scroll;
    min-height: 5rem;
    max-height: 12rem;

}
.ulstyle > li:hover {
  background: #ddd;
  color: blue;
  border-radius: 5px;
}
.ulstyle > li > p {
  padding: 5px;
  cursor: pointer;
  margin-bottom: 4px;
  float: left;
  margin-bottom: 0px;
border-bottom: 1px solid #DCA;
}

.invoice_title{
    text-align: center;
    font-weight: bold;
    margin-bottom: 10px;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
}

</style>
<style scoped>

</style>
