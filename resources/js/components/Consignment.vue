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
                    <h3 class="card-title">Consignment History</h3>

                    <div class="card-tools">
                        <router-link to="/newConsignment" class="nav-link">
                            <button class="btn btn-success">New Consignment<i class="fas fa-user-plus fa-fw"></i></button>
                        </router-link>
                    </div>


                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th>Consignment Ref#</th>
                        <th>Consignment Date</th>
                        <th>Type</th>
                        <th>Supplier</th>
                        <th>Pay Mode</th>
                        <th>Modify</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                        <td>Consignment/2020/0003</td>
                        <td>20 Jan, 2020</td>
                        <td>Purchase</td>
                        <td>Shahjahan</td>
                        <td>Cash</td>
                            <td>
                            <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                            <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                        </td>
                        </tr>
                        <tr>
                        <td>Consignment/2020/0004</td>
                        <td>01 Agust, 2020</td>
                        <td>Purchase</td>
                        <td>Bivas</td>
                        <td>Bkash</td>
                            <td>
                            <a href="#"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                            <a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                        </td>
                        </tr>
                        <tr>
                        <td>Consignment/2020/0004</td>
                        <td>22 October, 2020</td>
                        <td>Purchase</td>
                        <td>Bengal Publication Ltd.</td>
                        <td>Rocket</td>
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
  name: "Consignment",
  components: {
    headerComponent,
    footerComponent
  },
  mounted() {
      console.log('Component mounted.')
  }
};
</script>
