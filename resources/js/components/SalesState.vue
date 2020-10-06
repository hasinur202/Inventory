<template>
    <div>
        <headerComponent></headerComponent>
        <div class="content-wrapper mybg">
            <div class="content">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Sales Statement</h3>
                                        <div class="card-tools">
                                            <button v-on:click="isHidden = !isHidden" class="btn btn-success">
                                                <i class="fas fa-eye fa-fw"></i> Show Report
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-6" style="float:left;">
                                            <div class="form-group">
                                                <label>Beginning Date</label>
                                                <input type="date" name="bday" max="3000-12-31"
                                                    min="1000-01-01" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="float:right;">
                                            <div class="form-group">
                                                <label >Ending Date</label>
                                                <input type="date" name="bday" min="1000-01-01"
                                                    max="3000-12-31" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                <div v-if="!isHidden" class="card">
                                    <div class="card-header" style="text-align:center;">
                                        <h3 class="card-title">Prothoma Publications</h3>
                                        <p>43-44 Aziz Co-op Super Market, Shahbag, Dhaka - 1000</p>
                                        <h4>Sales Statement: 17-05-2020 to 20-05-2020</h4>

                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>SI No.</th>
                                                    <th>Book Name</th>
                                                    <th>Author</th>
                                                    <th>ISBN</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>1</td>
                                                    <td>ইমাম ও নিশান</td>
                                                    <td>Gautam Bhadra</td>
                                                    <td>521554545312558</td>
                                                    <td>3</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Cloud IT Solution</td>
                                                    <td>Gautam Bhadra</td>
                                                    <td>5245454312558</td>
                                                    <td>10</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Chemistry</td>
                                                    <td>asfda Bhadra</td>
                                                    <td>521554545312558</td>
                                                    <td>5</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>ইমাম ও নিশান</td>
                                                    <td>Gautam Bhadra</td>
                                                    <td>521554545312558</td>
                                                    <td>3</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Mathematics</td>
                                                    <td>Gautam Bhadra</td>
                                                    <td>521554545312558</td>
                                                    <td>3</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Physics</td>
                                                    <td>Gautam Bhadra</td>
                                                    <td>521554545312558</td>
                                                    <td>3</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>ছবির চশমা
                                                    </td>
                                                    <td>Autham daslkj </td>
                                                    <td>521554545312558</td>
                                                    <td>15</td>
                                                </tr>

                                            </tbody>
                                        </table>
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
        name: "Stock",

        data(){
            return{
                isHidden: true
            }
        },
        created(){

        },

        computed:{


        },

        methods:{


        },

        components: {
            headerComponent,
            footerComponent
        },
        mounted() {

        }
    };

</script>
<style scoped>



</style>
