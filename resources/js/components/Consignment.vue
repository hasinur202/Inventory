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
                        <button class="btn btn-success">
                          New Consignment
                          <i class="fas fa-user-plus fa-fw"></i>
                        </button>
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
                          <td>{{ consignment.created_at | formatDate }}</td>
                          <td>Purchase</td>
                          <td>{{ consignment.get_supplier.supplier }}</td>
                          <td>Cash</td>
                          <td>
                            <!-- <router-link to="/viewconsignment" @click="consignmentByid(consignment)" class="nav-link" style="padding:0; float:left;padding-right:5px;">
                                        <button class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button>
                            </router-link>-->
                              <button @click="consignmentByid(consignment)" class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                              </button>
                            <a href="#">
                              <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                              </button>
                            </a>
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
            <div class="row" v-for="(item, index) in consignmentDetails" :key="index">
              <div class="col-md-4">
                <div class="form-group">
                  <label for>Book</label>
                  <input :value="item.book.book_name" type="text" class="form-control" readonly />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for>Copies</label>
                  <input :value="item.qty" type="text" class="form-control" readonly />
                </div>
              </div>
              <div class="col-md-4">
                <button
                  @click="showEditModal(item)"
                  style="margin-top:25px"
                  class="float-left btn btn-primary btn-sm"
                >Edit</button>
                <button
                  @click="deleteSingleDetails(item.id)"
                  style="margin-top:25px"
                  class="float-left btn btn-danger btn-sm"
                >Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footerComponent></footerComponent>
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateSingleDetails">
              <div class="modal-body">
                <div class="form-group">
                  <label for>Book Name</label>
                  <input class="form-control" type="text" v-model="editDetails.book.book_name" readonly />
                </div>
                <div class="form-group">
                  <label for>Quantity</label>
                  <input class="form-control" type="number" v-model="editDetails.qty" />
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import headerComponent from "./header";
import footerComponent from "./footer";

export default {
  name: "Consignment",
  data() {
    return {
      consign_detailsAll: [],
      consignmentList: [],
      consignmentDetails: [],
      qty: "",
      editDetails: {'book' : {'book_name' : ''}, 'qty' : ''},
    };
  },

  methods: {
    showEditModal(item) {
      this.editDetails = item;
      console.log(item);
      $("#exampleModal").modal("toggle");
    },
    viewConsignment() {
      axios.get("/getConsignment").then(response => {
        this.consignmentList = response.data.data;
      });
    },

    consignmentByid(consignment) {
      // console.log(consignment.consign_ref)

      axios.get(`/getConsignId?id=${consignment.id}`).then(response => {
        this.consignmentDetails = response.data;
      });
    },

    deleteSingleDetails(id) {
      axios.post(`/delete-consignment`, { id: id }).then(response => {
        this.consignmentDetails = [];
      });
    },

    updateSingleDetails() {
      axios
        .post(`/update-consignment-details`, this.editDetails)
        .then(response => {
          console.log(response.data);
        });
    }
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
