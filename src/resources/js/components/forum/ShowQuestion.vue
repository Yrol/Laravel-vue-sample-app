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
    <v-card-title primary-title>
      <div>
        <h6>{{question.date_readable}}</h6>
      </div>
    </v-card-title>
  </v-card>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      question: null
    };
  },
  created() {
    axios
      .get(`/api/questions/${this.$route.params.slug}`) // Using the Vue Route to get a single by slug (slug is the ID used for getting a single question: ex: http://localhost:8080/question/nemo-suscipit-fugiat-in-earum-dicta)
      .then(res => (this.question = res.data.data));
  },
  computed: {
      question_body(){
          return md.parse(this.question.body)
      }
  }
};
</script>
