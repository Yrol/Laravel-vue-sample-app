<template>
  <v-card color="grey lighten-4" flat height="50px" tile>
    <v-toolbar dense>
      <v-toolbar-title>Title</v-toolbar-title>

      <v-spacer></v-spacer>

      <div>
        <!-- "router-link" is the component that enables the user to navigate to a given link-->
        <!-- <router-link to="/forum">
            <v-btn text>Forum</v-btn>
        </router-link>

        <router-link to="/ask-question">
            <v-btn text>Ask Question</v-btn>
        </router-link>
        <router-link to="/login">
            <v-btn text>Login</v-btn>
        </router-link> -->

        <router-link
        v-for="item in items"
        :key="item.title"
        :to="item.to"
        v-if="item.show">
            <v-btn text>{{ item.title }}</v-btn>
        </router-link>
      </div>
    </v-toolbar>
  </v-card>
</template>

<script>

import User from '../helpers/User'

export default {
    data () {
        return {
            items: [
                {title: 'Forum', to: '/forum', show:true},
                {title: 'Ask Question', to: '/ask', show: User.loggedIn()}, // only show when the user is logged in
                {title: 'Sign up', to: '/signup', show: !User.loggedIn()}, // only show when the user is logged in
                {title: 'Login', to: '/login', show: !User.loggedIn()}, // only show when the user is NOT logged in
                {title: 'Logout', to: '/logout', show: User.loggedIn()}, // only show when the user is logged in
            ]
        }
    }
}
</script>

<style>
</style>
