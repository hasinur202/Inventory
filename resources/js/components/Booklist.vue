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
                    <th>Book Author(s)</th>
                    <th>Publish Year version</th>
                    <th>Edition</th>
                    <td>Modify</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.4</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.4</td>
                    <td>A</td>
                    <td>
                        <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                        <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                    </td>
                    </tr>
                    <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.5</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.5</td>
                    <td>A</td>
                    <td>
                        <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                        <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                    </td>
                    </tr>
                    <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.6</td>
                    <td>Win 95+ / OSX.1+</td>
                    <td>1.6</td>
                    <td>A</td>
                    <td>
                        <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                        <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                    </td>
                    </tr>
                    <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.7</td>
                    <td>Win 98+ / OSX.1+</td>
                    <td>1.7</td>
                    <td>A</td>
                    <td>
                        <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                        <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                    </td>
                    </tr>
                    <tr>
                    <td>Gecko</td>
                    <td>Mozilla 1.8</td>
                    <td>Win 98+ / OSX.1+</td>
                    <td>1.8</td>
                    <td>A</td>
                    <td>
                        <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                        <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                    </td>
                    </tr>
                    <tr>
                    <td>Gecko</td>
                    <td>Seamonkey 1.1</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.8</td>
                    <td>A</td>
                    <td>
                        <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                        <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                    </td>
                    </tr>
                    <tr>
                    <td>Gecko</td>
                    <td>Epiphany 2.20</td>
                    <td>Gnome</td>
                    <td>1.8</td>
                    <td>A</td>
                    <td>
                        <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                        <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                    </td>
                    </tr>
                    <tr>
                    <td>Webkit</td>
                    <td>Safari 1.2</td>
                    <td>OSX.3</td>
                    <td>125.5</td>
                    <td>A</td>
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
  mounted() {}
};
</script>
