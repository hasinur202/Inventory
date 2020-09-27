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
                                    <div class="card-header">
                                        <h3 class="card-title">Stock History</h3>
                                        <div class="card-tools">
                                            <input  v-model="form.supplier" :class="{ 'is-invalid': form.errors.has('supplier') }" type="text" name="isbn" placeholder="Search Supplier"
                                                        class="form-control">

                                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"><i
                                                    class="fas fa-user-plus fa-fw"></i> Add New</button>
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
                                                    <th>Publisher Price</th>
                                                    <th>Total Price</th>
                                                    <th>Modify</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>9888554541515</td>
                                                    <td>দক্ষিনের বারান্দা</td>
                                                    <td>1</td>
                                                    <td>130.00</td>
                                                    <td>160.00</td>
                                                    <td>200 TK.</td>
                                                    <td>130 TK.</td>
                                                    <td>
                                                        <a href="#"><button class="btn btn-info btn-sm"><i
                                                                    class="fa fa-edit"></i></button></a>
                                                        <a href="#"><button class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>8878475415555</td>
                                                    <td>শান্তি নিকেতনএর পাঠভবনের সহজপাঠ </td>
                                                    <td>1</td>
                                                    <td>130.00</td>
                                                    <td>160.00</td>
                                                    <td>200 TK.</td>
                                                    <td>130 TK.</td>
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
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addNewLabel">Add Consignment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <form>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div style="width:48%; float:left;">
                                                <div class="form-group">
                                                    <input @keyup.prevent="searchVal()" v-model="form.isbn" :class="{ 'is-invalid': form.errors.has('isbn') }" type="text" name="isbn" placeholder="Search ISBN"
                                                        class="form-control">
                                                    <has-error :form="form" field="isbn"></has-error>
                                                </div>
                                            </div>
                                            <ul v-show="getSesrchValue">
                                                <li v-for="val in filterd" :key="val.id">
                                                    <p @click.prevent="getVal(val)">{{ val.isbn }}</p>

                                                </li>
                                            </ul>
                                            <!-- <div style="width:48%; float:right;">
                                                <div class="form-group">
                                                    <input  v-model="form.supplier" :class="{ 'is-invalid': form.errors.has('supplier') }" type="text" name="isbn" placeholder="Search Supplier"
                                                        class="form-control">
                                                    <has-error :form="form" field="supplier"></has-error>
                                                </div>
                                            </div> -->

                                            <div>
                                                <div class="form-group">
                                                    <input  v-model="form.book_name" :class="{ 'is-invalid': form.errors.has('book_name') }" type="text" name="book_name" placeholder="Book"
                                                        class="form-control">
                                                    <has-error :form="form" field="book_name"></has-error>
                                                </div>
                                            </div>

                                            <div class="col-md-6" style="padding-left:0px !important; float:left">
                                                <div class="form-group">
                                                    <label>Copies</label>
                                                    <input  v-model="form.copies" :class="{ 'is-invalid': form.errors.has('copies') }" type="number" name="copies" placeholder="Copies"
                                                        class="form-control">
                                                    <has-error :form="form" field="copies"></has-error>
                                                </div>

                                                <div class="form-group">
                                                    <label>Publishers Price [In Original Currency]</label>
                                                    <div style="width:38%; float:left;">
                                                        <select v-model="form.select_price" :class="{ 'is-invalid': form.errors.has('select_price') }" id="type" name="select_price"
                                                            style="padding: 6px; padding-right: 60px;">
                                                            <option active value="">TK</option>
                                                            <option>USD</option>
                                                            <option>R</option>
                                                        </select>
                                                        <has-error :form="form" field="select_price"></has-error>
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
                                                        <input  v-model="form.conv_rate" :class="{ 'is-invalid': form.errors.has('conv_rate') }" type="text" name="conv_rate" placeholder="Conv. Rate"
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
                                                    <input v-model="form.cost_price" :class="{ 'is-invalid': form.errors.has('cost_price') }" type="text" name="cost_price" placeholder="Cost in BD"
                                                        class="form-control">
                                                    <has-error :form="form" field="cost_price"></has-error>
                                                </div>

                                                <div class="form-group">
                                                    <label>Rate</label>
                                                    <input  v-model="form.my_rate" :class="{ 'is-invalid': form.errors.has('my_rate') }" type="text" name="my_rate" placeholder="Rate"
                                                        class="form-control">
                                                    <has-error :form="form" field="my_rate"></has-error>
                                                </div>

                                                <div class="form-group">
                                                    <label>Sales Price in BD</label>
                                                    <input  v-model="form.sales_price" :class="{ 'is-invalid': form.errors.has('sales_price') }" type="text" name="sales_price" placeholder="Sales in BD"
                                                        class="form-control">
                                                    <has-error :form="form" field="sales_price"></has-error>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Create</button>
                                        </div>
                                    </div>
                                </form>

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
        name: "NewConsignment",

        data(){
            return{
                getSesrchValue: false,
                allBook:[],
                form: new Form({
                    isbn:'',
                    supplier:'',
                    book_name:'',
                    copies:'',
                    select_price:'',
                    pub_price:'',
                    conv_rate:'',
                    st_rate:'',
                    cost_price:'',
                    my_rate:'',
                    sales_price:'',
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

            filterd(){
                return this.allBook.filter(val =>
                val.isbn.startsWith(this.form.isbn))
            }
        },
        methods:{
            searchVal(){
                
                if (this.form.isbn == '') {
                    this.getSesrchValue = false;
                }else{
                    this.getSesrchValue = true;
                }
            },
            getVal(val){
               this.form.isbn = val.isbn;
               this.allBook.forEach(el => {
                   if (this.form.isbn == el.isbn) {
                       this.form.book_name = el.book_name;
                   }
               }); 
            },
            pub_price: function (event) {
                this.pub_price = event.target.value;
            },
            st_rate: function (event) {
                this.st_rate = event.target.value;
            },
            costBd(){
                if(parseFloat(this.form.st_rate) > 0 && parseFloat(this.form.pub_price) > 0){
                    this.form.cost_price = Math.floor(parseFloat(this.form.st_rate) * parseFloat(this.form.pub_price))
                }
            }
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
