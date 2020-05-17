<template>
  <div>
    <toolbar></toolbar>

    <!-- The body content goes inside "v-content" -->
      <v-container fluid fill-height>
        <v-layout justify-center align-center>
          <!-- "router-view" is the component that renders the matched component for a given path if exists: ex: /login -->
          <router-view></router-view>
        </v-layout>
      </v-container>

    <app-footer></app-footer>
  </div>
</template>

<script>
import toolbar from "./Toolbar";
import AppFooter from "./AppFooter";
import Login from "./login/Login";

export default {
  components: { toolbar, AppFooter, Login }
};
</script>

<style>
</style>
