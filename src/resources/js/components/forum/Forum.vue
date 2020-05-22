<template>
  <v-container class="grey lighten-5">
    <v-row no-gutters>
      <v-col cols="12" sm="6" md="8">
        <question />
      </v-col>
      <v-col cols="6" md="4">
        <v-card class="pa-2" outlined tile>sidebar</v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import question from "./Question";
name: "QuestionComponent";
export default {
  components: { question }
};
</script>
