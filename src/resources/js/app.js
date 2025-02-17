/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vuetify from 'vuetify'
import router from './router/Router.js'
import User from './helpers/User'
import VueSimplemde from 'vue-simplemde'
import md from "marked"
//import question from './components/forum/Question'

require('./bootstrap');

window.Vue = require('vue')
Vue.use(Vuetify)

//making the markdown editor global
window.md = md

//adding the "User" object globally within the application
window.User = User

//"EventBus" is the custom event that we'll be using to emit the logout event and listen to it in the Toolbar.vue
// Ideally we should use VueX rather than this.
window.EventBus = new Vue()


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Registering the component globally  "AppHome" in "/resources/js/components/AppHome.vue" - this is the entry point (default) of the application ()
Vue.component('AppHome', require('./components/AppHome.vue').default)

//registering the question component globally
//Vue.component('question-component', question);

//Registering the VueSimplemde globally
Vue.component('vue-simplemde', VueSimplemde)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });


const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router // adding the routes handler file
});
