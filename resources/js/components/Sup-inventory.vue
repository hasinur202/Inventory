<template>
  <div>
    <headerComponent></headerComponent>
    <div class="content-wrapper height-wrap">
      <div class="content">
        <div class="container-fluid">
          <div class="container">
            <div class="row mt-5">

              <div class="col-md-8" style="float:left;">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Inventory for Supplier</h3>

                    <!-- <div class="card-tools">
                      <button class="btn btn-success" data-toggle="modal" data-target="#addNew">
                        Add New
                        <i class="fas fa-user-plus fa-fw"></i>
                      </button>
                    </div> -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Consign #</th>
                          <th>Supplier Name</th>
                          <th>Payment Status</th>
                          <th>Created At</th>
                          <th>Modify</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr v-for="inventory in inventoryList" :key="inventory.id">
                          <td>{{ inventory.consign_ref }}</td>
                          <td>{{ inventory.supplier }}</td>
                          <td v-if="inventory.total_due > inventory.total_paid">
                              <button @click="editSupById(inventory)" data-toggle="modal" data-target="#editNew" class="btn btn-info btn-sm">Due</button>
                          </td>
                          <td v-else><p class="btn btn-success btn-sm">Paid</p></td>
                          <td>{{ inventory.created_at |formatDate }}</td>
                          <td>
                              <button @click="viewSupById(inventory)"
                               class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                              </button>

                              <button @click="deleteInventorySup(inventory)" class="btn btn-danger btn-sm">
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


              <div class="col-md-4" style="float:right;">
                  <button class="btn btn-info btn-sm" @click="download" style="">Print/Download PDF</button>
                  <div id="printMe" class="card">
                      <span style="text-align:center;font-size:16px; margin-top:15px;">{{ settingData.title }}</span>
                      <p style="text-align:center;">{{ settingData.address }} <br>Contact: {{ settingData.mobile }}</p>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead style="line-height: 15px;" v-for="allSupp in SuppInventById" :key="allSupp.id">
                            <tr>
                                <td>Consign Ref#: {{ allSupp.consign_ref }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Supplier Name</th>
                                <td>{{ allSupp.supplier }}</td>
                            </tr>
                            <tr>
                                <th>Total Due</th>
                                <td>{{ allSupp.total_due }} Tk.</td>
                            </tr>
                            <tr>
                                <th>Total Paid</th>
                                <td>{{ allSupp.total_paid }} Tk.</td>
                            </tr>
                            <tr>
                                <th>Current Due</th>
                                <td>{{ allSupp.new_due }} Tk.</td>
                            </tr>
                            <tr>
                                <th>Pay History:</th>
                            </tr>
                        </thead>
                        <tbody style="line-height: 15px;">
                            <tr v-for="paySupp in SuppInventByIdList" :key="paySupp.id">
                                <td>Date: {{ paySupp.created_at | formatDate }}</td>
                                <td>{{ paySupp.pay }} Tk.</td>
                            </tr>

                        <!-- <tr>
                            <th>Total Due</th>
                            <td>{{ item.total_due }}</td>
                        </tr> -->

                      </tbody>
                    </table>
                  </div>
              </div>

              </div>


            </div>

          </div>
        </div>
      </div>
    </div>
    <footerComponent></footerComponent>


<!-- Add inventory -->
                <!-- <div
                    class="modal fade"
                    id="addNew"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                    >
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel">Add Inventory</h5>
                    </div>
                    <form @submit.prevent="createSuppInventory">
                    <div class="modal-body">
                      <div class="col-md-12">


                        <div class="col-md-6" style="padding-left:0px !important; float:left">

                            <div class="form-group">
                                <input
                                @keyup="searchSupp()"
                                v-model="form.supplier"
                                type="text"
                                placeholder="Select Supplier"
                                class="form-control"
                                />
                                <ul v-show="getSearchSupp" class="ulstyle">
                                    <li v-for="val in filterdSupp" :key="val.id">
                                        <p @click.prevent="getSupp(val)">{{ val.get_supplier.supplier }}</p>
                                    </li>
                                </ul>
                            </div>



                            <div class="form-group">
                                <label>Total Due</label>
                                <input
                                v-model="form.total_due"
                                :class="{ 'is-invalid': form.errors.has('total_due') }"
                                type="text"
                                @keyup="costBd"
                                placeholder="Total Due"
                                class="form-control"
                                />
                                <has-error :form="form" field="total_due"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Pay Now</label>
                                <input
                                v-model="form.pay"
                                @keyup="costBd"
                                :class="{ 'is-invalid': form.errors.has('pay') }"
                                type="text"
                                placeholder="Pay Now"
                                class="form-control"
                                />
                                <has-error :form="form" field="pay"></has-error>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-right:0px !important; float:left;">

                            <div class="form-group">
                                <label>Total Paid</label>
                                <input
                                v-model="form.total_paid"
                                :class="{ 'is-invalid': form.errors.has('total_paid') }"
                                type="text" readonly
                                placeholder="Total Paid"
                                class="form-control"
                                />
                                <has-error :form="form" field="total_paid"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Current Due</label>
                                <input
                                v-model="form.new_due"
                                :class="{ 'is-invalid': form.errors.has('new_due') }"
                                type="text" readonly
                                placeholder="Current Due"
                                class="form-control"
                                />
                                <has-error :form="form" field="new_due"></has-error>
                            </div>
                              <input hidden v-model="form.consign_ref" type="text"/>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="submit"
                          class="btn btn-primary"
                        >Create</button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
                </div> -->
                  <!--- end col md-12 -->


<!-- edit inventory -->

<!-- view inventory -->
                <div
                    class="modal fade"
                    id="editNew"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                    >
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <!-- /.card-header -->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel">Edit Inventory</h5>
                    </div>
                    <div class="modal-body">
                      <div class="col-md-12">

                        <div class="col-md-6" style="padding-left:0px !important; float:left">
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <input
                                v-model="editInventory.supplier"
                                type="text" readonly
                                class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Total Due Was</label>
                                <input
                                v-model="editInventory.total_due"
                                type="text" readonly
                                placeholder="Total Due"
                                class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Last Paid ({{ editInventory.updated_at | formatDate }})</label>
                                <input
                                v-model="editInventory.pay"
                                type="text"
                                placeholder="Pay Now"
                                class="form-control"
                                required
                                />
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-right:0px !important; float:left;">

                            <div class="form-group">
                                <label>Total Paid</label>
                                <input
                                v-model="editInventory.total_paid"
                                type="text" readonly
                                placeholder="Total Paid"
                                class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Current Due</label>
                                <input
                                v-model="editInventory.new_due"
                                type="text" readonly
                                placeholder="Current Due"
                                class="form-control"
                                />
                            </div>

                        </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" @click="updateSupInventory"  class="btn btn-primary">Update</button>
                      </div>
                    </div>
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
  name: "Sup-inventory",
  data() {
    return {
        getSearchValue: false,
        getSearchSupp: false,
        SuppInventByIdList:[],
        SuppInventById:'',
        suppliers: [],
        inventoryList: "",
        dataList:'',

        form: new Form({
            supplier: "",
            total_due: "",
            total_paid: "",
            new_due: "",
            pay: "",
            consign_ref:"",
        }),
        settingData:{
          logo:"",
          mobile:"",
          address:"",
          title:"",
      },

      editInventory: {
          'supplier':'', 'total_due':'', 'total_paid':'', 'pay':'', 'new_due':'', 'created_at':'', 'updated_at':'', 'id' :'',
        },
    };
  },

  methods: {
       createSuppInventory() {
      // Submit the form via a POST request
      this.form.post("/storeSuppInventory").then(() => {
        this.viewInventorySupplier();
        this.form.reset();
        Toast.fire({
          icon: "success",
          title: "Supplier Inventory Added Successfully"
        });
      });
    },

    viewInventorySupplier() {
      axios.get("/getSupInventory").then(response => {
        this.inventoryList = response.data.data;
      });
    },

    deleteInventorySup(inventory){
        axios
        .post(`/deleteInvenSuppById/`,inventory)
        .then(response => {
        this.viewInventorySupplier();
            Toast.fire({
                icon: "success",
                title: "Deleted Successfully"
            });
        });
    },

    updateSupInventory(){
        if(this.editInventory.pay == 0){
            Toast.fire({
                icon: "warning",
                title: "Zero/Empty field doesn't exist..!"
            });
        }else{
            if(this.editInventory.new_due == null){
                if(this.editInventory.total_due < this.editInventory.pay){
                    Toast.fire({
                        icon: "warning",
                        title: "Your pay amount cross total due..!"
                    });
                }else{
                    this.newUpdateSup();
                }
            }else{
                if(this.editInventory.new_due < this.editInventory.pay ){
                    Toast.fire({
                        icon: "warning",
                        title: "Your pay amount cross current due..!"
                    });
                }else{
                    this.newUpdateSup();
                }
            }

        }
    },

    newUpdateSup(){
        axios
        .post(`/update-supinventory-details`, this.editInventory)
        .then(response => {
        this.viewInventorySupplier();
            Toast.fire({
                icon: "success",
                title: "Inventory Updated Successfully"
            });
        });
    },



    editSupById(inventory) {
        for(let index in this.editInventory){
            if(inventory.hasOwnProperty(index)){
                this.editInventory[index] = inventory[index];
            }
        }
    },

    viewSupById(inventory){
        axios.get(`/getSuppDetailsById?id=${inventory.id}`).then(response => {
        this.SuppInventByIdList = response.data.inventSuppDetails;
        this.SuppInventById = response.data.inventSupp;
      });
    },


    total_due: function(event) {
      this.form.total_due = event.target.value;
    },
    pay: function(event) {
      this.form.pay = event.target.value;
    },

    costBd() {
        if(parseFloat(this.form.total_due) > 0 && parseFloat(this.form.pay) > 0){
            this.form.new_due = parseFloat(this.form.total_due) - parseFloat(this.form.pay);
        }

        if(parseFloat(this.form.pay) > 0){

            this.form.total_paid = parseFloat(this.form.pay);
        }

    },

    viewSettingsData(){
          axios.get('/getSettingData')
            .then((response)=>{
                this.dataList = response.data.data;

                this.dataList.forEach(el => {
                    this.settingData.title = el.title;
                    this.settingData.mobile = el.mobile;
                    this.settingData.address = el.address;
                    this.settingData.logo = el.logo;

                });
            })
      },

      download(){
        this.$htmlToPaper('printMe');
        },




    getSupp(val) {
        this.form.supplier = val.get_supplier.supplier;
        this.form.consign_ref = val.consign_ref;
        this.getSearchSupp = false;
    },

    //method for searching supplier
    searchSupp() {
      if (this.form.supplier == "") {
        this.getSearchSupp = false;
      } else {
        axios.get("/getSuppConsign").then(response => {
          this.suppliers = response.data.data;
        });
        this.getSearchSupp = true;
      }
    },


  },

  computed:{
      filterdSupp() {
      //supllier filtered
      return this.suppliers.filter(val =>
        val.get_supplier.supplier
          .toLowerCase()
          .startsWith(this.form.supplier.toLowerCase())
      );
    }
  },

  components: {
    headerComponent,
    footerComponent
  },

  mounted() {
      this.viewInventorySupplier();
      this.viewSettingsData();
  }
};
</script>

<style scoped>


.ulstyle{
    list-style: none;
    padding-left: 0px;
    position: absolute;
    background: aliceblue;
    width: 50%;
    z-index: 999;
}
.ulstyle > li:hover {
    background:#ddd;
    color: blue;
    border-radius: 5px;
}

.ulstyle > li > p{
    padding: 5px;
    cursor: pointer;
    margin-bottom: 0px;
    border-bottom: 1px solid #DCA;
}

.card-title {
  float: left;
}

</style>
