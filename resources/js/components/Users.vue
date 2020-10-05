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
                    <h3 class="card-title">Users Table</h3>
                    <div class="card-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#addNew">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Modify</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>183</td>
                        <td>John Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="tag tag-success">Approved</span></td>
                        <td>
                            <a href="#">
                                <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            </a>

                            <a href="#">
                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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




            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <div class="form-group">
                    <input v-model="form.name" type="text" name="name" placeholder="Name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                </div>

                <div class="form-group">
                    <input v-model="form.email" type="text" name="email" placeholder="Email"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                </div>

                <div class="form-group">
                    <input v-model="form.phone" type="text" name="phone" placeholder="Phone"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                    <has-error :form="form" field="phone"></has-error>
                </div>

                <div class="form-group">
                    <select v-model="form.type" id="type" name="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                        <option active value="">Select User Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">Standard User</option>
                        <option value="author">Author</option>

                    </select>
                    <has-error :form="form" field="type"></has-error>
                </div>

                <div class="form-group">
                    <input v-model="form.password" type="password" name="password" id="password"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                    <has-error :form="form" field="password"></has-error>
                </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Create</button>
                </div>
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
        name: "Users",
        components: {
            headerComponent,
            footerComponent
        },

        data() {
          return {
              userlist:[],
            form: new Form({
                name: '',
                email: '',
                phone:'',
                type:'',
                password: '',

            })
          }
        },

        mounted() {
            this.viewUserDetails();
        },

        methods:{
            viewUserDetails() {
                axios.get("/getUserDetails").then(response => {
                    this.userList = response.data.data;
                });
            },
        }
    }
</script>
