<template>
  <div>
    <headerComponent></headerComponent>
    <div class="content-wrapper height-wrap">
      <div class="content">
        <div class="container-fluid">
          <div class="container">
            <div class="row mt-5">
              <div class="col-md-12">
                <div class="card">

                  <div class="card-header">
                    <h3 class="card-title">Stock History</h3>
                    <div class="card-tools">
                      <button class="btn btn-success" data-toggle="modal" data-target="#addNew"><i
                          class="fas fa-user-plus fa-fw"></i> Add New Consignment</button>
                    </div>
                  </div>


                <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
                            aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <!-- /.card-header -->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel">Add Consignment</h5>

                      <div style="margin-left:6rem; margin-top:5px;">
                        <div class="form-group" style="float:left; margin-bottom:0 !important;">
                          <input
                            v-model="dataArray.consign_ref"
                            type="text" readonly
                            placeholder="Consign. Ref#"
                            class="form-control"
                            style="width: 25.5rem;"
                          />
                          <span
                            class="text-danger"
                            v-if="errors.hasOwnProperty('consign_ref')"
                          >{{errors.consign_ref[0]}}</span>
                        </div>
                      </div>

                    </div>

                    <div class="modal-body">
                      <div class="col-md-12">
                        <div class="col-md-6" style="padding-left:0px !important; float:left">
                          <div class="form-group">
                            <input
                              @keyup.prevent="searchVal()"
                              v-model="detailsFormData.isbn"
                              type="text"
                              placeholder="Search ISBN"
                              class="form-control"
                            />
                            <span
                              class="text-danger"
                              v-if="errors.hasOwnProperty('isbn')"
                            >{{errors.isbn[0]}}</span>

                            <ul v-show="getSearchValue" class="ulstyle">
                              <li v-for="val in filterd" :key="val.id">
                                <p @click.prevent="getVal(val)">{{ val.isbn }}</p>
                              </li>
                            </ul>

                          </div>
                        </div>

                        <div
                          class="col-md-6"
                          style="padding-left:0px !important; width:48%; float:right;"
                        >
                          <div class="form-group">
                            <input
                              @keyup="searchSupp()"
                              v-model="dataArray.supplier"
                              type="text"
                              placeholder="Select Supplier"
                              class="form-control supp"
                            />
                            <ul v-show="getSearchSupp" class="ulstyle" style="margin-top:40px;">
                              <li v-for="val in filterdSupp" :key="val.id">
                                <p @click.prevent="getSupp(val)">{{ val.supplier }}</p>
                              </li>
                            </ul>
                          </div>
                        </div>

                        <div>
                          <div class="form-group">
                            <input
                              v-model="detailsFormData.book_name"
                              readonly
                              type="text"
                              placeholder="Select Book by ISBN "
                              class="form-control"
                            />
                          </div>
                        </div>

                        <div class="col-md-6" style="padding-left:0px !important; float:left">
                          <div class="form-group">
                            <label>Copies</label>
                            <input
                              v-model="detailsFormData.copies"
                              @keyup="costBd"
                              type="number"
                              name="copies"
                              placeholder="Copies"
                              class="form-control"
                            />
                          </div>

                          <div class="form-group">
                            <label>Publishers Price [In Original Currency]</label>
                            <div style="width:38%; float:left;">
                              <select
                                v-model="detailsFormData.currency"
                                id="type"
                                name="currency"
                                style="padding: 6px; padding-right: 60px;"
                              >
                                <option value="TK">TK</option>
                                <option value="INR">INR</option>
                                <option value="USD">USD</option>
                              </select>
                            </div>
                            <div style="width:60%; float: right;">
                              <input
                                v-model="detailsFormData.pub_price"
                                @keyup="costBd"
                                type="text"
                                placeholder="Publishers Price"
                                class="form-control"
                              />
                            </div>
                          </div>

                          <div style="width:48%; float: left; padding-top:16px;">
                            <div class="form-group">
                              <label>Conv. Rate</label>
                              <input
                                v-model="detailsFormData.conv_rate"
                                @keyup="costBd"
                                type="text"
                                placeholder="Conv. Rate"
                                class="form-control"
                              />
                            </div>
                          </div>

                          <div style="width:48%; float: right; padding-top:16px">
                            <div class="form-group">
                              <label>Rate</label>
                              <input
                                v-model="detailsFormData.st_rate"
                                @keyup="costBd"
                                type="text"
                                name="st_rate"
                                placeholder="Rate"
                                class="form-control"
                              />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6" style="padding-right:0px !important; float:left;">
                          <div class="form-group">
                            <label>Cost Price in BD</label>
                            <input
                              v-model="detailsFormData.cost_price"
                              readonly
                              type="text"
                              placeholder="Cost in BD"
                              class="form-control"
                            />
                          </div>

                          <div class="form-group">
                            <label>Rate</label>
                            <input
                              v-model="detailsFormData.my_rate"
                              @keyup="costBd"
                              type="text"
                              name="my_rate"
                              placeholder="Rate"
                              class="form-control"
                            />
                          </div>

                          <div class="form-group">
                            <label>Sales Price in BD</label>
                            <input
                              v-model="detailsFormData.sales_price"
                              readonly
                              type="text"
                              placeholder="Sales in BD"
                              class="form-control"
                            />
                          </div>
                          <input hidden v-model="detailsFormData.total_price" readonly type="text" />
                          <input hidden v-model="detailsFormData.total_pub_price" readonly type="text" />
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          @click="createConsignment"
                          class="btn btn-primary"
                        >Create</button>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                  <!--- end col md-12 -->




<!--- Edit Consignment Item -->
                <div class="modal fade" id="itemEdit" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
                            aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <!-- /.card-header -->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel">Add Consignment</h5>

                      <div style="margin-left:6rem; margin-top:5px;">
                        <div class="form-group" style="float:left; margin-bottom:0 !important;">
                          <input
                            v-model="dataArray.consign_ref"
                            type="text" readonly
                            placeholder="Consign. Ref#"
                            class="form-control"
                            style="width: 25.5rem;"
                          />
                        </div>
                      </div>

                    </div>

                    <div class="modal-body">
                      <div class="col-md-12">
                        <div class="col-md-6" style="padding-left:0px !important; float:left">
                          <div class="form-group">
                            <input
                              v-model="editingData.isbn"
                              :class="errors.hasOwnProperty('isbn') ? 'is-invalid' : ''"
                              type="text"
                              placeholder="Search ISBN" readonly
                              class="form-control"
                            />

                          </div>
                        </div>

                        <div
                          class="col-md-6"
                          style="padding-left:0px !important; width:48%; float:right;"
                        >
                          <div class="form-group">
                            <input
                              v-model="dataArray.supplier"
                              type="text"
                              placeholder="Select Supplier" readonly
                              class="form-control supp"
                            />
                          </div>
                        </div>

                        <div>
                          <div class="form-group">
                            <input
                              v-model="editingData.book_name"
                              readonly
                              type="text"
                              placeholder="Select Book by ISBN "
                              class="form-control"
                            />
                          </div>
                        </div>

                        <div class="col-md-6" style="padding-left:0px !important; float:left">
                          <div class="form-group">
                            <label>Copies</label>
                            <input
                              v-model="editingData.copies"
                              @keyup="costBd"
                              type="number"
                              name="copies"
                              placeholder="Copies"
                              class="form-control"
                            />
                          </div>

                          <div class="form-group">
                            <label>Publishers Price [In Original Currency]</label>
                            <div style="width:38%; float:left;">
                              <select
                                v-model="editingData.currency"
                                id="type"
                                name="currency"
                                style="padding: 6px; padding-right: 60px;"
                              >
                                <option value="TK">TK</option>
                                <option value="INR">INR</option>
                                <option value="USD">USD</option>
                              </select>
                            </div>
                            <div style="width:60%; float: right;">
                              <input
                                v-model="editingData.pub_price"
                                @keyup="costBd"
                                type="text"
                                placeholder="Publishers Price"
                                class="form-control"
                              />
                            </div>
                          </div>

                          <div style="width:48%; float: left; padding-top:16px;">
                            <div class="form-group">
                              <label>Conv. Rate</label>
                              <input
                                v-model="editingData.conv_rate"
                                @keyup="costBd"
                                type="text"
                                placeholder="Conv. Rate"
                                class="form-control"
                              />
                            </div>
                          </div>

                          <div style="width:48%; float: right; padding-top:16px">
                            <div class="form-group">
                              <label>Rate</label>
                              <input
                                v-model="editingData.st_rate"
                                @keyup="costBd"
                                type="text"
                                name="st_rate"
                                placeholder="Rate"
                                class="form-control"
                              />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6" style="padding-right:0px !important; float:left;">
                          <div class="form-group">
                            <label>Cost Price in BD</label>
                            <input
                              v-model="editingData.cost_price"
                              readonly
                              type="text"
                              placeholder="Cost in BD"
                              class="form-control"
                            />
                          </div>

                          <div class="form-group">
                            <label>Rate</label>
                            <input
                              v-model="editingData.my_rate"
                              @keyup="costBd"
                              type="text"
                              name="my_rate"
                              placeholder="Rate"
                              class="form-control"
                            />
                          </div>

                          <div class="form-group">
                            <label>Sales Price in BD</label>
                            <input
                              v-model="editingData.sales_price"
                              readonly
                              type="text"
                              placeholder="Sales in BD"
                              class="form-control"
                            />
                          </div>
                          <input hidden v-model="editingData.total_price" readonly type="text" />
                          <input hidden v-model="editingData.total_pub_price" readonly type="text" />
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          @click="createEditConsignment"
                          class="btn btn-primary"
                        >Update</button>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                  <!--- end col md-12 -->




                  <div class="card-body table-responsive p-0">
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
                      <tbody v-for="(item, index) in dataArray.details" :key="index">
                        <tr>
                          <td>{{ item.isbn }}</td>
                          <td>{{ item.book_name }}</td>
                          <td>{{ item.copies }}</td>
                          <td>{{ item.cost_price }}</td>
                          <td>{{ item.sales_price }}</td>
                          <td>{{ item.pub_price }} {{ item.currency }}</td>
                          <td>{{ item.total_price }}</td>
                          <td>
                              <button @click="deleteItem(index)" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                              </button>
                                <button data-toggle="modal" data-target="#itemEdit" @click="editItem(item,index)" class="btn btn-primary btn-sm"><i
                                                                    class="fa fa-edit"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-body" style="border: 2px solid cadetblue; border-radius:6px">
                        <div class="col-md-4" style="padding-left:0; float:left;">
                        <label>Pay Mode</label>
                            <select v-model="dataArray.pay_mode" id="type">
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option></option>
                                <option value="Card">Card</option>
                                <option value="Due">Credit to Supplier</option>
                            </select>
                        </div>

                    <div class="col-md-5" style="float:left;">
                      <p style="margin-bottom:0;">Total Publishers Price: {{ dataArray.total_pub_price }} TK.</p><br>
                      <p style="margin-bottom:0;">Total Cost Price: {{ dataArray.total_price }} TK.</p>
                    </div>
                    <div class="col-md-3" style="float:right;">
                      <button
                        @click.prevent="finalUpdate()"
                        class="btn btn-success"
                        style="float:right;"
                      >Save</button>
                    </div>
                  </div>
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
import moment from 'moment'
export default {
  name: "NewConsignment",

  data() {
    return {
      ratelist:{},
      errors: {},
      editingIndex:0,
      total_consign_price: "",
      getSearchValue: false,
      getSearchSupp: false,
      allBook: [],
      suppliers: [],
      consignmentList: [],
      detailsFormData: {
        book_id: "",
        copies: "",
        pub_price: "",
        cost_price: "",
        sales_price: "",
        isbn: "",
        book_name: "",
        currency: "TK",
        conv_rate: "",
        st_rate: "",
        my_ratem: "",
        total_price: "",
        total_pub_price:"",
      },
      dataArray: {
        supplier_id: "",
        consign_ref: "",
        total_price: 0,
        total_pub_price:"",
        details: [],
        supplier: "",
        pay_mode:'Cash'
      },
      editingData :{
        book_id: "",
        copies: "",
        pub_price: "",
        cost_price: "",
        sales_price: "",
        isbn: "",
        book_name: "",
        currency: "TK",
        conv_rate: "",
        st_rate: "",
        my_ratem: "",
        total_price: "",
        total_pub_price:"",
      }
    };
  },
  created() {
    axios.get("/getBook").then(response => {
      this.allBook = response.data.data;
    });

  },

  computed: {
    //isbn filtered from allbook
    filterd() {
      return this.allBook.filter(val =>
        val.isbn.startsWith(this.detailsFormData.isbn)
      );
    },

    filterdSupp() {
      //supllier filtered
      return this.suppliers.filter(val =>
        val.supplier
          .toLowerCase()
          .startsWith(this.dataArray.supplier.toLowerCase())
      );
    }
  },

  methods: {
    deleteItem(index) {
        this.dataArray.details.splice(index,1);

        this.dataArray.total_price = this.dataArray.details.reduce(function(acc, curr){
            return parseFloat(curr.total_price) - parseFloat(acc)
        }, 0);

        this.dataArray.total_pub_price = this.dataArray.details.reduce(function(acc, curr){
            return parseFloat(curr.total_pub_price) - parseFloat(acc)
        }, 0);
    },

    editItem(item, index) {
        this.editingIndex = index;
        this.editingData = item;
    },

    createEditConsignment(){
        this.dataArray.details[this.editingIndex]= this.editingData;

        this.dataArray.total_price = this.dataArray.details.reduce(function(acc, curr){
            return parseFloat(acc) + parseFloat(curr.total_price)
        }, 0);

        this.dataArray.total_pub_price = this.dataArray.details.reduce(function(acc, curr){
            return parseFloat(acc) + parseFloat(curr.total_pub_price)
        }, 0);
    },

    finalUpdate() {
        axios.post("/storeConsignment", this.dataArray).then(() => {
            this.rateGet();
            this.dataArray.details = [];
            this.getConsignRef();
            this.dataArray= {
                supplier_id: "",
                consign_ref: "",
                total_price: 0,
                total_pub_price:"",
                details: [],
                supplier: "",
            }

            Toast.fire({
                icon: 'success',
                title: 'Consignments Saved Successfully'
            })
        });
    },
    createConsignment() {
        if(this.dataArray.supplier == ""){
            Toast.fire({
                icon: 'warning',
                title: 'Supplier name must not be empty!'
            })
        }else{
            this.dataArray.details.push(this.detailsFormData);
            this.detailsFormData = {
              book_id: "",
              copies: "",
              pub_price: "",
              cost_price: "",
              sales_price: "",
              isbn: "",
              conv_rate:this.detailsFormData.conv_rate,
              st_rate:this.detailsFormData.st_rate,
              book_name: "",
              currency: "TK",
              my_ratem: "",
              total_price: "",
              total_pub_price: ""
            };

            this.dataArray.total_price = this.dataArray.details.reduce(function(acc, curr){
              return parseFloat(acc) + parseFloat(curr.total_price)
            }, 0);

          this.dataArray.total_pub_price = this.dataArray.details.reduce(function(acc, curr){
              return parseFloat(acc) + parseFloat(curr.total_pub_price)
            }, 0);

        }

    },

    rateGet(){
        axios.get("/getRate").then(response => {

        this.ratelist = response.data.data;
        this.detailsFormData.st_rate = this.ratelist.st_rate;
        this.detailsFormData.conv_rate = this.ratelist.conv_rate;
    });
    },

    viewConsignment() {
      axios.get("/getConsignment").then(response => {
        this.consignmentList = response.data.data;
      });
    },

    //this method for generate random number
    // myFunction: function(min, max) {
    //   if (this.dataArray.consign_ref == "") {
    //     this.dataArray.consign_ref =
    //       Math.floor(Math.random() * (max - min)) + min;
    //   } else {
    //     this.dataArray.consign_ref = "";
    //   }
    // },
    //search value for isbn
    searchVal() {
      if (this.detailsFormData.isbn == "") {
        this.getSearchValue = false;
      } else {
        this.getSearchValue = true;
      }
    },
    //get value isbn and bookname from booktable
    getVal(val) {
      this.detailsFormData.isbn = val.isbn;
      this.allBook.forEach(el => {
        if (this.detailsFormData.isbn == el.isbn) {
          this.detailsFormData.book_id = el.id;
          this.detailsFormData.book_name = el.book_name;
          this.getSearchValue = false;
        }
      });
    },

    //getting supllier value
    getSupp(val) {
      this.dataArray.supplier = val.supplier;
      this.dataArray.supplier_id = val.id;
      this.getSearchSupp = false;
    },
    //method for searching supplier
    searchSupp() {
      if (this.dataArray.supplier == "") {
        this.getSearchSupp = false;
      } else {
        axios.get("/getSupplier").then(response => {
          this.suppliers = response.data.data;
        });
        this.getSearchSupp = true;
      }
    },

    pub_price: function(event) {
      this.pub_price = event.target.value;
    },
    st_rate: function(event) {
      this.st_rate = event.target.value;
    },
    conv_rate: function(event) {
      this.conv_rate = event.target.value;
    },
    my_rate: function(event) {
      this.my_rate = event.target.value;
    },
    copies: function(event) {
      this.copies = event.target.value;
    },

    costBd() {

      if (parseFloat(this.detailsFormData.pub_price) > 0 && parseFloat(this.detailsFormData.conv_rate) > 0) {
        this.detailsFormData.cost_price = parseFloat(this.detailsFormData.conv_rate) * parseFloat(this.detailsFormData.pub_price);
      }
      if (parseFloat(this.detailsFormData.pub_price) > 0 && parseFloat(this.detailsFormData.st_rate) > 0) {
        this.detailsFormData.sales_price = parseFloat(this.detailsFormData.st_rate) * parseFloat(this.detailsFormData.pub_price);
      }

      if (parseFloat(this.detailsFormData.pub_price) > 0 && parseFloat(this.detailsFormData.my_rate) > 0) {
        this.detailsFormData.sales_price = parseFloat(this.detailsFormData.my_rate) * parseFloat(this.detailsFormData.pub_price);
      }

      if (parseFloat(this.detailsFormData.cost_price) > 0 && parseInt(this.detailsFormData.copies) > 0) {
        this.detailsFormData.total_price = parseFloat(this.detailsFormData.cost_price) * parseFloat(this.detailsFormData.copies);
      }

      if (parseFloat(this.detailsFormData.pub_price) > 0 && parseInt(this.detailsFormData.copies) > 0) {
        this.detailsFormData.total_pub_price = parseFloat(this.detailsFormData.pub_price) * parseFloat(this.detailsFormData.copies);
      }

    //Edit Item

    if (parseFloat(this.editingData.pub_price) > 0 && parseFloat(this.editingData.conv_rate) > 0) {
        this.editingData.cost_price = parseFloat(this.editingData.conv_rate) * parseFloat(this.editingData.pub_price);
      }
      if (parseFloat(this.editingData.pub_price) > 0 && parseFloat(this.editingData.st_rate) > 0) {
        this.editingData.sales_price = parseFloat(this.editingData.st_rate) * parseFloat(this.editingData.pub_price);
      }

      if (parseFloat(this.editingData.pub_price) > 0 && parseFloat(this.editingData.my_rate) > 0) {
        this.editingData.sales_price = parseFloat(this.editingData.my_rate) * parseFloat(this.editingData.pub_price);
      }

      if (parseFloat(this.editingData.cost_price) > 0 && parseInt(this.editingData.copies) > 0) {
        this.editingData.total_price = parseFloat(this.editingData.cost_price) * parseFloat(this.editingData.copies);
      }

      if (parseFloat(this.editingData.pub_price) > 0 && parseInt(this.editingData.copies) > 0) {
        this.editingData.total_pub_price = parseFloat(this.editingData.pub_price) * parseFloat(this.editingData.copies);
      }



    },
    sidebarClose() {
      $("body").addClass("sidebar-collapse");
      $("body").removeClass("sidebar-open");
    },
    sidebarOpen() {
      $("body").removeClass("sidebar-collapse");
      $("body").addClass("sidebar-open");
    },


        getConsignRef(){
          axios.get(`get-last-consign-serial`)
          .then(response => {
              this.dataArray.consign_ref = this.formatConsignRef(response.data)
          })
        },
        formatConsignRef(serial){
            let consignRef = `${moment().format('DD/MM/YY')}/${this.padString(serial)}`
            return consignRef
        },
        padString(serial){
            var str = "" + serial
            var pad = "000"
            var ans = pad.substring(0, pad.length - str.length) + str
            return ans
        }


  },

  components: {
    headerComponent,
    footerComponent
  },
  mounted() {
    this.viewConsignment();
    this.sidebarClose();
    this.getConsignRef();
    this.rateGet();

  },
  destroyed() {
    this.sidebarOpen();
  }
};
</script>
<style scoped>
.ulstyle {
  list-style: none;
  padding-left: 0px;
  float: left;
  width: 95%;
  position: absolute;
  background: aliceblue;
  z-index: 999;
  overflow-y:scroll;
    min-height: 5rem;
    max-height: 12rem;
}
.ulstyle > li:hover {
  background: #ddd;
  color: blue;
  border-radius: 5px;
}
.ulstyle > li > p {
  padding: 5px;
  cursor: pointer;
  margin-bottom: 4px;
  float: left;
  width: 100%;
  margin-bottom: 0px;
    border-bottom: 1px solid #DCA;
}

.card-title {
  float: left;
}

.supp {
  width: 100%;
  float: right;
}
</style>
