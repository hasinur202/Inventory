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
                            <input @click="myFunction()" v-model="form.isbnCheck" type="checkbox" class="form-check-input">
                            <label class="form-check-label"> Generate: </label>
                            <input v-model="form.checkisbn" placeholder="ISBN" style="width:31%; border-style:none;">
                        </div>

                    <div class="col-md-6">
                        <div class="form-group" v-show="visible">
                            <input v-model="form.isbn" :class="{ 'is-invalid': form.errors.has('isbn') }"
                            type="text" placeholder="ISBN No. *" class="form-control" minlength="13" maxlength="13" >
                            <has-error :form="form" field="isbn"></has-error>
                        </div>

                        <div class="form-group">
                            <v-select
                                @search="fetchAuth"
                                placeholder="Search or add Author *"
                                :options="authors"
                                track-by="id"
                                label="author"
                                multiple
                                :taggable="false"
                                v-model="form.author"
                                :closeOnSelect="true"/>
                            <br>
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
                            <v-select
                                @search="fetchCat"
                                placeholder="Search or add Category *"
                                :options="categories"
                                track-by="id"
                                label="category"
                                multiple
                                :taggable="false"
                                v-model="form.category"
                                :closeOnSelect="true"/>
                            <br>
                        </div>

                        <div class="form-group">
                            <input @keyup="searchPub()" v-model="form.publisher" :class="{ 'is-invalid': form.errors.has('publisher') }"
                            type="text" placeholder="Search Publisher *" class="form-control">
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
                    Visit <a target="_blank" href="https://www.ideatechsolution.com/">www.ideatechsolution.com</a> for more information.
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
import vSelect from 'vue-select'
import headerComponent from "./header";
import footerComponent from "./footer";
    export default {
        name: "Book",
        components: {
            headerComponent,
            footerComponent,
        },

        data(){
            return{
                errors:{},
                getSesrchValue: false,
                getSesrchPub: false,
                getSesrchCat: false,
                visible:true,
                authors:[],
                publishers:[],
                categories:[],
                randomNumber:'',
                form: new Form({
                    isbn:'',
                    checkisbn:'',
                    author:[],
                    copyright:'',
                    year:'',
                    country:'',
                    cover:'',
                    summary:'',
                    book_name:'',
                    category:[],
                    publisher:'',
                    edition:'',
                    language:'',
                    ref:'',
                    status:'',

                })
            }
        },

        created(){
            axios.get('/getPublisher')
            .then((response)=>{
                this.publishers = response.data.data;
            });

            axios.get('/getAuthor')
                .then((response)=>{
                    this.authors = response.data.data;
            });

            axios.get('/getCategory')
                .then((response)=>{
                    this.categories = response.data.data;
            });

            getLocationsForEvent: (state) => (id) => {
                return state.loadedLocations.filter(function (location) {
                    return location.eventId === id;
                });
            }

        },
        computed:{
            filterdPub(){
                return this.publishers.filter(val =>
                val.publisher.toLowerCase().startsWith(this.form.publisher.toLowerCase()))
            },
        },

        methods:{
            fetchCat (search, loading) {
                axios.get('/getCategory')
                .then((response)=>{
                    this.categories = response.data.data;
                })
            },
            fetchAuth (search, loading) {
                axios.get('/getAuthor')
                .then((response)=>{
                    this.authors = response.data.data;
                });
            },
            createBook(){
                    // Submit the form via a POST request
                    if(this.form.isbn != "" || this.form.checkisbn != ""){
                        this.form.post('/storeBook/')
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

            // myFunction: function (min, max) {
            //     if(this.form.checkisbn == ''){
            //         this.form.checkisbn = Math.floor(Math.random() * (max - min)) + min;
            //     }else{
            //         this.form.checkisbn =""
            //     }
            // },


            myFunction: function(){
                if(this.form.checkisbn == ""){
                    axios.get(`get-last-isbn-serial`)
                    .then(response => {
                        this.form.checkisbn = this.formatBookIsbnSerial(response.data);
                        this.visible=false;
                    })
                }else{
                    this.form.checkisbn = "";
                    this.visible = true;
                }
            },



            formatBookIsbnSerial(serial){
                let isbnSerial = `${this.padString(serial)}`
                return isbnSerial
            },

            padString(serial){
                var str = "" + serial
                var pad = "0000"
                var ans = pad.substring(0, pad.length - str.length) + str
                return ans
            }

        },

        mounted() {
            console.log('Component mounted.');
            // this.getBookIsbnSerial();
        },
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
    width: 80%;
    z-index: 999;
    overflow-y:scroll;
    min-height: 5rem;
    max-height: 12rem;
}
.selectstyle{
    overflow-y:scroll;
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
