import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/auth/Login'
import Logout from '../components/auth/Logout'
import SignUp from '../components/signup/SignUp'
import Forum from '../components/forum/Forum'
import ShowQuestion from '../components/forum/ShowQuestion'
import AskQuestion from '../components/forum/AskQuestion'

Vue.use(VueRouter)

//routes of the application
const routes = [
    { path:  '/login', component: Login },
    { path: '/logout', component: Logout },
    { path:  '/signup', component: SignUp },
    { path: '/forum', component: Forum, name: 'forum' },
    { path: '/ask', component: AskQuestion, name: 'ask' },
    { path: '/question/:slug', component: ShowQuestion, name: 'showquestion' } //Route for reading a single question by using the slug. Ex: http://localhost:8080/api/question/this-is-the-test-title
]

const router = new VueRouter({
    routes,
    hashbang: false, // remove the has after domain: ex: http://localhost:8080/#/login
    mode: 'history'
})

export default router
