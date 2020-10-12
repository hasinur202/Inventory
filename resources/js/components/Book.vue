<template>
<div>
    <headerComponent></headerComponent>
    <div class="content-wrapper height-wrap">
      <div class="content">
        <div class="container-fluid">

            <div class="container">
                <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add New Book</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                <form @submit.prevent="createBook">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputIsbn" class="isbn">ISBN Auto</label>
                            <input @click="myFunction(1000, 9000)" v-model="form.isbnCheck" type="checkbox" class="form-check-input">
                            <label class="form-check-label"> Generate: </label>
                            <input v-model="form.checkisbn" placeholder="ISBN" style="width:31%; border-style:none;">
                        </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input v-model="form.isbn" :class="{ 'is-invalid': form.errors.has('isbn') }"
                            type="text" name="isbn" placeholder="ISBN No." class="form-control" minlength="13" maxlength="13" >
                            <has-error :form="form" field="isbn"></has-error>
                        </div>

                        <div class="form-group">
                            <input @keyup="searchVal()" v-model="form.author" :class="{ 'is-invalid': form.errors.has('author') }"
                            type="text" placeholder="Book Author *" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <has-error :form="form" field="author"></has-error>

                            <ul v-show="getSesrchValue" class="ulstyle">
                                <li v-for="val in filterd" :key="val.id">
                                    <p @click.prevent="getVal(val)">{{ val.author }}</p>

                                </li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <input v-model="form.copyright" :class="{ 'is-invalid': form.errors.has('copyright') }"
                            type="text" name="copyright" placeholder="Copyright" class="form-control">
                            <has-error :form="form" field="copyright"></has-error>
                        </div>
                        <div class="col-md-6" style="float:left; padding-left:0px">
                            <div class="form-group">
                                <input v-model="form.year" :class="{ 'is-invalid': form.errors.has('year') }"
                                type="text" name="year" placeholder="Publish Year" class="form-control">
                                <has-error :form="form" field="year"></has-error>
                            </div>

                        </div>
                        <div class="col-md-6" style="float:right; padding-right:0px">
                            <div class="form-group">
                                <input v-model="form.country" :class="{ 'is-invalid': form.errors.has('country') }"
                                type="text" name="country" placeholder="Publish Country" class="form-control">
                                <has-error :form="form" field="country"></has-error>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Cover</label>
                        <div class="input-group">
                            <div class="custom-file file-input-style">
                                <img :src="form.cover" class="img-style" />
                                <input  @change="changePhoto($event)" type="file" name="cover" class="custom-file-input input-new-style" id="exampleInputFile">
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <input v-model="form.book_name" :class="{ 'is-invalid': form.errors.has('book_name') }"
                            type="text" name="book_name" placeholder="Book Title *" class="form-control">
                            <has-error :form="form" field="book_name"></has-error>
                        </div>

                        <div class="form-group">
                            <input @keyup="searchCat()" v-model="form.category" :class="{ 'is-invalid': form.errors.has('category') }"
                            type="text" placeholder="Subject/Category *" class="form-control">
                            <has-error :form="form" field="category"></has-error>
                            <ul v-show="getSesrchCat" class="ulstyle">
                                <li v-for="val in filterdCat" :key="val.id">
                                    <p @click.prevent="getCat(val)">{{ val.category }}</p>

                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <input @keyup="searchPub()" v-model="form.publisher" :class="{ 'is-invalid': form.errors.has('publisher') }"
                            type="text" placeholder="Publisher *" class="form-control">
                            <has-error :form="form" field="publisher"></has-error>
                            <ul v-show="getSesrchPub" class="ulstyle">
                                <li v-for="val in filterdPub" :key="val.id">
                                    <p @click.prevent="getPub(val)">{{ val.publisher }}</p>

                                </li>
                            </ul>
                        </div>

                    <div class="col-md-6" style="float:left; padding-left:0px">
                        <div class="form-group">
                            <input v-model="form.edition" :class="{ 'is-invalid': form.errors.has('edition') }"
                            type="text" name="edition" placeholder="Edition" class="form-control">
                            <has-error :form="form" field="edition"></has-error>
                        </div>
                    </div>
                    <div class="col-md-6" style="float:right; padding-right:0px;">
                        <div class="form-group">
                            <select v-model="form.language" :class="{ 'is-invalid': form.errors.has('language') }" id="type" name="language" class="form-control">
                                <option active value="">Language</option>
                                <option>Bangla</option>
                                <option>English</option>
                            </select>
                            <has-error :form="form" field="language"></has-error>
                        </div>
                    </div>

                        <div class="form-group">
                            <input v-model="form.ref" :class="{ 'is-invalid': form.errors.has('ref') }"
                            type="text" name="ref" placeholder="Shelf Ref#" class="form-control">
                            <has-error :form="form" field="ref"></has-error>
                        </div>

                        <div class="form-group">
                        <select v-model="form.status" :class="{ 'is-invalid': form.errors.has('status') }" id="type" name="status" class="form-control">
                            <option active value="">Select New/Upcoming</option>
                            <option>New</option>
                            <option>Upcoming</option>
                        </select>
                        <has-error :form="form" field="status"></has-error>
                        </div>

                        <!-- <div class="col-md-6" style="float: left; padding-left:0px;">
                        <div class="form-group">
                            <input name="status" type="checkbox" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1"> New</label>
                            <input v-model="form.status" :class="{ 'is-invalid': form.errors.has('status') }" name="status" style="margin-left:20px;" type="checkbox" id="exampleCheck2">
                            <label class="form-check-labe2" for="exampleCheck2"> Upcoming</label>
                            <has-error :form="form" field="status"></has-error>
                        </div>
                        </div> -->
                        <div class="form-group">
                            <textarea v-model="form.summary" :class="{ 'is-invalid': form.errors.has('summary') }"
                            type="text" name="summary" placeholder="Summary" class="form-control"></textarea>
                            <has-error :form="form" field="summary"></has-error>
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
                    </form>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="display: block;">
                    Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                    the plugin.
                </div>
                </div>

            </div>


        </div>
      </div>
    </div>

    <footerComponent></footerComponent>
  </div>
</template>

</template>

<script>
import headerComponent from "./header";
import footerComponent from "./footer";
    export default {
        name: "Book",
        components: {
            headerComponent,
            footerComponent
        },

        data(){
            return{
                getSesrchValue: false,
                getSesrchPub: false,
                getSesrchCat: false,
                authors:[],
                publishers:[],
                categories:[],
                randomNumber:'',
                form: new Form({
                    isbn:'',
                    checkisbn:'',
                    author:'',
                    copyright:'',
                    year:'',
                    country:'',
                    cover:'',
                    summary:'',
                    book_name:'',
                    category:'',
                    publisher:'',
                    edition:'',
                    language:'',
                    ref:'',
                    status:'',

                })
            }
        },

        created(){
            axios.get('/getAuthor')
            .then((response)=>{
                this.authors = response.data.data;
            });
            axios.get('/getPublisher')
            .then((response)=>{
                this.publishers = response.data.data;
            });
            axios.get('/getCategory')
            .then((response)=>{
                this.categories = response.data.data;
            })

        },
        computed:{

            filterd(){
                return this.authors.filter(val =>
                val.author.toLowerCase().startsWith(this.form.author.toLowerCase()))
            },
            filterdPub(){
                return this.publishers.filter(val =>
                val.publisher.toLowerCase().startsWith(this.form.publisher.toLowerCase()))
            },
            filterdCat(){
                return this.categories.filter(val =>
                val.category.toLowerCase().startsWith(this.form.category.toLowerCase()))
            }

        },

        methods:{
            createBook(){
                    // Submit the form via a POST request
                    if(this.form.isbn != "" || this.form.checkisbn != ""){
                        this.form.post('/storeBook')
                        .then(() => {
                            this.form.reset();
                            Toast.fire({
                                icon: 'success',
                                title: 'Book Stored Successfully'
                            })
                        })

                    }else{
                        Toast.fire({
                                icon: 'danger',
                                title: 'ISBN field required'
                            })
                    }
            },

        //authors search
            getVal(val){
                this.form.author = val.author;
                this.getSesrchValue = false;
            },
            searchVal(){

                if (this.form.author == '') {
                    this.getSesrchValue = false;
                }else{
                    axios.get('/getAuthor')
                    .then((response)=>{
                        this.authors = response.data.data;
                    });
                    this.getSesrchValue = true;
                }
            },

            //publishers search
            getPub(val){
                this.form.publisher = val.publisher;
                this.getSesrchPub = false;
            },
            searchPub(){

                if (this.form.publisher == '') {
                    this.getSesrchPub = false;
                }else{
                    axios.get('/getPublisher')
                    .then((response)=>{
                        this.publishers = response.data.data;
                    });
                    this.getSesrchPub = true;
                }
            },

            //categories search
            getCat(val){
                this.form.category = val.category;
                this.getSesrchCat = false;
            },
            searchCat(){

                if (this.form.category == '') {
                    this.getSesrchCat = false;
                }else{
                    axios.get('/getCategory')
                    .then((response)=>{
                        this.categories = response.data.data;
                    });
                    this.getSesrchCat = true;
                }
            },

            ourImage(img) {
                return "/images/" + img;
            },

            changePhoto(event) {
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.cover = event.target.result;
                };
                reader.readAsDataURL(file);

            },

            getVal(val){
                this.form.author = val.author;
                this.getSesrchValue = false;
            },
            searchVal(){
                if (this.form.author == '') {
                    this.getSesrchValue = false;
                }else{
                    axios.get('/getAuthor')
                    .then((response)=>{
                        this.authors = response.data.data;
                    });
                    this.getSesrchValue = true;

                }
            },

            myFunction: function (min, max) {
                if(this.form.checkisbn == ''){
                    this.form.checkisbn = Math.floor(Math.random() * (max - min)) + min;
                }else{
                    this.form.checkisbn =""
                }
            },

        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>


<style scoped>
    .isbn{
        display: inline-flex;
        margin-right: 30px;
    }

.file-input-style{
    border: dashed 1.5px blue;
    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
    height: 180px !important;
    max-width: 200px !important;
    /* margin-left: 50px !important; */
    margin:auto;
}
.input-new-style{
    margin-left: -100%;
    height: 180px;
    border: dashed 1.5px blue;
    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
    width: 100% !important;
    cursor: pointer;
}
.icon-style{
    font-size: 50px;
    margin-left: 145px;
    margin-top:5px;
}

.img-style{
    width: 200px !important;
    height: 180px !important;
}


.ulstyle{
    list-style: none;
    padding-left: 0px;
    position: absolute;
    background: aliceblue;
    width: 50%;
    z-index: 999;
}
.ulstyle > li:hover {
    background:#ddd;
    color: blue;
    border-radius: 5px;
}

.ulstyle > li > p{
    padding: 5px;
    cursor: pointer;
    margin-bottom: 0px;
    border-bottom: 1px solid #DCA;
}

</style>
