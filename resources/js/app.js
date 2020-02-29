
require('./bootstrap');


import { Form, HasError, AlertError } from 'vform'
import VueRouter from 'vue-router'
import swal from 'sweetalert2'
import VueProgressBar from 'vue-progressbar'
import jsPDF from 'jspdf'
import  'jspdf-autotable'

window.Vue = require('vue');
window.Form = Form
window.swal = swal
window.jsPDF = jsPDF

Vue.use(VueProgressBar, {
    color: 'rgb(143,255,199)',
    failedColor:'red',
    height: '2px'
})

const Toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
    // timerProgressBar: true,
    // onOpen: (toast) => {
    //     toast.addEventListener('mouseenter', Swal.stopTimer)
    //     toast.addEventListener('mouseleave', Swal.resumeTimer)
    // }
})

window.Toast = Toast

window.Fire = new Vue()


Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.use(VueRouter)
Vue.component('pagination', require('laravel-vue-pagination'));

// Vue.prototype.$userId =  document.querySelector("meta[name='user-id']").getAttribute('content');
const routes = [
    {path: '/profile', component: require('./components/Profile.vue').default},
    {path: '/home', component: require('./components/Home.vue').default},
    {path: '/menu', component: require('./components/Menu.vue').default},
    {path: '/invoice', component: require('./components/Invoice.vue').default},
    {path: '/reports', component: require('./components/Reports.vue').default},
    {path: '/sell', component: require('./components/Sell.vue').default},
    {path: '*', component: require('./components/Home.vue').default},


]


const router = new VueRouter({
    mode:'history',
    routes
})



const app = new Vue({
    el: '#app',
    router
});
