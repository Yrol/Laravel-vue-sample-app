<template>
  <v-card>
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
          <p class="text-xs-left">
            {{question.body}}
          </p>
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
      question: {}
    };
  },
  created() {
    axios
      .get(`/api/questions/${this.$route.params.slug}`) // Using the Vue Route to get a single by slug (slug is the ID used for getting a single question: ex: http://localhost:8080/question/nemo-suscipit-fugiat-in-earum-dicta)
      .then(res => (this.question = res.data.data));
  }
};
</script>
