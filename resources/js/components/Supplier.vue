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
                    <h3 class="card-title">Supplier History</h3>
                    <div class="card-tools">
                      <button class="btn btn-success" data-toggle="modal" data-target="#addNew">
                        Add New
                        <i class="fas fa-user-plus fa-fw"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="supplier in supplierlist" :key="supplier.id">
                          <td>{{ supplier.id }}</td>
                          <td>{{ supplier.supplier }}</td>
                          <td>{{ supplier.phone }}</td>
                          <td>{{ supplier.email }}</td>
                          <td>{{ supplier.address }}</td>
                          <td>
                              <button @click="editSupById(supplier)"
                              data-toggle="modal" data-target="#editNew"
                               class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                              </button>

                              <button @click="deleteSupplier(supplier)" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                              </button>

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

<!-- Edit modal -->
            <div
              class="modal fade"
              id="editNew"
              tabindex="-1"
              role="dialog"
              aria-labelledby="addNewLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Add New Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form @submit.prevent="updateSupplier">
                    <div class="modal-body">
                      <div class="form-group">
                        <input
                          v-model="editSuppDetails.supplier"
                          type="text"
                          name="supplier"
                          class="form-control"
                        />

                      </div>
                      <div class="form-group">
                        <input
                          v-model="editSuppDetails.phone"
                          type="text" placeholder="Phone"
                          name="phone"
                          class="form-control"
                        />

                      </div>
                      <div class="form-group">
                        <input
                          v-model="editSuppDetails.email"
                          type="email" placeholder="Email"
                          name="email"
                          class="form-control"
                        />

                      </div>
                      <div class="form-group">
                        <input
                          v-model="editSuppDetails.address"
                          type="text" placeholder="Address"
                          name="address"
                          class="form-control"
                        />

                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>


<!-- add new modal -->
            <div
              class="modal fade"
              id="addNew"
              tabindex="-1"
              role="dialog"
              aria-labelledby="addNewLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Add New Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form @submit.prevent="createSupplier">
                    <div class="modal-body">
                      <div class="form-group">
                        <input
                          v-model="form.supplier"
                          :class="{ 'is-invalid': form.errors.has('supplier') }"
                          type="text"
                          name="supplier"
                          placeholder="Supplier Name **"
                          class="form-control"
                        />
                        <has-error :form="form" field="supplier"></has-error>
                      </div>
                      <div class="form-group">
                        <input
                          v-model="form.phone"
                          :class="{ 'is-invalid': form.errors.has('phone') }"
                          type="text"
                          name="phone"
                          placeholder="Phone"
                          class="form-control"
                        />
                        <has-error :form="form" field="phone"></has-error>
                      </div>
                      <div class="form-group">
                        <input
                          v-model="form.email"
                          :class="{ 'is-invalid': form.errors.has('email') }"
                          type="email"
                          name="email"
                          placeholder="Email"
                          class="form-control"
                        />
                        <has-error :form="form" field="email"></has-error>
                      </div>
                      <div class="form-group">
                        <input
                          v-model="form.address"
                          :class="{ 'is-invalid': form.errors.has('address') }"
                          type="text"
                          name="address"
                          placeholder="Address"
                          class="form-control"
                        />
                        <has-error :form="form" field="address"></has-error>
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
      </div>
    </div>
    <footerComponent></footerComponent>
  </div>
</template>

<script>
import headerComponent from "./header";
import footerComponent from "./footer";
export default {
  name: "Supplier",
  components: {
    headerComponent,
    footerComponent
  },
  data() {
    return {
      editSuppDetails:{
        'supplier':'', 'phone':'', 'email':'', 'address':'', 'id' :''

      },
      supplierlist: "",
      form: new Form({
        supplier: "",
        address: "",
        phone: "",
        fax: "",
        mobile: "",
        email: ""
      })
    };
  },
  methods: {
    createSupplier() {
      // Submit the form via a POST request
      this.form.post("/storeSupplier").then(() => {
        this.viewSupplier();
        this.form.reset();
        Toast.fire({
          icon: "success",
          title: "Supplier Added Successfully"
        });
      });
    },

    updateSupplier(){
        axios
        .post(`/update-supplier-details`, this.editSuppDetails)
        .then(response => {
          this.viewSupplier();
          Toast.fire({
          icon: "success",
          title: "Supplier Updated Successfully"
        });
        });
    },

    deleteSupplier(supplier){
        axios
        .post(`/deleteSuppById/`,supplier)
        .then(response => {
          this.viewSupplier();
          Toast.fire({
          icon: "success",
          title: "Supplier Deleted Successfully"
        });
        });
    },

    viewSupplier() {
      axios.get("/getSupplier").then(response => {
        this.supplierlist = response.data.data;
      });
    },

    editSupById(supplier) {
        for(let index in this.editSuppDetails){
              if(supplier.hasOwnProperty(index)){
                  this.editSuppDetails[index] = supplier[index];
              }
          }
    },




  },

  mounted() {
    this.viewSupplier();
  }
};
</script>
