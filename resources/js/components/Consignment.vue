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
                        <tr v-for="consignment in consignmentList" :key="consignment.id">
                            <td>Consignment/2020/{{ consignment.consign_ref }}</td>
                            <td>{{ consignment.created_at }}</td>
                            <td>Purchase</td>
                            <td>{{ consignment.get_supplier.supplier  }}</td>
                            <td>Cash</td>
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
  data(){
      return {
          consignmentList:[],
      }

  },

  methods:{
      viewConsignment(){
        axios.get('/getConsignment')
        .then((response)=>{
            this.consignmentList = response.data.data;
        })
    },

  },


  components: {
      headerComponent,
      footerComponent
  },

  mounted() {
      this.viewConsignment();
  }
};
</script>
