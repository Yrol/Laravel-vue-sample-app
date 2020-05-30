<template>
  <v-container class="grey lighten-5">
    <v-row no-gutters>
      <v-col cols="12" sm="6" md="8">
        <question
        v-for="question in questions"
        :key="question.id"
        :question_data=question
         />
      </v-col>
      <v-col cols="6" md="4">
        <v-card class="pa-2" outlined tile>sidebar</v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import question from "./Questions";
import axios, {AxiosResponse} from 'axios';
export default {

  data() {
      return {
          questions: {}
      }
  },

  components: { question },

  created(){
      axios.get('/api/questions')
      .then(res => this.questions = res.data.data) // assigining to the "questions variable above"
      .catch(error => console.log(error.response.data))
  }
};
</script>
