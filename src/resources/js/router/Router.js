import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/auth/Login'
import Logout from '../components/auth/Logout'
import SignUp from '../components/signup/SignUp'
import Forum from '../components/forum/Forum'

Vue.use(VueRouter)

//routes of the application
const routes = [
    { path:  '/login', component: Login },
    { path: '/logout', component: Logout },
    { path:  '/signup', component: SignUp },
    { path: '/forum', component: Forum, name: 'forum' }
]

const router = new VueRouter({
    routes,
    hashbang: false, // remove the has after domain: ex: http://localhost:8080/#/login
    mode: 'history'
})

export default router
