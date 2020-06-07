<template>
  <v-container v-if="!loadingQuestions" class="grey lighten-5">
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
      loadingQuestions: false,
      questions: {},
      page: 1, //current page for pagination to be highlighted
      meta: {} // meta holds the pagination metadata ( suchs as next & previous page indexes) returned by Laravel pagination
    };
  },

  components: { question },

  created() {
      if(Math.sign(this.$route.params.pagination_id) > 0) {
        let pagination_id = parseInt(this.$route.params.pagination_id)
        this.page = pagination_id
        this.getData(pagination_id)
      }else{
        this.page = 1
        this.getData(1)
      }
  },

  methods:{

      //pagination method
      changePage(page){
          //go to the route - "/forum/:pagination_id"
          this.$router.push(`/forum/${page}`).catch(error => {
              console.log(error)
          });
          this.getData(page)
      },

      getData(page){
        this.loadingQuestions = true
        axios
            .get(`/api/questions?page=${page}`)
            .then(res => {
                if(!res.data.data) {
                    console.log('no data found - show message no data found')
                }
                this.questions = res.data.data
                this.meta = res.data.meta
                this.loadingQuestions = false
        }) // assigining to the "questions variable above"
        .catch(error => {
            //show error
            console.log(error.response.data)
            this.loadingQuestions = false
        });
      }
  }
};
</script>

