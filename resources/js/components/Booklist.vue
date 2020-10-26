<template>
  <div>
    <headerComponent></headerComponent>
    <div class="content-wrapper height-wrap">
      <div class="content">
        <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Book</h3>
                            <div class="card-tools">
                                <input class="form-control" v-model="searchQuery" placeholder="Search" type="text" style="padding:15px !important;">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ISBN No.</th>
                                    <th>Book Name</th>
                                    <th>Author</th>
                                    <th>Subject/Category</th>
                                    <th>Publisher</th>
                                    <th>Publish Year</th>
                                    <th>Edition</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr v-for="books, key in temp">
                                <td>{{ books.isbn }}</td>
                                <td>{{ books.book_name }}</td>
                                <td>
                                    <span style="margin-right:3px;" class="badge badge-success" v-for="item in books.authors">{{ item.author }}</span>
                                </td>
                                <td>
                                    <span style="margin-right:3px;" class="badge badge-success" v-for="item in books.categories">{{ item.category }}</span>
                                </td>
                                <td>{{ books.publisher }}</td>
                                <td>{{ books.year }}</td>
                                <td>{{ books.edition }}</td>
                                <td>
                                    <button @click="bookByid(books)" data-toggle="modal" data-target="#editBook" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>

                                    <button @click="bookByid(books)" data-toggle="modal" data-target="#viewBook" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                                    <!-- <button data-toggle="modal" data-target="#viewBook" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button> -->
                                    <button v-if="books.available_quantity == 0" @click="deleteBookId(books)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
        </div>


<!-- this model for only view -->
        <div class="modal fade" id="viewBook" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">Book Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">
                                    <label>Cover</label>
                                <div class="input-group" style="width:200px !important; height:180px;">
                                    <div class="custom-file file-input-style">
                                        <img class="img-style" :src="`/images/${singleBookDetails.cover}`" />
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- /.col -->
                            <div class="col-md-8 mytable">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>ISBN No.</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.isbn" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Book Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.book_name" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Publisher</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.publisher" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Publisher Year</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.year" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Publish Country</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.country" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Copyright</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.copyright" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Edition</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.edition" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Language</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.language" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Shelf Ref#</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.ref" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Status</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.status" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Summary</label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea v-model="singleBookDetails.summary" readonly></textarea>
                                    </div>
                                </div>

                            </div>
                    <!-- /.col -->
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
               </div>
            </div>
        </div>


<!-- this modal for edit book item -->
        <div class="modal fade" id="editBook" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">Book Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateBook">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label>Cover</label>
                                <div class="input-group"  style="width:200px; height:180px;">
                                    <div class="custom-file file-input-style">
                                        <img class="img-style" :src="editMode ? updateImage() : singleBookDetails.cover" />
                                        <input  @change="changePhoto($event)" type="file" class="custom-file-input input-new-style" id="exampleInputFile">
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- /.col -->
                            <div class="col-md-8 mytable">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>ISBN No.</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.isbn">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Author</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.author">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Subject/Category</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.category" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Publisher</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.publisher" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Publisher Year</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.year" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Publish Country</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.country">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Copyright</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.copyright" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Edition</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.edition" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Language</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.language" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Shelf Ref#</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.ref" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Status</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.status" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Summary</label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea v-model="singleBookDetails.summary" ></textarea>
                                    </div>
                                </div>

                            </div>
                    <!-- /.col -->
                    </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
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
    name: "Booklist",
    components: {
        headerComponent,
        footerComponent
    },
    data(){
        return{
            editMode:false,
            booklist: [],
            searchQuery:'',
            temp:[],
            // booklistId: "",
            singleBookDetails : {
                isbn:'',
                book_name:'',
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
                id:'',
            }
        }
    },

    watch:{
            searchQuery(){
                if(this.searchQuery.length > 0){
                    this.temp = this.booklist.filter((books) => {
                        return Object.keys(books).some((key)=>{
                            let string = String(books[key])
                            return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
                        })
                    });
                }else{
                    this.temp = this.booklist
                }
            }
        },

    methods:{
        viewBook(){
            axios.get('/getBook')
            .then((response)=>{
                this.booklist = response.data.data;
                this.temp = response.data.data;
            })
        },

        bookByid(book){
            for(let index in this.singleBookDetails){
                if(book.hasOwnProperty(index)){
                    this.singleBookDetails[index] = book[index];
                }
            }
        },

        updateBook(){
            axios
                .post(`/update-book-details`, this.singleBookDetails)
                .then(response => {
                this.viewBook();
                    Toast.fire({
                        icon: "success",
                        title: "Book Updated Successfully"
                    });
                });
        },

        updateImage() {
            var img = this.singleBookDetails.cover;
            if (img.length > 100) {
                return this.singleBookDetails.cover;
            } else {
                return "/images/" + this.singleBookDetails.cover;
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

        deleteBookId(books){
            axios
                .post(`/deleteBookById/`,books)
                .then(response => {
                this.viewBook();
                    Toast.fire({
                        icon: "success",
                        title: "Book Deleted Successfully"
                    });
            });
        }




    },


    mounted() {
        this.viewBook();
    }
    };
    </script>

<style scoped>
    .mytable{
        margin-left:40px;
    }

    .row div > input{
        width: 100%;
        padding-left: 5px;
        height: 25px;
        border: 1px solid #ddd !important;
    }
    .row div > textarea{
        width:100%;
        padding-left: 5px;
        border: 1px solid #ddd !important;
    }
    .row .col-md-4 {
        background:#ddd;
        border-bottom: 1px solid #fff;
        padding: 4px;
        padding-left: 16px;
        border-radius: 5px;
    }

    .row .col-md-8 {
        padding: 4px;

    }
    .row .col-md-4 label{
        margin-bottom: 0 !important;
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
    height: 180px !important;
    border: dashed 1.5px blue;
    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
    width: 200px !important;
    cursor: pointer;
}
.img-style{
    width: 200px !important;
    height: 180px !important;
}



</style>
