<!-- View for Creating  a new question -->
<template>
<div v-if="categories">
    <v-form ref="form" v-model="valid" lazy-validation>
    <v-combobox
        v-model="category.value"
        :items="categoryItems"
        label="Select a question category"
        :rules="categoryRules"
        :error-messages="category.error"
        required
    ></v-combobox>
    <v-divider></v-divider>
    <v-text-field v-model="title.value" :rules="titleRules" :error-messages="title.error" label="Title"></v-text-field>
    <v-divider></v-divider>
    <!-- <v-textarea
      v-model="question"
      label="Question"
      counter
      maxlength="120"
      full-width
      single-line
      :rules="questionRules"
    ></v-textarea> -->

    <!-- Using the markdownEditor (WYSWYG) library-->
    <vue-simplemde v-model="question.value" :error-messages="question.error" ref="markdownEditor" />

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
    data: () => ({
        valid: true,

      //Question title
      title: {
          value:'',
          error:''
      },
      titleRules: [
        value => !!value || "Required.",
        v => (!v ||v && v.length >= 8) || 'Minimum length is 8 characters'
      ],

      //Question
      question: {
          value: '',
          error: ''
      },
      questionRules: [
         value => !!value || "Required.",
         v => (!v ||v && v.length >= 8) || 'Minimum length is 8 characters'
      ],

      //Category
      categories: null,
      category: {
          value: '',
          error: ''
      },
      categoryRules: [
          value => !!value || "Required.",
      ],
      categoryItems: [],


      //object that holds the errors which can be used for outputting errors when required
      errors:{}
    }),

    created() {
        this.getCategories()
    },

  methods: {

    getCategories() {
        axios.get('/api/categories')
        .then(res => {
            this.categories = res.data.data
            this.processCategories(this.categories)
        })
    },

    submit() {
        const validateForrm = this.$refs.form.validate()
        if(validateForrm) {
            let formData = { category_id: this.category.value.value, title: this.title.value, body: this.question.value }
            axios.post('/api/questions', formData)
            .then(res => this.$router.push(res.data.path)) // redirecting the user to the newly created question page
            .catch(error => {
                this.question.error = error.response.data.errors.body,
                this.title.error = error.response.data.errors.title
                this.category.error = error.response.data.errors.category_id
            })
        }
    },

    reset() {
      this.$refs.form.reset();
    },

    //process and adding the categories into the categories array
    processCategories(catData) {
        for (let [key, value] of Object.entries(catData)) {
            var itemObj = { text: value.name, value: value.id }
            this.categoryItems.push(itemObj)
        }
    }
  }
};
</script>
