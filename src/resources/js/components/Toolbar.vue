<template>
  <v-card color="grey lighten-4" flat height="50px" tile>
    <v-toolbar dense>
      <v-toolbar-title>Title</v-toolbar-title>

      <v-spacer></v-spacer>

      <div>
        <!-- "router-link" is the component that enables the user to navigate to a given link-->
        <router-link to="/forum">
            <v-btn text>Forum</v-btn>
        </router-link>

        <router-link to="/ask-question">
            <v-btn text>Ask Question</v-btn>
        </router-link>
        <router-link to="/login">
            <v-btn text>Login</v-btn>
        </router-link>
        <router-link to="/signup">
            <v-btn text>Sign Up</v-btn>
        </router-link>
      </div>
    </v-toolbar>
  </v-card>
</template>

<script>

export default {
}
</script>

<style>
</style>
