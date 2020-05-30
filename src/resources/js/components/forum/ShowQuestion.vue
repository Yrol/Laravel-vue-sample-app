<template>
    <v-card>
        <readQuestion
            v-if="question"
            :is_owner=is_owner
            :question_data=question
        />
    </v-card>
</template>

<script>
import readQuestion from "./ReadQuestion";

export default {
  data() {
    return {
      question: null,
      is_owner: false,
      editMode: false
    };
  },
  created() {
    this.getQuestion()
    this.initiateEditMode()
  },


  components: {
      readQuestion
  },

  methods: {
    //getting the question from the DB.
    getQuestion() {
      axios
        .get(`/api/questions/${this.$route.params.slug}`) // Using the Vue Route to get a single by slug (slug is the ID used for getting a single question: ex: http://localhost:8080/question/nemo-suscipit-fugiat-in-earum-dicta)
        .then(res => {
            (this.question = res.data.data),
            (this.is_owner = this.question.uid === User.getUserID() ? true : false);
        });
    },

    initiateEditMode() {
        EventBus.$on('enableEdit', () => {
            this.editMode = true
        });
    }
  }
};
</script>
