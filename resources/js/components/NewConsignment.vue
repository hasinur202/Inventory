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
                                        <h3 class="card-title">New Consignment</h3>
                                        <div class="card-tools">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"><i
                                                    class="fas fa-user-plus fa-fw"></i> Add Consignment</button>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="card-header">
                                        <h3 class="card-title">Stock History</h3>
                                        <div class="card-tools">
                                            <input type="text" name="" placeholder="Search Stock" class="form-control">
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
                                                    <th>Cost Price</th>
                                                    <th>Sales Price</th>
                                                    <th>Publisher Price</th>
                                                    <th>Total Price</th>
                                                    <th>Modify</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr v-for="consignment in consignmentList" :key="consignment.id">
                                                    <td>{{ consignment.get_book.isbn }}</td>
                                                    <td>{{ consignment.get_book.book_name }}</td>
                                                    <td>{{ consignment.copies }}</td>
                                                    <td>{{ consignment.cost_price }}</td>
                                                    <td>{{ consignment.sales_price }}</td>
                                                    <td>{{ consignment.pub_price }} {{ consignment.currency }}</td>
                                                    <td>{{ consignment.total_price }}</td>
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
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

                            <form @submit.prevent="createConsignment">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addNewLabel">Add Consignment</h5>

                                    <div style="margin-left:6rem; margin-top:5px;">
                                        <div class="form-group" style="float:left; margin-bottom:0 !important;">
                                            <input @click="myFunction(1000, 9000)" type="checkbox" class="form-check-input" style="margin-top:7px;">

                                            <input v-model="form.consign_ref" :class="{ 'is-invalid': form.errors.has('consign_ref') }"
                                            type="text" placeholder="Consign. Ref#" class="form-control" style="width: 25.5rem;">
                                            <has-error :form="form" field="consign_ref"></has-error>
                                        </div>
                                    </div>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="col-md-12">
                                        <div class="col-md-6" style="padding-left:0px !important; float:left">
                                            <div class="form-group">
                                                <input @keyup.prevent="searchVal()" v-model="form.isbn" :class="{ 'is-invalid': form.errors.has('isbn') }" type="text" placeholder="Search ISBN"
                                                    class="form-control">
                                                <has-error :form="form" field="isbn"></has-error>
                                            </div>
                                            <div class="form-group" v-show="getSearchValue">
                                                <ul class="ulstyle">
                                                    <li v-for="val in filterd" :key="val.id">
                                                        <p @click.prevent="getVal(val)">{{ val.isbn }}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="padding-left:0px !important; width:48%; float:right;">
                                            <div class="form-group">
                                                <input @keyup="searchSupp()"  v-model="form.supplier" :class="{ 'is-invalid': form.errors.has('supplier') }"
                                                type="text" placeholder="Select Supplier" class="form-control supp">
                                            </div>
                                            <div class="form-group" v-show="getSearchSupp">
                                                <ul class="ulstyle">
                                                    <li v-for="val in filterdSupp" :key="val.id">
                                                        <p @click.prevent="getSupp(val)">{{ val.supplier }}</p>
                                                    </li>
                                                </ul>
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
                                                    <label>Copies</label>
                                                    <input  v-model="form.copies" @keyup="costBd" :class="{ 'is-invalid': form.errors.has('copies') }" type="number" name="copies" placeholder="Copies"
                                                        class="form-control">
                                                    <has-error :form="form" field="copies"></has-error>
                                                </div>

                                                <div class="form-group">
                                                    <label>Publishers Price [In Original Currency]</label>
                                                    <div style="width:38%; float:left;">
                                                        <select v-model="form.currency" :class="{ 'is-invalid': form.errors.has('currency') }" id="type" name="currency"
                                                            style="padding: 6px; padding-right: 60px;">
                                                            <option value="TK">TK</option>
                                                            <option value="INR">INR</option>
                                                            <option value="USD">USD</option>
                                                        </select>
                                                        <has-error :form="form" field="currency"></has-error>
                                                    </div>
                                                    <div style="width:60%; float: right;">
                                                        <input v-model="form.pub_price" @keyup="costBd" :class="{ 'is-invalid': form.errors.has('pub_price') }" type="text" name="pub_price" placeholder="Publishers Price"
                                                            class="form-control">
                                                        <has-error :form="form" field="pub_price"></has-error>
                                                    </div>
                                                </div>

                                                <div style="width:48%; float: left; padding-top:16px;">
                                                    <div class="form-group">
                                                        <label>Conv. Rate</label>
                                                        <input  v-model="form.conv_rate" @keyup="costBd" :class="{ 'is-invalid': form.errors.has('conv_rate') }" type="text" name="conv_rate" placeholder="Conv. Rate"
                                                            class="form-control">
                                                        <has-error :form="form" field="conv_rate"></has-error>
                                                    </div>
                                                </div>

                                                <div style="width:48%; float: right; padding-top:16px">
                                                    <div class="form-group">
                                                        <label>Rate</label>
                                                        <input  v-model="form.st_rate" @keyup="costBd" :class="{ 'is-invalid': form.errors.has('st_rate') }" type="text" name="st_rate" placeholder="Rate"
                                                            class="form-control">
                                                        <has-error :form="form" field="st_rate"></has-error>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6" style="padding-right:0px !important; float:left;">
                                                <div class="form-group">
                                                    <label>Cost Price in BD</label>
                                                    <input v-model="form.cost_price" readonly :class="{ 'is-invalid': form.errors.has('cost_price') }" type="text" placeholder="Cost in BD"
                                                        class="form-control">
                                                    <has-error :form="form" field="cost_price"></has-error>
                                                </div>

                                                <div class="form-group">
                                                    <label>Rate</label>
                                                    <input  v-model="form.my_rate" @keyup="costBd" :class="{ 'is-invalid': form.errors.has('my_rate') }" type="text" name="my_rate" placeholder="Rate"
                                                        class="form-control">
                                                    <has-error :form="form" field="my_rate"></has-error>
                                                </div>

                                                <div class="form-group">
                                                    <label>Sales Price in BD</label>
                                                    <input  v-model="form.sales_price" readonly :class="{ 'is-invalid': form.errors.has('sales_price') }" type="text" placeholder="Sales in BD"
                                                        class="form-control">
                                                    <has-error :form="form" field="sales_price"></has-error>
                                                </div>
                                                 <input hidden v-model="form.total_price" readonly :class="{ 'is-invalid': form.errors.has('total_price') }" type="text">

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
                    </form>
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
        name: "NewConsignment",

        data(){
            return{
                randomNumber:'',
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
                    copies:'',
                    pub_price:'',
                    currency:'TK',
                    conv_rate:'0.65',
                    st_rate:'0.8',
                    cost_price:'',
                    my_rate:'',
                    sales_price:'',
                    total_price:'',
                })
            }
        },
        created(){
            axios.get('/getBook')
            .then((response)=>{
                this.allBook = response.data.data;
            })
        },

        computed:{
            //isbn filtered from allbook
            filterd(){
                return this.allBook.filter(val =>
                val.isbn.startsWith(this.form.isbn))
            },

            filterdSupp(){
                //supllier filtered
                return this.suppliers.filter(val =>
                val.supplier.toLowerCase().startsWith(this.form.supplier.toLowerCase()))
            }
        },

        methods:{

            createConsignment(){
                // Submit the form via a POST request
                this.form.post('/storeConsignment')
                .then(() => {
                    this.form.book_name="";
                    this.form.isbn="";
                    this.form.book_id="";
                    this.form.copies="";
                    this.form.pub_price="";
                    this.form.cost_price="";
                    this.form.my_rate="";
                    this.form.sales_price="";
                    this.form.total_price="";

                    axios.get('/getConsignment')
                    .then((response)=>{
                        this.consignmentList = response.data.data;
                    })
                    Toast.fire({
                    icon: 'success',
                    title: 'Consignment Added Successfully'
                })
            })

            },

            viewConsignment(){
                axios.get('/getConsignment')
                .then((response)=>{
                    this.consignmentList = response.data.data;
                })
            },

            //this method for generate random number
            myFunction: function (min, max) {
                if(this.form.consign_ref == ''){
                    this.form.consign_ref = Math.floor(Math.random() * (max - min)) + min;
                }else{
                    this.form.consign_ref =""
                }
            },
            //search value for isbn
            searchVal(){
                if (this.form.isbn == '') {
                    this.getSearchValue = false;
                }else{
                    this.getSearchValue = true;
                }
            },
            //get value isbn and bookname from booktable
            getVal(val){
               this.form.isbn = val.isbn;
               this.allBook.forEach(el => {
                   if (this.form.isbn == el.isbn) {
                       this.form.book_name = el.book_name;
                       this.form.book_id = el.id;
                       this.getSearchValue = false;
                   }
               });
            },

            //getting supllier value
            getSupp(val){
                this.form.supplier = val.supplier;
                this.form.supplier_id = val.id;
                this.getSearchSupp = false;
            },
            //method for searching supplier
            searchSupp(){
                if (this.form.supplier == '') {
                    this.getSearchSupp = false;
                }else{
                    axios.get('/getSupplier')
                    .then((response)=>{
                        this.suppliers = response.data.data;
                    });
                    this.getSearchSupp = true;
                }
            },

            pub_price: function (event) {
                this.pub_price = event.target.value;
            },
            st_rate: function (event) {
                this.st_rate = event.target.value;
            },
            conv_rate: function (event) {
                this.conv_rate = event.target.value;
            },
            my_rate: function (event) {
                this.my_rate = event.target.value;
            },
            copies: function (event) {
                this.copies = event.target.value;
            },

            costBd(){
                if(parseFloat(this.form.pub_price) > 0 && parseFloat(this.form.conv_rate) > 0){
                    this.form.cost_price = Math.floor(parseFloat(this.form.conv_rate) * parseFloat(this.form.pub_price))
                }

                if(parseFloat(this.form.pub_price) > 0 && parseFloat(this.form.st_rate) > 0){
                    this.form.sales_price = Math.floor(parseFloat(this.form.st_rate) * parseFloat(this.form.pub_price))
                }

                if(parseFloat(this.form.pub_price) > 0 && parseFloat(this.form.my_rate) > 0){
                    this.form.sales_price = Math.floor(parseFloat(this.form.my_rate) * parseFloat(this.form.pub_price))
                }

                if(parseFloat(this.form.cost_price) > 0 && parseInt(this.form.copies) > 0){
                    this.form.total_price = Math.floor(parseFloat(this.form.cost_price) * parseFloat(this.form.copies))
                }
            },

        },

        components: {
            headerComponent,
            footerComponent
        },
        mounted() {
            this.viewConsignment();
        }
    };

</script>
<style scoped>

.ulstyle{
    list-style: none;
    padding-left: 0px;
    float:left;
    width:100%;
}
.ulstyle > li:hover {
    background:#ddd;
    color: blue;
    border-radius: 5px;
}
.ulstyle > li > p{
    padding: 5px;
    cursor:pointer;
    margin-bottom:4px;
    float:left;
    width:100%;
}

.card-title{
    float:left;
}

.supp{
    width: 100%;
    float: right;
}
</style>
