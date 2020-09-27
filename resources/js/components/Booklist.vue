<template>
  <div>
    <headerComponent></headerComponent>
    <div class="content-wrapper">
      <div class="content">
        <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                <div class="card-header">
                <h3 class="card-title">Book History</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ISBN No.</th>
                            <th>Book Name</th>
                            <th>Author</th>
                            <th>Copyright</th>
                            <th>Subject/Category</th>
                            <th>Edition</th>
                            <th>Language</th>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr v-for="books in booklist" :key="books.id">
                        <td>{{ books.isbn }}</td>
                        <td>{{ books.book_name }}</td>
                        <td>{{ books.author }}</td>
                        <td>{{ books.copyright }}</td>
                        <td>{{ books.category }}</td>
                        <td>{{ books.edition }}</td>
                        <td>{{ books.edition }}</td>
                        <td>
                            <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                            <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                            <button @click="bookByid(books)" data-toggle="modal" data-target="#viewBook" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                            <!-- <button data-toggle="modal" data-target="#viewBook" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button> -->
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
                                <div class="input-group">
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
                                        <label>Author</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.author" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Subject/Category</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="singleBookDetails.category" readonly>
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
                                        <label>Shelf Ref# Country</label>
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
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
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
            booklist: "",
            // booklistId: "",
            singleBookDetails : {
                isbn:'',
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
            }
        }
    },

    methods:{
        viewBook(){
            axios.get('/getBook')
            .then((response)=>{
                this.booklist = response.data.data;
            })
        },
        bookByid(book){
            for(let index in this.singleBookDetails){
                if(book.hasOwnProperty(index)){
                    this.singleBookDetails[index] = book[index];
                }
            }
        }

        // bookByid(key){
        //     axios.post('/getBookbyId/${key}')
        //     .then((response)=>{
        //         this.booklistId = response.data.data;
        //     })
        // }


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
</style>
