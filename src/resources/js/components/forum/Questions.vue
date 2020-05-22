<template>
  <v-card>
    <v-card-text>
      <v-layout align-center>
        <v-flex xs7>
          <p class="text-xs-left">
            <router-link :to="question_data.path">
                <b>{{question_data.title}}</b>
            </router-link>
          </p>
        </v-flex>
      </v-layout>
    </v-card-text>
    <v-card-title primary-title>
      <div>
        <h6>{{question_data.date_readable}}</h6>
      </div>
    </v-card-title>
  </v-card>
</template>

<script>
export default {
  //question prop to get the question
  props: ["question_data"]
};
</script>
</script>

