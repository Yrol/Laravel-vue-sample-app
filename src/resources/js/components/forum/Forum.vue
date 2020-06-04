<template>
  <v-container class="grey lighten-5">
    <div v-if="questions">
      <v-row no-gutters>
        <v-col cols="12" sm="6" md="8">
          <question v-for="question in questions" :key="question.id" :question_data="question" />

          <div class="text-center">
            <v-pagination v-model="page" :length="meta.last_page" @input="changePage"></v-pagination>
          </div>
        </v-col>
        <v-col cols="6" md="4">
          <v-card class="pa-2" outlined tile>sidebar</v-card>
        </v-col>
      </v-row>
    </div>
  </v-container>
</template>

<script>
import question from "./Questions";
import axios, { AxiosResponse } from "axios";
export default {
  data() {
    return {
      questions: {},
      page: 1,
      meta: {} // meta holds the pagination metadata ( suchs as next & previous page indexes) returned by Laravel pagination
    };
  },

  components: { question },

  created() {
      this.getData(1)
  },

  methods:{

      //pagination method
      changePage(page){
          this.getData(page)
      },

      getData(page){
        axios
            .get(`/api/questions?page=${page}`)
            .then(res => {
                this.questions = res.data.data
                this.meta = res.data.meta
        }) // assigining to the "questions variable above"
        .catch(error => console.log(error.response.data));
      }
  }
};
</script>

