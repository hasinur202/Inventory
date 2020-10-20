<template>
  <div >
    <headerComponent></headerComponent>
    <div class="content-wrapper height-wrap">
      <div class="content">
        <div class="container-fluid">
          <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <router-link to="/newConsignment" class="nav-link" style="float: right; margin-right: 21rem;">
                        <button class="btn btn-success">
                          New Consignment
                          <i class="fas fa-user-plus fa-fw"></i>
                        </button>
                      </router-link>
                </div>

              <div class="col-md-12" style="float:left;">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Consignment History</h3>

                    <div class="card-tools">
                    <input class="form-control" v-model="searchQuery" placeholder="Search Consign Ref#" type="text">

                      <!-- <router-link to="/newConsignment" class="nav-link">
                        <button class="btn btn-success">
                          New Consignment
                          <i class="fas fa-user-plus fa-fw"></i>
                        </button>
                      </router-link> -->
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Consignment Ref#</th>
                          <th>Consignment Date</th>
                          <th>Supplier</th>
                          <th>Pay Mode</th>
                          <th>Modify</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="consignment, key in temp">
                          <td>{{ consignment.consign_ref }}</td>
                          <td>{{ consignment.created_at | formatDate }}</td>
                          <td>{{ consignment.get_supplier.supplier }}</td>
                          <td>{{ consignment.pay_mode }}</td>
                          <td>
                              <button v-if="consignment.pay_mode == 'Due' && consignment.status == 1" @click="addInventoryByid(consignment)"
                                    class="btn btn-primary btn-sm">
                                    Add to Inventory
                                </button>

                              <button @click="consignmentByid(consignment)" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editConsign">
                                <i class="fa fa-eye"></i>
                              </button>

                            <button @click="deleteConsignHistory(consignment)" class="btn btn-danger btn-sm">
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




              <!-- <div class="col-md-4" style="float:right;">
                  <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in consignmentDetails" :key="index">
                            <td>{{ item.qty }}</td>
                            <td>{{ item.total_price }}</td>
                            <td>
                                <button
                                    @click="showEditModal(item)"
                                    class="float-left btn btn-primary btn-sm"
                                    ><i class="fa fa-edit"></i></button>
                                    <button
                                    @click="deleteSingleDetails(item.id)"
                                    class="float-left btn btn-danger btn-sm"
                                    ><i class="fa fa-trash"></i></button>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
              </div> -->



             <div class="modal fade" id="editConsign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <!-- /.card-header -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addNewLabel">Edit Invoice</h5>
                        </div>
                            <div class="modal-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>ISBN/Code</th>
                                        <th>Title</th>
                                        <th>Copies</th>
                                        <th>Cost Price</th>
                                        <th>Sales Price</th>
                                        <th>Publisher Price</th>
                                        <th>Total Price</th>
                                        <th>Modify</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(item, index) in consignmentDetails" :key="index">
                                        <tr>
                                        <td>{{ item.book.isbn }}</td>
                                        <td>{{ item.book.book_name }}</td>
                                        <td>{{ item.qty }}</td>
                                        <td>{{ item.cost_price }}</td>
                                        <td>{{ item.sales_price }}</td>
                                        <td>{{ item.pub_price }} {{ item.currency }}</td>
                                        <td>{{ item.total_price }}</td>
                                        <td>
                                            <button
                                                @click="showEditModal(item)"
                                                class="float-left btn btn-primary btn-sm"
                                                ><i class="fa fa-edit"></i></button>
                                                <button
                                                @click="deleteSingleDetails(item.id)"
                                                class="float-left btn btn-danger btn-sm"
                                                ><i class="fa fa-trash"></i></button>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                    </div>
                </div>
            </div>
            <!--- end col md-12 -->













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
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <!-- /.card-header -->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel">Edit Consignment</h5>
                    </div>
                    <form @submit.prevent="updateSingleDetails">
                    <div class="modal-body">
                      <div class="col-md-12">
                        <div class="col-md-6" style="padding-left:0px !important; float:left">
                          <div class="form-group">
                            <input
                              v-model="editDetails.book.isbn"
                              type="text"
                              class="form-control" readonly
                            />
                          </div>
                        </div>

                        <div>
                          <div class="form-group">
                            <input
                              v-model="editDetails.book.book_name"
                              readonly
                              type="text"
                              class="form-control"
                            />
                          </div>
                        </div>

                        <div class="col-md-6" style="padding-left:0px !important; float:left">
                          <div class="form-group">
                            <label>Copies</label>
                            <input
                              v-model="editDetails.qty"
                                @keyup="costBd"
                              type="number"
                              class="form-control"
                            />
                          </div>

                          <div class="form-group">
                            <label>Publishers Price [In Original Currency]</label>
                            <div style="width:38%; float:left;">
                              <select
                                v-model="editDetails.currency"
                                id="type"
                                name="currency"
                                style="padding: 6px; padding-right: 60px;"
                              >
                                <option value="TK">{{ editDetails.currency }}</option>
                                <option value="INR">INR</option>
                                <option value="USD">USD</option>
                              </select>
                            </div>
                            <div style="width:60%; float: right;">
                            <input
                                @keyup="costBd"
                              v-model="editDetails.pub_price"
                              type="number"
                              class="form-control"
                            />
                            </div>
                          </div>

                          <div style="width:48%; float: left;">
                            <div class="form-group">
                              <label>Conv. Rate</label>
                              <input
                                @keyup="costBd"
                                v-model="editDetails.conv_rate"
                                type="text"
                                class="form-control"
                              />
                            </div>
                          </div>

                          <div style="width:48%; float: right;">
                            <div class="form-group">
                              <label>Rate</label>
                              <input
                                @keyup="costBd"
                                v-model="editDetails.st_rate"
                                type="text"
                                class="form-control"
                              />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6" style="padding-right:0px !important; float:left;">
                          <div class="form-group">
                            <label>Cost Price in BD</label>
                            <input
                              v-model="editDetails.cost_price"
                              readonly
                              type="text"
                              class="form-control"
                            />
                          </div>

                          <div class="form-group">
                            <label>Sales Price in BD</label>
                            <input
                              v-model="editDetails.sales_price"
                              readonly
                              type="text"
                              placeholder="Sales in BD"
                              class="form-control"
                            />
                          </div>
                          <input hidden v-model="editDetails.total_price" readonly type="text" />
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="submit"
                          class="btn btn-primary"
                        >Update</button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
                </div>
                  <!--- end col md-12 -->
  </div>
</template>

<script>
import headerComponent from "./header";
import footerComponent from "./footer";

export default {
  name: "Consignment",
  data() {
    return {
        searchQuery:'',
        temp:[],
      consign_detailsAll: [],
      consignmentList: [],
      consignmentDetails: [],
      editDetails: {
          'book' : {'book_name' : ''},
          'qty' : '',
          'cost_price':'',
          'sales_price':'',
          'pub_price':'',
          'conv_rate':'',
          'st_rate':'',
          'total_price':'',
        },
    };
  },

  watch:{
        searchQuery(){
            if(this.searchQuery.length > 0){
                this.temp = this.consignmentList.filter((consignment) => {
                    return Object.keys(consignment).some((key)=>{
                        let string = String(consignment[key])
                        return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
                    })
                });
            }else{
                this.temp = this.consignmentList
            }
        }
    },

  methods: {
      deleteConsignHistory(consignment){
        axios
        .post(`/deleteConsignById/`,consignment)
        .then(response => {
            this.viewConsignment();
            if(response.data.message){
                Toast.fire({
                    icon: "warning",
                    title: "Consignment Details Delete First"
                });
            }else{
                Toast.fire({
                    icon: "success",
                    title: "Deleted Successfully"
                });
            }
        });
    },

    addInventoryByid(consignment){
        axios.post(`/storeSuppInventory?id=${consignment.id}`).then(response => {
            this.viewConsignment();
            Toast.fire({
                icon: 'success',
                title: 'Added Successfully'
            })
        });
    },


    showEditModal(item) {
      this.editDetails = item;
      console.log(item);
      $("#exampleModal").modal("toggle");
    },
    viewConsignment() {
      axios.get("/getConsignment").then(response => {
        this.consignmentList = response.data.data;
        this.temp = response.data.data;
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

        Toast.fire({
            icon: 'success',
            title: 'Item Deleted Successfully'
        })
      });
    },

    updateSingleDetails() {
      axios
        .post(`/update-consignment-details`, this.editDetails)
        .then(response => {
          console.log(response.data);
          Toast.fire({
            icon: 'success',
            title: 'Item Updated Successfully'
        })
        });
    },

    pub_price: function(event) {
      this.editDetails.pub_price = event.target.value;
    },
    st_rate: function(event) {
      this.editDetails.st_rate = event.target.value;
    },
    conv_rate: function(event) {
      this.editDetails.conv_rate = event.target.value;
    },
    qty: function(event) {
      this.editDetails.copies = event.target.value;
    },

    costBd() {
      if (
        parseFloat(this.editDetails.pub_price) > 0 &&
        parseFloat(this.editDetails.conv_rate) > 0
      ) {
        this.editDetails.cost_price =
          parseFloat(this.editDetails.conv_rate) *
            parseFloat(this.editDetails.pub_price)
        ;
      }

      if (
        parseFloat(this.editDetails.pub_price) > 0 &&
        parseFloat(this.editDetails.st_rate) > 0
      ) {
        this.editDetails.sales_price =
          parseFloat(this.editDetails.st_rate) *
            parseFloat(this.editDetails.pub_price);
      }

      if (
        parseFloat(this.editDetails.cost_price) > 0 &&
        parseInt(this.editDetails.qty) > 0
      ) {
        this.editDetails.total_price =
          parseFloat(this.editDetails.cost_price) *
            parseFloat(this.editDetails.qty)
        ;
      }
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
