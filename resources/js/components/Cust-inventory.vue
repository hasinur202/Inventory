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
                    <h3 class="card-title">Inventory for Customer</h3>

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
                          <th>Invoice #</th>
                          <th>Customer Name</th>
                          <th>Payment Status</th>
                          <th>Created At</th>
                          <th>Modify</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr v-for="inventory in inventoryList" :key="inventory.id">
                          <td>{{ inventory.invoice_ref }}</td>
                          <td>{{ inventory.cus_name }}</td>
                          <td v-if="inventory.total_due > inventory.total_paid">
                              <button @click="editCusById(inventory)" data-toggle="modal" data-target="#editNew" class="btn btn-info btn-sm">Due</button>
                          </td>
                          <td v-else><p class="btn btn-success btn-sm">Paid</p></td>
                          <td>{{ inventory.created_at |formatDate }}</td>
                          <td>
                              <button @click="viewCusById(inventory)"
                               class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                              </button>

                              <button v-if="inventory.total_paid == inventory.total_due" @click="deleteInventoryCus(inventory)" class="btn btn-danger btn-sm">
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
                      <p style="text-align:center;font-size:16px; margin-top:15px;">{{ settingData.title }}</p>
                      <p style="text-align:center;">{{ settingData.address }} <br>Contact: {{ settingData.mobile }}</p>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead style="line-height:15px;" v-for="allCust in CustInventById" :key="allCust.id">
                            <tr>
                                <td>Invoice No: {{ allCust.invoice_ref }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <td>{{ allCust.cus_name }}</td>
                            </tr>
                            <tr>
                                <th>Total Due</th>
                                <td>{{ allCust.total_due }} Tk.</td>
                            </tr>
                            <tr>
                                <th>Total Paid</th>
                                <td>{{ allCust.total_paid }} Tk.</td>
                            </tr>
                            <tr>
                                <th>Current Due</th>
                                <td>{{ allCust.new_due }} Tk.</td>
                            </tr>
                            <tr>
                                <th>Pay History:</th>
                            </tr>
                        </thead>
                        <tbody style="line-height:15px;">
                            <tr v-for="payCust in CustInventByIdList" :key="payCust.id">
                                <td>Date: {{ payCust.updated_at | formatDate }}</td>
                                <td>{{ payCust.pay }} Tk.</td>
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


<!--
                <div
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
                    <form @submit.prevent="createCusInventory">
                    <div class="modal-body">
                      <div class="col-md-12">


                        <div class="col-md-6" style="padding-left:0px !important; float:left">

                            <div class="form-group">
                                <input
                                @keyup="searchCus()"
                                v-model="form.cus_name"
                                type="text"
                                placeholder="Select Customer"
                                class="form-control"
                                />
                                <ul v-show="getSearchCus" class="ulstyle">
                                    <li v-for="val in filterdCus" :key="val.id">
                                        <p @click.prevent="getCus(val)">{{ val.cus_name }}</p>
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
                            <input v-model="form.invoice_ref" type="text" hidden/>
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
                </div>
 -->


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
                                <label>Customer Name</label>
                                <input
                                v-model="editInventory.cus_name"
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
                          <button type="submit" @click="updateCusInventory"  class="btn btn-primary">Update</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
  name: "Cust-inventory",
  data() {
    return {
        getSearchValue: false,
        getSearchCus: false,
        customers: [],
        CustInventByIdList: [],
        CustInventById: '',
        inventoryList: "",
        dataList:'',

        form: new Form({
            cus_name: "",
            total_due: "",
            total_paid: "",
            new_due: "",
            pay: "",
            invoice_ref:"",
        }),

        settingData:{
          logo:"",
          mobile:"",
          address:"",
          title:"",
      },

      editInventory: {
          'cus_name':'', 'total_due':'', 'total_paid':'', 'pay':'', 'new_due':'', 'updated_at':'', 'created_at':'', 'id' :'',
        },
    };
  },

  methods: {
      // Submit the form via a POST request
    //    createCusInventory() {
    //   this.form.post("/storeCusInventory").then(() => {
    //     this.viewInventoryCustomer();
    //     this.form.reset();
    //     Toast.fire({
    //       icon: "success",
    //       title: "Customer Inventory Added Successfully"
    //     });
    //   });
    // },

    viewInventoryCustomer() {
      axios.get("/getCusInventory").then(response => {
        this.inventoryList = response.data.data;
      });
    },

    deleteInventoryCus(inventory){
        axios
        .post(`/deleteIvenCusById/`,inventory)
        .then(response => {
        this.viewInventoryCustomer();
            Toast.fire({
                icon: "success",
                title: "Deleted Successfully"
            });
        });
    },


    updateCusInventory(){
        if(this.editInventory.pay == 0){
            Toast.fire({
                icon: "warning",
                title: "Zero/Empty field doesn't exist..!"
            });
        }else if(this.editInventory.new_due != null){
            if(this.editInventory.new_due < this.editInventory.pay){

                Toast.fire({
                    icon: "warning",
                    title: "Your pay amount cross current due..!"
                });
            }
        }else{
                axios
                .post(`/update-cusinventory-details`, this.editInventory)
                .then(response => {
                this.viewInventoryCustomer();
                    Toast.fire({
                        icon: "success",
                        title: "Inventory Updated Successfully"
                    });
                });
            }


    },

    editCusById(inventory) {
        for(let index in this.editInventory){
            if(inventory.hasOwnProperty(index)){
                this.editInventory[index] = inventory[index];
            }
        }
    },

    viewCusById(inventory){
        axios.get(`/getCustDetailsById?id=${inventory.id}`).then(response => {
        this.CustInventByIdList = response.data.inventCustDetails;
        this.CustInventById = response.data.inventCust;
      });
    },


    download(){
        this.$htmlToPaper('printMe');
    },



    total_due: function(event) {
      this.form.total_due = event.target.value;
    },
    pay: function(event) {
      this.form.pay = event.target.value;
    },

    // costBd() {
    //     if(parseFloat(this.form.total_due) > 0 && parseFloat(this.form.pay) > 0){
    //         this.form.new_due = parseFloat(this.form.total_due) - parseFloat(this.form.pay);
    //     }

    //     if(parseFloat(this.form.pay) > 0){

    //         this.form.total_paid = parseFloat(this.form.pay);
    //     }

    // },

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




    getCus(val) {
        this.form.cus_name = val.cus_name;
        this.form.invoice_ref = val.invoice_ref;
        this.form.invoice_id = val.id;
        this.getSearchCus = false;
    },

    //method for searching supplier
    searchCus() {
      if (this.form.cus_name == "") {
        this.getSearchCus = false;
      } else {
        axios.get("/getInvoices").then(response => {
          this.customers = response.data.data;
        });
        this.getSearchCus = true;
      }
    },


  },

  computed:{
      filterdCus() {
      //supllier filtered
      return this.customers.filter(val =>
        val.cus_name
          .toLowerCase()
          .startsWith(this.form.cus_name.toLowerCase())
      );
    }
  },

  components: {
    headerComponent,
    footerComponent
  },

  mounted() {
      this.viewInventoryCustomer();
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
