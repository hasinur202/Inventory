<template>
  <div>
     <router-view></router-view>

  </div>
</template>

<script>
export default {
    name:'app',
    data(){
        return{
            form: new Form({
                author:'',
                publisher:'',
                category:'',
            })
        }
    },

    methods:{
      createAuthor(){
        // Submit the form via a POST request
        this.form.post('/storeAuthor')
        .then(({ data }) => {
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

      }




    }
}
</script>
