import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/login/Login'

Vue.use(VueRouter)


const routes = [
    { path:  '/login', component: Login }
]

const router = new VueRouter({
    routes,
    hashbang: false, // remove the has after domain: ex: http://localhost:8080/#/login
    mode: 'history'
})

export default router
