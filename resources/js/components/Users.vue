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
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in userList" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.phone }}</td>
                        <td>{{ user.role }}</td>
                        <td v-if="user.status == 1"><p class="btn btn-success btn-sm">Active</p></td>
                        <td v-else><p class="btn btn-info btn-sm">Inactive</p></td>
                        <td>
                            <button @click="editUserById(user)" data-toggle="modal" data-target="#editNew" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <button @click="deleteUser(user)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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


<!-- Add New Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form @submit.prevent="createUser">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.name" type="text" name="name" placeholder="Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.email" type="email" name="email" placeholder="Email"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.phone" type="text" name="phone" placeholder="Phone"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                        <has-error :form="form" field="phone"></has-error>
                    </div>

                    <div style="width:48%; float:left;" class="form-group">
                        <select v-model="form.type" id="type" name="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <option active value="">Select User Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>

                        </select>
                        <has-error :form="form" field="type"></has-error>
                    </div>

                    <div style="width:48%; float:right;" class="form-group">
                        <select v-model="form.status" id="status" name="status" class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                            <option active value="">Select Activity</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <has-error :form="form" field="status"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.password" type="password" id="password" placeholder="Password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.confirmpassword" type="password" id="confirmpassword" placeholder="Confirm Password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('confirmpassword') }">
                        <has-error :form="form" field="confirmpassword"></has-error>
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

<!-- Edit Modal -->
        <div class="modal fade" id="editNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Edit User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form @submit.prevent="updateUser">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="editUser.name" type="text" name="name" placeholder="Name"
                        class="form-control">
                    </div>

                    <div class="form-group">
                        <input v-model="editUser.email" type="email" name="email" placeholder="Email"
                        class="form-control">
                    </div>

                    <div class="form-group">
                        <input v-model="editUser.phone" type="text" name="phone" placeholder="Phone"
                        class="form-control" >
                    </div>

                    <div style="width:48%; float:left;" class="form-group">
                        <select v-model="editUser.role" id="type" name="type" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>

                        </select>
                    </div>

                    <div style="width:48%; float:right;" class="form-group">
                        <select v-model="editUser.status" id="status" name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
        name: "Users",
        components: {
            headerComponent,
            footerComponent
        },

        data() {
          return {
            userList:[],
            editUser:{
                'name':'', 'email':'', 'phone':'', 'role':'', 'status':'', 'id' :''
            },
            form: new Form({
                name: '',
                email: '',
                phone:'',
                type:'',
                status:'',
                password: '',
                confirmpassword:'',

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

            createUser() {
                if(this.form.password == this.form.confirmpassword){
                    this.form.post("/storeUser").then(() => {
                        this.viewUserDetails();
                        this.form.reset();
                            Toast.fire({
                                icon: "success",
                                title: "User Added Successfully"
                            });
                    });
                }else{
                    Toast.fire({
                        icon: "danger",
                        title: "Password Doesn't Matched"
                    });
                }

            },

            updateUser(){
                axios
                .post(`/update-user-details`, this.editUser)
                .then(response => {
                this.viewUserDetails();
                    Toast.fire({
                        icon: "success",
                        title: "User Updated Successfully"
                    });
                });
            },

            editUserById(user) {
                for(let index in this.editUser){
                    if(user.hasOwnProperty(index)){
                        this.editUser[index] = user[index];
                    }
                }
            },

            deleteUser(user){
                axios
                .post(`/deleteUserById/`,user)
                .then(response => {
                this.viewUserDetails();
                    Toast.fire({
                        icon: "success",
                        title: "User Deleted Successfully"
                    });
                });
            },
        }
    }
</script>
