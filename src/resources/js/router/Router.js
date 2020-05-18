import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/login/Login'
import SignUp from '../components/signup/SignUp'

Vue.use(VueRouter)

//routes of the application
const routes = [
    { path:  '/login', component: Login },
    { path:  '/signup', component: SignUp }
]

const router = new VueRouter({
    routes,
    hashbang: false, // remove the has after domain: ex: http://localhost:8080/#/login
    mode: 'history'
})

export default router
