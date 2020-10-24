<template>
  <div>
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#">
            <i class="fa fa-bars"></i>
          </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a data-toggle="modal" data-target="#addAuthor" href class="nav-link head_menu">
            <i class="fa fa-user" aria-hidden="true"></i> Authors Entry
          </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a data-toggle="modal" data-target="#addPublisher" href="#" class="nav-link head_menu">
            <i class="fa fa-newspaper" aria-hidden="true"></i> Publishers Entry
          </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a data-toggle="modal" data-target="#addSubject" href="#" class="nav-link head_menu">
            <i class="fas fa-book"></i> Subjects Entry
          </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a data-toggle="modal" data-target="#addQuick" href="#" class="nav-link head_menu">
            <i class="fas fa-eye"></i> Quick Book Info
          </a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input
            class="form-control form-control-navbar"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form> -->

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a @click.prevent="logout()" class="btn btn-danger btn-md" href="#">
            Logout
            <i class="nav-icon fa fa-power-off text-white"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <div class="brand-link">
        <!-- <img :src="`/img/user-12.jpg`" alt="Library Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">সন্ধিপাঠ লাইব্রেরি</span>
      </div>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img :src="`/img/user-12.jpg`" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <p style="color:#fff;" class="d-block">admin</p>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library-->

            <li class="nav-item">
              <router-link to="/sales" class="nav-link">
                <i class="nav-icon fas fa-comments-dollar text-blue"></i>
                <p>Sales</p>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link to="/saleshistory" class="nav-link">
                <i class="nav-icon fa fa-file text-orange"></i>
                <p>Sales History</p>
              </router-link>
            </li>

            <!-- <li class="nav-item">
              <router-link to="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt text-blue"></i>
                <p>Dashboard</p>
              </router-link>
            </li> -->


            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book text-orange"></i>
                <p>
                  Book
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/book" class="nav-link">
                    <i class="nav-icon fas fa-book text-blue"></i>
                    <p>Add Book</p>
                  </router-link>
                </li>

                <li class="nav-item">
                  <router-link to="/booklist" class="nav-link">
                    <i class="nav-icon fas fa-book text-green"></i>
                    <p>Book History</p>
                  </router-link>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <router-link to="/consignment" class="nav-link">
                <i class="nav-icon fas fa-file-invoice-dollar text-blue"></i>
                <p>Consignment</p>
              </router-link>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-file text-orange"></i>
                <p> Report <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/salesState" class="nav-link">
                    <i class="fas fa-circle nav-icon text-blue"></i>
                    <p>Sales Satement</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/salesSum" class="nav-link">
                    <i class="fas fa-circle nav-icon text-info"></i>
                    <p>Sales Summary</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/stock" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Stock Report</p>
                  </router-link>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <router-link to="/supplier" class="nav-link">
                <i class="nav-icon fas fa-industry text-green"></i>
                <p>Supplier</p>
              </router-link>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog text-green"></i>
                <p>
                  Inventory
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/custInventory" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Customer</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/suppInventory" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Supplier</p>
                  </router-link>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog text-green"></i>
                <p>
                  Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/users" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Users</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/settings" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Settings</p>
                  </router-link>
                </li>
              </ul>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Book Author Modal -->
    <div
      class="modal fade"
      id="addAuthor"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
     >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">Add Author</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="createAuthor">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.author"
                  type="text"
                  name="author"
                  placeholder="Author Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('author') }"
                />
                <has-error :form="form" field="author"></has-error>
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

    <!-- Book Publisher Modal -->
    <div
      class="modal fade"
      id="addPublisher"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
     >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">Add Publisher</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="createPublisher">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.publisher"
                  type="text"
                  name="publisher"
                  placeholder="Publisher Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('publisher') }"
                />
                <has-error :form="form" field="publisher"></has-error>
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

    <!-- Book Publisher Modal -->
    <div
      class="modal fade"
      id="addSubject"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
     >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">Add Category/Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="createCategory">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.category"
                  type="text"
                  name="category"
                  placeholder="Category/Subject"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('category') }"
                />
                <has-error :form="form" field="category"></has-error>
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


    <!-- Quick Book View -->
    <div
      class="modal fade"
      id="addQuick"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
     >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">Quick Book Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">
              <div class="form-group">
                    <input
                        @keyup.prevent="searchVal()"
                        v-model="detailsFormData.isbn"
                        :class="errors.hasOwnProperty('isbn') ? 'is-invalid' : ''"
                        type="text"
                        placeholder="Search Book By ISBN"
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

             <table>
                 <tr>
                     <th>Book Name</th>
                     <td>:</td>
                     <td>{{ detailsFormData.book_name }}</td>
                 </tr>
                 <tr>
                     <th>Author</th>
                     <td>:</td>
                     <td>{{ detailsFormData.author }}</td>
                 </tr>
                 <tr>
                     <th>Available Quantity</th>
                     <td>:</td>
                     <td v-if="detailsFormData.available_quantity != ''">{{ detailsFormData.available_quantity }}</td>
                     <td v-else>Empty Stock</td>
                 </tr>

             </table>

            </div>
            <div class="modal-footer">
              <button @click="quickIsbnRest" type="button" class="btn btn-info">Clear</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
    name:'app',
    data(){
        return{
            getSearchValue: false,
            errors: {},
            allBook:[],
            form: new Form({
                author:'',
                publisher:'',
                category:'',
            }),

            detailsFormData: {
                isbn: "",
                book_name:"",
                available_quantity:"",
                author:"",
            },
        }
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
  },

    methods:{
      quickIsbnRest(){
        this.detailsFormData = [];
      },

      logout(){
        axios.get('/logout')
        .then(()=>{
          localStorage.removeItem('inventory');
          this.$router.push('/');
          Toast.fire({
            icon: 'success',
            title: 'Logout Successfully'
        })

        })
      },
      createAuthor(){
        // Submit the form via a POST request
        this.form.post('/storeAuthor')
        .then(() => {

            this.form.reset();
            Toast.fire({
            icon: 'success',
            title: 'Author Created Succfully'
        })
      })

      },

      createPublisher(){
        // Submit the form via a POST request
        this.form.post('/storePublisher')
        .then(({ data }) => {
            this.form.reset();
            Toast.fire({
            icon: 'success',
            title: 'Publisher Created Succfully'
        })
      })

      },
      createCategory(){
        // Submit the form via a POST request
        this.form.post('/storeCategory')
        .then(({ data }) => {
            this.form.reset();
            Toast.fire({
            icon: 'success',
            title: 'Category Created Succfully'
        })
      })

      },

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
          this.detailsFormData.available_quantity = el.available_quantity;
          this.detailsFormData.author = el.author;
          this.getSearchValue = false;
        }
      });
    },

    }
}
</script>

<style>
.head_menu{
        border-radius: 10px;
        border: 1px solid #fff;
        background: #494E54;
        color: #fff !important;
        margin-left: 14px;
      }
      .head_menu:hover {
          background: gray !important;
          color: black !important;
          border:1px solid #ddd;transition-delay: 0.2s;
      }
      .fixed_position{
          left:0;
          right:0; top: 0;
          position: fixed;
      }




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
</style>
