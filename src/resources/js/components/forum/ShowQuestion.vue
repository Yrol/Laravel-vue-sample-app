<template>
  <!-- Show v-card only if the question is loaded. That way we can remediate errors related property null issues -->
  <v-card v-if="question">
    <v-card-text>
      <v-layout align-center>
        <v-flex xs7>
          <div>
            <h2>{{question.title}}</h2>
          </div>
        </v-flex>
      </v-layout>
    </v-card-text>
    <v-card-text>
      <v-layout align-center>
        <v-flex mx-3>
          <!-- Defining as a computed property "question_body" parse the question data as html (since we're using a WYSIWYG editor to create questions )-->
          <p class="text-xs-left" v-html="question_body"></p>
        </v-flex>
      </v-layout>
    </v-card-text>
    <v-card-text>
      <h6>Created by: {{ question.user }} : [{{question.date_readable}}]</h6>
    </v-card-text>
    <v-card-text v-if="is_owner">
      <v-row>
        <v-col cols="12" sm="1">
          <v-btn class="mx-2" fab dark large color="cyan" @click="editQuestion">
            <v-icon dark>mdi-pencil</v-icon>
          </v-btn>
        </v-col>
        <v-col cols="12" sm="1">
          <v-btn class="mx-2" fab dark large color="orange" @click="deleteQuestion">
            <v-icon dark>mdi-delete</v-icon>
          </v-btn>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      question: null,
      is_owner: false
    };
  },
  created() {
    axios
      .get(`/api/questions/${this.$route.params.slug}`) // Using the Vue Route to get a single by slug (slug is the ID used for getting a single question: ex: http://localhost:8080/question/nemo-suscipit-fugiat-in-earum-dicta)
      .then(res => {
        (this.question = res.data.data),
        (this.is_owner = this.question.uid === User.getUserID() ? true : false);
      });
  },
  computed: {
    //render question body data in HTML format
    question_body() {
      return md.parse(this.question.body);
    }
  },

  methods: {
      editQuestion() {
          console.log('delete question')
      },

      deleteQuestion() {
          axios.delete(`/api/questions/${this.$route.params.slug}`)
          .then(res => {
              this.$router.push({name: 'forum'})
          })
      }
  }
}
</script>
