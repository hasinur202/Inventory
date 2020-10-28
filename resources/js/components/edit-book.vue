<template>
<div>
    <headerComponent></headerComponent>
    <div class="content-wrapper height-wrap">
      <div class="content">
        <div class="container-fluid">

            <div class="container">
                <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ singleBookDetails.book_name }} Edit</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                <form @submit.prevent="updateBook">
                    <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input v-model="singleBookDetails.isbn"
                            type="text" readonly placeholder="ISBN No. *" class="form-control" minlength="13" maxlength="13">
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
                                v-model="singleBookDetails.author"
                                :closeOnSelect="true"/>
                            <br>
                        </div>


                        <div class="form-group">
                            <input v-model="singleBookDetails.copyright"
                            type="text" name="copyright" placeholder="Copyright" class="form-control">
                        </div>

                        <div class="col-md-6" style="float:left; padding-left:0px">
                            <div class="form-group">
                                <input v-model="singleBookDetails.year"
                                type="text" name="year" placeholder="Publish Year" class="form-control">
                            </div>

                        </div>
                        <div class="col-md-6" style="float:right; padding-right:0px">
                            <div class="form-group">
                                <input v-model="singleBookDetails.country"
                                type="text" name="country" placeholder="Publish Country" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Cover</label>
                        <div class="input-group">
                            <div class="custom-file file-input-style">
                                <img :src="editMode ? updateImage() : this.singleBookDetails.cover" class="img-style" />
                                <input  @change="changePhoto($event)" type="file"
                                 class="custom-file-input input-new-style" id="exampleInputFile">
                            </div>
                        </div>
                        </div>

                    </div>

                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <input v-model="this.singleBookDetails.book_name"
                            type="text" name="book_name" placeholder="Book Title *" class="form-control">
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
                                v-model="singleBookDetails.category"
                                :closeOnSelect="true"/>
                            <br>
                        </div>

                        <div class="form-group">
                            <input @keyup="searchPub()" v-model="singleBookDetails.publisher"
                            type="text" placeholder="Search Publisher *" class="form-control">
                            <ul v-show="getSesrchPub" class="ulstyle">
                                <li v-for="val in filterdPub" :key="val.id">
                                    <p @click.prevent="getPub(val)">{{ val.publisher }}</p>

                                </li>
                            </ul>
                        </div>


                    <div class="col-md-6" style="float:left; padding-left:0px">
                        <div class="form-group">
                            <input v-model="singleBookDetails.edition"
                            type="text" name="edition" placeholder="Edition" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6" style="float:right; padding-right:0px;">
                        <div class="form-group">
                            <select v-model="singleBookDetails.language" id="type" name="language" class="form-control">
                                <option>Bangla</option>
                                <option>English</option>
                            </select>
                        </div>
                    </div>

                        <div class="form-group">
                            <input v-model="singleBookDetails.ref"
                            type="text" name="ref" placeholder="Shelf Ref#" class="form-control">
                        </div>

                        <div class="form-group">
                        <select v-model="singleBookDetails.status" id="type" name="status" class="form-control">
                            <option>New</option>
                            <option>Upcoming</option>
                        </select>
                        </div>

                        <div class="form-group">
                            <textarea v-model="singleBookDetails.summary"
                            type="text" name="summary" placeholder="Summary" class="form-control"></textarea>
                        </div>

                        <div class="col-md-6" style="float:right; text-align:center;padding-right:0px">
                            <div class="form-group">
                            <button type="button" class="btn btn-danger" >Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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
        name: "editbook",
        components: {
            headerComponent,
            footerComponent,
        },

        data(){
            return{
                editMode:true,
                book_isbn:'',
                errors:{},
                getSesrchPub: false,
                authors:[],
                publishers:[],
                categories:[],
                editbooklist:[],
                singleBookDetails: {
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
                }
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

        },
        computed:{
            filterdPub(){
                return this.publishers.filter(val =>
                val.publisher.startsWith(this.singleBookDetails.publisher))
            },
        },

        methods:{
            updateBook(){
                axios
                    .post(`/update-book-details`, this.singleBookDetails)
                    .then(response => {
                        Toast.fire({
                            icon: "success",
                            title: "Book Updated Successfully"
                        });
                        this.$router.push('booklist');
                    });
            },
            fetchCat (search, loading) {
                axios.get('/getCategory')
                .then((response)=>{
                    this.categories = response.data;
                })
            },
            fetchAuth (search, loading) {
                axios.get('/getAuthor')
                .then((response)=>{
                    this.authors = response.data.data;
                });
            },

            //publishers search
            getPub(val){
                this.singleBookDetails.publisher = val.publisher;
                this.getSesrchPub = false;
            },
            searchPub(){
                if (this.singleBookDetails.publisher == '') {
                    this.getSesrchPub = false;
                }else{
                    axios.get('/getPublisher')
                    .then((response)=>{
                        this.publishers = response.data.data;
                    });
                    this.getSesrchPub = true;
                }
            },

            updateImage() {
                let img = this.singleBookDetails.cover;
                if (img.length > 200) {
                    return this.singleBookDetails.cover;
                } else {
                    return "/images/" + this.singleBookDetails.cover;
                    // return `/images/${this.singleBookDetails.cover}`;
                }
            },

            ourImage(img) {
                return "/images/" + img;
            },

            changePhoto(event) {
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = event => {
                    this.singleBookDetails.cover = event.target.result;
                };
                reader.readAsDataURL(file);

            },

        },

        mounted() {
            console.log('Component mounted.');

            this.book_isbn = this.$route.params.isbn;
            axios.post(`get-edit-book`, {isbn : this.book_isbn})
            .then(response=>{
                this.editbooklist = response.data.data;
                this.editbooklist.forEach(el => {
                        this.singleBookDetails.isbn = el.isbn,
                        this.singleBookDetails.book_name = el.book_name,
                        this.singleBookDetails.author = el.authors,
                        this.singleBookDetails.category = el.categories,
                        this.singleBookDetails.publisher = el.publisher,
                        this.singleBookDetails.copyright = el.copyright,
                        this.singleBookDetails.year = el.year,
                        this.singleBookDetails.country = el.country,
                        this.singleBookDetails.cover = el.cover,
                        this.singleBookDetails.edition = el.edition,
                        this.singleBookDetails.language = el.language,
                        this.singleBookDetails.status = el.status,
                        this.singleBookDetails.ref = el.ref,
                        this.singleBookDetails.summary = el.summary
                });
            })
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
