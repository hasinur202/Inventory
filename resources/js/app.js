require('./bootstrap');

window.Vue = require('vue');

// v select
import vSelect from 'vue-select'

Vue.component('v-select', vSelect)
    //end v-select

    //pagination
Vue.component('pagination', require('laravel-vue-pagination'));


//for print
import VueHtmlToPaper from 'vue-html-to-paper';
const options = {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    styles: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        'https://unpkg.com/kidlat-css/css/kidlat.css'
    ]
}

Vue.use(VueHtmlToPaper, options);
//end print


import moment from 'moment'
// Vue.filter('postTime', (vlaue) => {
//     return moment(value).fromNow();
// })
Vue.config.productionTip = false
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm')
    }
});


//v-form
import { Form, HasError, AlertError } from 'vform';
import routes from "./routes";

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
//vform end


import Swal from 'sweetalert2'
// CommonJS
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast;

import VueRouter from 'vue-router'
Vue.use(VueRouter)


const router = new VueRouter({
    mode: 'hash',
    routes
})



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



Vue.component('app', require('./components/App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    render: h => h('app'),
    router
}).$mount('#app');