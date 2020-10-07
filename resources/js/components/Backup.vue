<template>
  <div>
    <headerComponent></headerComponent>
    <div class="content-wrapper">
      <div class="content">
        <div class="container-fluid">

        <div class="container">
            <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="text-align:center; background: lightgreen !important;">
                        <h1>Database Backup</h1>
                    </div>
                <!-- /.card-header -->
                    <div class="card-body">

                        <a target="_blank" style="margin-left:2rem;"
                            class="btn btn-info btn-lg"
                            href="http://localhost/phpmyadmin/db_export.php?db=db_ims&token=ae89c9c110df55bc34ee7913cd654492">
                            <h2>Download</h2>
                        </a>


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
        name: "Backup",
        components: {
            headerComponent,
            footerComponent
        },

        data() {
          return {

          }
        },

        mounted() {
            this.viewUserDetails();
        },

        methods:{

        }
    }
</script>
