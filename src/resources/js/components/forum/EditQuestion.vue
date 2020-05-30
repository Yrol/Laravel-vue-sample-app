<!-- View for Creating  a new question -->
<template>
  <!-- Make sure the categories are loaded before loading teh entire view-->
  <div v-if="categoriesLoaded">
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-combobox
        v-model="category"
        :items="categoryItems"
        label="Select a question category"
        required
        :rules="categoryRules"
      ></v-combobox>
      <v-divider></v-divider>
      <v-text-field v-model="title" :rules="titleRules" label="Title" required></v-text-field>
      <v-divider></v-divider>
      <!-- <v-textarea
      v-model="question"
      label="Question"
      counter
      maxlength="120"
      full-width
      single-line
      :rules="questionRules"
      ></v-textarea>-->

      <!-- Using the markdownEditor (WYSWYG) library-->
      <vue-simplemde v-model="question" ref="markdownEditor" />
      <v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">Create</v-btn>
      <v-btn color="error" class="mr-4" @click="reset">Reset</v-btn>
    </v-form>
  </div>
</template>
<script>
import { required, maxLength } from "vuelidate/lib/validators";
import { validationMixin } from "vuelidate";
import axios from "axios";
export default {

props: ['question_data'],

  data() {
    return {
      valid: true,

      //Question title
      titleServerErrors: "test error",
      title: this.question_data.title,
      titleRules: [
        value => !!value || "Required.",
        v => (!v ||v && v.length >= 8) || 'Minimum length is 8 characters'
      ],

      //Question
      question: this.question_data.body,
      questionRules: [
         value => !!value || "Required.",
         v => (!v ||v && v.length >= 8) || 'Minimum length is 8 characters'
      ],

      //Category
      category:'',
      categoriesLoaded: false,
      categoryRules: [
          value => !!value || "Required.",
      ],
      categoryItems: [],


      //object that holds the errors which can be used for outputting errors when required
      errors:{}
    };
  },

    created() {
        console.log(this.question_data.slug)
        this.getCategories()
    },

  methods: {

    getCategories() {
        axios.get('/api/categories')
        .then(res => this.processCategories(res.data.data))
    },

    submit() {
        const validateForrm = this.$refs.form.validate()
        if(validateForrm) {
            let formData = { category_id: this.category.value, title: this.title, body: this.question }
            axios.put (`/api/questions/${this.question_data.slug}`, formData)
            .then(res => {
                this.$router.push(res.data.path) // redirecting the user to the newly created question page
                //this.$router.go(0)
                EventBus.$emit('finishEdit')
            })
            .catch(error => this.errors = error.response.data.error)
        }
    },

    reset() {
      this.$refs.form.reset();
    },

    //process and adding the categories into the categories array
    processCategories(catData) {
        for (let [key, value] of Object.entries(catData)) {
            console.log(value.id)
            if(key == this.question_data.category_id) {
                this.category = { text: value.name, value: value.id }
            }
            var itemObj = { text: value.name, value: value.id }
            this.categoryItems.push(itemObj)
        }
        this.categoriesLoaded = true
    }
  }
};
</script>
