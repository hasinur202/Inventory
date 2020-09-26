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
                        <button class="btn btn-success" data-toggle="modal" data-target="#addNew">Add New <i class="fas fa-user-plus fa-fw"></i></button>
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
                            <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                            <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                        </td>
                        </tr>
                        <tr>
                        <td>8878475415555</td>
                        <td>শান্তি নিকেতনএর পাঠভবনের সহজপাঠ  </td>
                        <td>1</td>
                        <td>130.00</td>
                        <td>160.00</td>
                        <td>200 TK.</td>
                        <td>130 TK.</td>
                            <td>
                            <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                            <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
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




            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Add New Supplier </h5>

                    <div style="width:40%; float:left; margin:auto;">
                        <input type="text" placeholder="ISBN/Code No.">
                    </div>

                </div>

                <div class="modal-body">

                <div style="width:48%; float:left;">
                    <div class="form-group">
                    <input type="text" name="name" placeholder="Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Address" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Phone " class="form-control">
                    </div>
                </div>


                <div style="width:48%; float:right;">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Fax" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="text" name="email" placeholder="Email" class="form-control">
                    </div>
                </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Create</button>
                </div>
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
  name: "NewConsignment",
  components: {
    headerComponent,
    footerComponent
  },
  mounted() {
      console.log('Component mounted.')
  }
};
</script>
