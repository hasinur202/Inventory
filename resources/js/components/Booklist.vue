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
                            <th>Autho</th>
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
                            <!-- <button @click="bookByid(key)" data-toggle="modal" data-target="#viewBook" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button> -->
                            <button data-toggle="modal" data-target="#viewBook" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
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

                    <div class="col-md-4">

                        <div class="form-group">
                            <label>Cover</label>
                        <div class="input-group">
                            <div class="custom-file file-input-style">
                                <img class="img-style" />
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-md-8">
                        <table class="mytable">
                            <tbody>
                                <tr>
                                    <th scope="row">ISBN No.</th>
                                    <td></td>
                                    <td>545452151212552</td>
                                </tr>
                                <tr>
                                    <th scope="row">Author</th>
                                    <td></td>
                                    <td>Mark</td>
                                </tr>
                                <tr>
                                    <th scope="row">Subject/Category</th>
                                    <td></td>
                                    <td>History</td>
                                </tr>
                                <tr>
                                    <th scope="row">Publisher</th>
                                    <td></td>
                                    <td>Mark Jacshon</td>
                                </tr>
                                <tr>
                                    <th scope="row">Publish Year</th>
                                    <td></td>
                                    <td>2020</td>
                                </tr>
                                <tr>
                                    <th scope="row">Publish Country</th>
                                    <td></td>
                                    <td>America</td>
                                </tr>
                                <tr>
                                    <th scope="row">Copyright</th>
                                    <td></td>
                                    <td>Idea Tech Solution</td>
                                </tr>
                                <tr>
                                    <th scope="row">Edition</th>
                                    <td></td>
                                    <td>2nd</td>
                                </tr>
                                <tr>
                                    <th scope="row">Language</th>
                                    <td></td>
                                    <td>English</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shelf Ref#</th>
                                    <td></td>
                                    <td>Idea Tech</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status</th>
                                     <td></td>
                                    <td>New</td>
                                </tr>
                                <tr>
                                    <th scope="row">Summary</th>
                                     <td></td>
                                    <td> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam dolor harum molestiae laboriosam excepturi quia amet.
                                        Officiis, neque voluptatum blanditiis dignissimos repellat culpa consequuntur provident vitae labore fugit recusandae cumque! </td>
                                </tr>
                            </tbody>
                            </table>
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
        }
    },

    methods:{
        viewBook(){
            axios.get('/getBook')
            .then((response)=>{
                this.booklist = response.data.data;
            })
        },

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

<style>
    .mytable{
        width:100%;
        border:2px solid #ddd;
    }
    .mytable tbody > tr{
        border-bottom:1px solid #ddd;
        line-height:25px;
    }

    .mytable tbody > tr:hover{
        background: #ddd;
    }

    .mytable tbody > tr > th{
        width:30%;
        background: #227C9A;
        padding-left: 5px;
    }
    .mytable tbody > tr > td{
        padding-left: 5px;
    }
</style>
