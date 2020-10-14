<template>
  <div>
    <headerComponent></headerComponent>
    <div class="content-wrapper height-wrap">
      <div class="content">
        <div class="container-fluid">
          <div class="container">
            <div class="row mt-5">

              <div class="col-md-12" style="float:left;">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Library Settings</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <form>
                      <div style="float:left;" class="col-md-6">
                        <div class="form-group">
                            <label>Library Title</label>
                            <input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }"
                            type="text" placeholder="Library Title" class="form-control">
                            <has-error :form="form" field="title"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Contact No.</label>
                            <input v-model="form.mobile" :class="{ 'is-invalid': form.errors.has('mobile') }"
                            type="text" placeholder="Mobile" class="form-control">
                            <has-error :form="form" field="mobile"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }"
                            type="text" placeholder="Address" class="form-control"></textarea>
                            <has-error :form="form" field="address"></has-error>
                        </div>
                    </div>


                    <div style="float:right;" class="col-md-6">
                        <div class="form-group">
                            <label>Logo</label>
                        <div class="input-group">
                            <div class="custom-file file-input-style">

                                <img :src="editMode ? updateImage() : form.logo" class="img-style" />
                                <input  @change="changePhoto($event)" type="file"
                                 class="custom-file-input input-new-style" id="exampleInputFile">

                                 <!-- <img class="img-style" :src="`/images/${form.logo}`"/>
                                <input  @change="changePhoto($event)" type="file"
                                class="custom-file-input input-new-style" id="exampleInputFile"> -->

                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-12" >
                        <div class="form-group" style="float:right; padding-right:0px">
                            <button type="button" class="btn btn-danger" >Cancel</button>
                            <button @click.prevent="editMode ? updateSettings():createSettings()" type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>


                  </div>
                  <!-- /.card-body -->
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

export default {
  name: "Settings",
  data() {
    return {
        dataList: "",
        editMode: false,
        form: new Form({
            title: "",
            mobile: "",
            address: "",
            logo: "",
            id : "",
        }),
    };
  },
  created(){
     axios.get('/getSettingData')
        .then((response)=>{
          if(response.data.data == ''){
            this.editMode = false;
          }else{
            this.editMode = true;
            
          }
            
        })
  },
  methods: {

      viewSettingsData(){
          axios.get('/getSettingData')
            .then((response)=>{
                this.dataList = response.data.data;

                this.dataList.forEach(el => {
                    this.form.title = el.title;
                    this.form.mobile = el.mobile;
                    this.form.address = el.address;
                    this.form.logo = el.logo;
                    this.form.id = el.id;

                });
            })
      },

      createSettings(){

        this.form.post('/storeSetting')
        .then(() => {
            Toast.fire({
                icon: 'success',
                title: 'Setting Saved Successfully'
            })
        })
          
     },

     updateSettings(){
       
        this.form.post('/updateSetting/'+this.form.id)
        .then(() => {
            Toast.fire({
                icon: 'success',
                title: 'Setting Updated Successfully'
            })
        })    
     },

     updateImage() {
      var img = this.form.logo;
      if (img.length > 100) {
        return this.form.logo;
      } else {
        return "/images/" + this.form.logo;
      }
    },

      ourImage(img) {
            return "/images/" + img;
        },

        changePhoto(event) {
            let file = event.target.files[0];
            let reader = new FileReader();
            reader.onload = event => {
                this.form.logo = event.target.result;
            };
            reader.readAsDataURL(file);

        },



  },

  computed:{

  },

  components: {
    headerComponent,
    footerComponent
  },

  mounted() {
      this.viewSettingsData();
  }
};
</script>
<style scoped>
.file-input-style{
    border: dashed 1.5px blue;
    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
    height: 180px !important;
    max-width: 200px !important;
    /* margin-left: 50px !important; */
    margin:auto;
}
.input-new-style{
    margin-left: -100%;
    height: 180px;
    border: dashed 1.5px blue;
    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
    width: 100% !important;
    cursor: pointer;
}
.icon-style{
    font-size: 50px;
    margin-left: 145px;
    margin-top:5px;
}

.img-style{
    width: 200px !important;
    height: 180px !important;
}
</style>
