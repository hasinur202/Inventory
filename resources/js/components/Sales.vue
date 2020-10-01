<template>
    <div>
        <headerComponent></headerComponent>
        <div class="content-wrapper">
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
                                                    @click="myFunction(1000, 9000)"
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    style="margin-top:7px;"
                                                />
                                                <input
                                                    v-model="dataArray.invoice_ref"
                                                    type="text"
                                                    placeholder="Invoice. Ref#"
                                                    class="form-control"
                                                    style="width: 25.5rem;"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.hasOwnProperty('invoice_ref')"
                                                >{{errors.invoice_ref[0]}}</span>
                                            </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input v-model="dataArray.customer_name" type="text" placeholder="Customer Name" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <input v-model="dataArray.email" type="text" placeholder="Email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <input v-model="dataArray.phone" type="text" placeholder="Phone" class="form-control">
                                                </div>
                                            </div>

                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <textarea v-model="dataArray.address" type="text" name="summary" placeholder="Address" class="form-control"></textarea>
                                                </div>

                                                <!-- <div class="col-md-6" style="float:right; text-align:center;padding-right:0px">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-danger" >Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div> -->
                                            </div>
                    <!-- /.col -->
                                    </div>
                                </div>


                            </div>


                                    <div class="card-header">
                                        <h3 class="card-title">Invoice Items</h3>
                                        <div class="card-tools">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"><i
                                                    class="fas fa-user-plus fa-fw"></i> Add</button>
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
                                                    <th>Discount</th>
                                                    <th>Net Price</th>
                                                    <th>Modify</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>45454545515125</td>
                                                    <td>Physics</td>
                                                    <td>4</td>
                                                    <td>400</td>
                                                    <td>300</td>
                                                    <td>200</td>
                                                    <td>700</td>
                                                    <td>
                                                        <a href="#"><button class="btn btn-info btn-sm"><i
                                                                    class="fa fa-edit"></i></button></a>
                                                        <a href="#"><button class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>525454545515125</td>
                                                    <td>Bangladesh Studies</td>
                                                    <td>2</td>
                                                    <td>200</td>
                                                    <td>400</td>
                                                    <td>300</td>
                                                    <td>500</td>
                                                    <td>
                                                        <a href="#"><button class="btn btn-info btn-sm"><i
                                                                    class="fa fa-edit"></i></button></a>
                                                        <a href="#"><button class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                    <!-- /.card-body -->
                                    <div class="card-body" style="border: 2px solid cadetblue; border-radius:6px">
                                        <div class="col-md-6" style="float:left;">
                                            <p style="float:right; margin-bottom:0;">Total Publishers Price: 18000 TK.</p>
                                        </div>
                                        <div class="col-md-6" style="float:right;">
                                            <button class="btn btn-info" style="float:right;">Save</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

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
                                            </div>
                                            <div class="form-group" v-show="getSearchValue">
                                                <ul class="ulstyle">
                                                <li v-for="val in filterd" :key="val.id">
                                                    <p @click.prevent="getVal(val)">{{ val.isbn }}</p>
                                                </li>
                                                </ul>
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
                                                    <input  v-model="detailsFormData.consign_ref" readonly type="text" placeholder="Select Batch by ISBN "
                                                        class="form-control">
                                                </div>
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
                                                        <input  v-model="detailsFormData.st_rate" @keyup="costBd" type="text" placeholder="Rate"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div style="width:48%; float: right;">
                                                    <div class="form-group">
                                                        <label>Unit Price</label>
                                                        <input readonly v-model="detailsFormData.unit_price" type="text" placeholder="Unit Price"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Total Price</label>
                                                    <input readonly v-model="detailsFormData.total_price" type="text" placeholder="Total Price"
                                                        class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Discount</label>
                                                    <input  v-model="detailsFormData.discount" type="text" placeholder="Discount in Amount"
                                                        class="form-control">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
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
export default {
  name: "Sales",

  data(){
        return{
            errors: {},
            getSearchValue: false,
            getSearchSupp: false,
            allConsign:[],
            suppliers:[],
            consignmentList:[],
            detailsFormData: {
                book_id: "",
                consign_ref: "",
                pub_price: "250",
                balance: "",
                copies: "1",
                st_rate: "0.8",
                unit_price: "",
                isbn: "",
                book_name: "",
                total_price: "",
                discount:"",
            },
            dataArray: {
                customer_id: "",
                invoice_ref: "",
                total_price: 0,
                total_discount:"",
                pay_mode:"",
                total_qty: "",
                receivable:"",
                net_receivable:"",
                total_receivable:"",
                details: [],
            }
        }
    },


    created() {
        axios.get("/getConsignSale").then(response => {
        this.allConsign = response.data.data;
        });
    },

    computed:{
        filterd() {
            return this.allConsign.filter(val =>
                val.isbn.startsWith(this.detailsFormData.isbn)
            );
        },
    },

    methods:{
        createConsignment() {
            this.dataArray.details.push(this.detailsFormData);
            this.detailsFormData = {
            book_id: "",
            consign_ref: "",
            pub_price: "",
            balance: "",
            copies: "",
            st_rate: "",
            unit_price: "",
            isbn: "",
            book_name: "",
            st_rate: "",
            total_price: "",
            discount:"",
        };

            this.dataArray.total_price = this.dataArray.details.reduce(function(acc, curr){
                return parseFloat(acc) + parseFloat(curr.total_price)
            }, 0)
        },
        //this method for generate random number
        myFunction: function(min, max) {
            if (this.dataArray.invoice_ref == "") {
                this.dataArray.invoice_ref =
                Math.floor(Math.random() * (max - min)) + min;
            } else {
                this.dataArray.invoice_ref = "";
            }
        },

        //search value for isbn
        searchVal() {
            if (this.detailsFormData.isbn == "") {
                this.getSearchValue = false;
            } else {
                this.getSearchValue = true;
            }
        },

        //get value isbn and bookname from booktable
        getVal(val) {
            this.detailsFormData.isbn = val.isbn;
            this.allBook.forEach(el => {
                if (this.detailsFormData.isbn == el.isbn) {
                this.detailsFormData.book_id = el.id;
                this.detailsFormData.book_name = el.book_name;
                this.getSearchValue = false;
                }
            });
        },

        pub_price: function (event) {
            this.pub_price = event.target.value;
        },
        st_rate: function (event) {
            this.st_rate = event.target.value;
        },
        discount_p: function (event) {
            this.discount_p = event.target.value;
        },
        copies: function (event) {
            this.copies = event.target.value;
        },

        costBd(){
            if(parseFloat(this.detailsFormData.pub_price) > 0 && parseFloat(this.detailsFormData.st_rate) > 0){
                this.detailsFormData.unit_price = Math.floor(parseFloat(this.detailsFormData.pub_price) * parseFloat(this.detailsFormData.st_rate))
            }

            if(parseFloat(this.detailsFormData.pub_price) > 0 && parseFloat(this.detailsFormData.st_rate) > 0 && parseInt(this.detailsFormData.copies) > 0){
                this.detailsFormData.total_price = Math.floor(parseFloat(this.detailsFormData.st_rate) * parseFloat(this.detailsFormData.pub_price) * parseInt(this.detailsFormData.copies))
            }

            if(parseFloat(this.detailsFormData.discount_p) > 0){
                if(parseFloat(this.detailsFormData.pub_price) > 0 && parseFloat(this.detailsFormData.st_rate) > 0 && parseInt(this.detailsFormData.copies) > 0){
                    var unit_price = Math.floor(parseFloat(this.detailsFormData.pub_price) * parseFloat(this.detailsFormData.st_rate));
                    var b_unit_price = Math.floor((parseFloat(this.detailsFormData.pub_price) * parseFloat(this.detailsFormData.st_rate) * parseFloat(this.detailsFormData.discount_p))/100);
                    var most_unit = unit_price - b_unit_price;
                    this.detailsFormData.unit_price = most_unit
                    this.detailsFormData.total_price = most_unit * parseInt(this.detailsFormData.copies);
                }
            }

        },



    },

    components: {
        headerComponent,
        footerComponent
    },

  mounted() {
      console.log('Component mounted.')
  }
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
