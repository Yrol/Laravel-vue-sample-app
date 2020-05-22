<template>
  <div>
    <toolbar></toolbar>
    <!-- The body content goes inside "v-content" -->
   <v-content>
      <v-container fluid fill-height>
        <v-layout row wrap child-flex align-center style="position: relative;">
          <v-flex xs12 >
          <!-- "router-view" is the component that renders the matched component for a given path if exists: ex: /login -->
          <!-- "router-view" will inject coponents such as Forum. Login & etc to this block when using "router.push" -->
          <router-view></router-view>

          </v-flex>
        </v-layout>
      </v-container>
   </v-content>

    <app-footer></app-footer>
  </div>
</template>

<script>
import toolbar from "./Toolbar"
import AppFooter from "./AppFooter"
import Login from "./login/Login"
import SignUp from "./signup/SignUp"
import User from '../helpers/User'


export default {
  //components that'll be imported and used
  components: { toolbar, AppFooter, Login, SignUp }
};
</script>

<style>
</style>
