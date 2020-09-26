<template>
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html">
        <b>Library</b>Management
      </a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form @submit.prevent="login()">
          <div class="form-group has-feedback">
            <input v-model="form.email" type="email" class="form-control" placeholder="Email" />
            <span class="fa fa-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input v-model="form.password" type="password" class="form-control" placeholder="Password" />
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" /> Remember Me
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>

        <p class="mb-1">
          <a href="#">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            form: new Form({
                email:"",
                password:""
            })
        }
    },
    methods:{
        login(){
            this.form.post('/login')
            .then((response)=>{
                this.$router.push('/dashboard');
                Toast.fire({
                    icon:"success",
                    title:"login successfull."
                })
            })
        }
    }
};
</script>

<style>

</style>
