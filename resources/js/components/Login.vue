<template>
  <div class="login-box">
    <div class="login-logo">
      <a href="#" style="font-size:30px; color: lightblue">
        <strong>IDEA TECH</strong> LIBRARY MANAGEMENT SYSTEM
      </a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form @submit.prevent="login()">
          <div class="form-group">
            <input v-model="form.email" name="email" type="text" class="form-control" placeholder="Username/email" />
          </div>
          <div class="form-group">
            <input v-model="form.password" name="password" type="password" class="form-control" placeholder="Password" />
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
<!--
        <p class="mb-1">
          <a href="#">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="#" class="text-center">Register a new membership</a>
        </p>
		-->
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
              console.log(response.data.error)
              if(response.data.status == 500){
                  Toast.fire({
                      icon:"warning",
                      title:"Wrong Credential or Inactive. Contact with Admin!"
                  })
              }else{
                  localStorage.setItem("inventory", response.data.access_token);
                  this.$router.push('/sales');
                  window.location.reload();
                  Toast.fire({
                      icon:"success",
                      title:"Successfully Login."
                  })
              }
            })
        }
    }
};
</script>

<style>

</style>
