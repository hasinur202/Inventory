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

                                        </div>

                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Customer Name" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" placeholder="Email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" placeholder="Phone" class="form-control">
                                                </div>
                                            </div>

                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <textarea type="text" name="summary" placeholder="Address" class="form-control"></textarea>
                                                </div>

                                                <div class="col-md-6" style="float:right; text-align:center;padding-right:0px">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-danger" >Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
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
                                        <h5 class="modal-title" id="addNewLabel">Add Consignment</h5>
                                    <div style="margin-left:6rem;">
                                        <div class="form-group" style="float:left; margin-bottom:0 !important;">
                                            <input v-model="form.isbn" :class="{ 'is-invalid': form.errors.has('isbn') }"
                                            type="text" placeholder="Search ISBN" class="form-control" style="width: 25.5rem;">
                                            <has-error :form="form" field="isbn"></has-error>
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
                                                    <input  v-model="form.batch" readonly :class="{ 'is-invalid': form.errors.has('batch') }" type="text" placeholder="Select Batch by ISBN "
                                                        class="form-control">
                                                    <has-error :form="form" field="batch"></has-error>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="form-group">
                                                    <input  v-model="form.book_name" readonly :class="{ 'is-invalid': form.errors.has('book_name') }" type="text" placeholder="Select Book by ISBN "
                                                        class="form-control">
                                                    <has-error :form="form" field="book_name"></has-error>
                                                </div>
                                            </div>

                                            <div class="col-md-6" style="padding-left:0px !important; float:left">
                                                <div class="form-group">
                                                    <label>Publishers Price</label>
                                                    <input  v-model="form.pub_price" readonly :class="{ 'is-invalid': form.errors.has('pub_price') }" type="text" placeholder="Publishers Price"
                                                        class="form-control">
                                                    <has-error :form="form" field="pub_price"></has-error>
                                                </div>

                                                <div style="width:48%; float: left;">
                                                    <div class="form-group">
                                                        <label>Balance</label>
                                                        <input  v-model="form.balance" readonly :class="{ 'is-invalid': form.errors.has('balance') }" type="text" placeholder="Available in Stock"
                                                            class="form-control">
                                                        <has-error :form="form" field="balance"></has-error>
                                                    </div>
                                                </div>

                                                <div style="width:48%; float: right;">
                                                    <div class="form-group">
                                                        <label>Copies</label>
                                                        <input  v-model="form.copies" @keyup="costBd" :class="{ 'is-invalid': form.errors.has('copies') }" type="number" placeholder="Rate"
                                                            class="form-control">
                                                        <has-error :form="form" field="copies"></has-error>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Discount [%]</label>
                                                    <input  v-model="form.discount_p" @keyup="costBd" :class="{ 'is-invalid': form.errors.has('discount_p') }" type="text" placeholder="Discount in %"
                                                        class="form-control">
                                                    <has-error :form="form" field="discount_p"></has-error>
                                                </div>
                                            </div>


                                            <div class="col-md-6" style="padding-right:0px !important; float:left;">
                                                <div style="width:48%; float: left;">
                                                    <div class="form-group">
                                                        <label>Rate</label>
                                                        <input  v-model="form.st_rate" @keyup="costBd" :class="{ 'is-invalid': form.errors.has('st_rate') }" type="text" placeholder="Rate"
                                                            class="form-control">
                                                        <has-error :form="form" field="st_rate"></has-error>
                                                    </div>
                                                </div>

                                                <div style="width:48%; float: right;">
                                                    <div class="form-group">
                                                        <label>Unit Price</label>
                                                        <input readonly v-model="form.unit_price" :class="{ 'is-invalid': form.errors.has('unit_price') }" type="text" placeholder="Unit Price"
                                                            class="form-control">
                                                        <has-error :form="form" field="unit_price"></has-error>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Total Price</label>
                                                    <input readonly v-model="form.total_price" :class="{ 'is-invalid': form.errors.has('total_price') }" type="text" placeholder="Total Price"
                                                        class="form-control">
                                                    <has-error :form="form" field="total_price"></has-error>
                                                </div>

                                                <div class="form-group">
                                                    <label>Discount</label>
                                                    <input  v-model="form.discount" :class="{ 'is-invalid': form.errors.has('discount') }" type="text" placeholder="Discount in Amount"
                                                        class="form-control">
                                                    <has-error :form="form" field="discount"></has-error>
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
                getSearchValue: false,
                getSearchSupp: false,
                allBook:[],
                suppliers:[],
                consignmentList:[],
                form: new Form({
                    consign_ref:'',
                    isbn:'',
                    book_id:'',
                    supplier_id:'',
                    book_name:'',
                    supplier:'',
                    copies:'1',
                    pub_price:'250',
                    st_rate:'0.8',
                    sales_price:'',
                    total_price:'',
                    unit_price:'',
                    discount_p:'',
                })
            }
        },

        methods:{
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
                if(parseFloat(this.form.pub_price) > 0 && parseFloat(this.form.st_rate) > 0){
                    this.form.unit_price = Math.floor(parseFloat(this.form.pub_price) * parseFloat(this.form.st_rate))
                }

                if(parseFloat(this.form.pub_price) > 0 && parseFloat(this.form.st_rate) > 0 && parseInt(this.form.copies) > 0){
                    this.form.total_price = Math.floor(parseFloat(this.form.st_rate) * parseFloat(this.form.pub_price) * parseInt(this.form.copies))
                }

                if(parseFloat(this.form.discount_p) > 0){
                    if(parseFloat(this.form.pub_price) > 0 && parseFloat(this.form.st_rate) > 0 && parseInt(this.form.copies) > 0){
                        var unit_price = Math.floor(parseFloat(this.form.pub_price) * parseFloat(this.form.st_rate));
                        var b_unit_price = Math.floor((parseFloat(this.form.pub_price) * parseFloat(this.form.st_rate) * parseFloat(this.form.discount_p))/100);
                        var most_unit = unit_price - b_unit_price;
                        this.form.unit_price = most_unit
                        this.form.total_price = most_unit * parseInt(this.form.copies);
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
