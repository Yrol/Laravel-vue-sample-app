<!-- View for Creating  a new question -->
<template>
  <!-- Make sure the categories are loaded before loading teh entire view-->
  <div v-if="categoriesLoaded">
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-combobox
        v-model="category.value"
        :items="categoryItems"
        label="Select a question category"
        :error-messages="category.error"
        required
      ></v-combobox>
      <v-divider></v-divider>
      <v-text-field v-model="title.value" label="Title" :error-messages="title.error" required></v-text-field>
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
      <vue-simplemde v-model="question.value" :error-messages="question.error" required ref="markdownEditor" />
      <v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">Update</v-btn>
      <v-btn color="error" class="mr-4" @click="cancel">Cancel</v-btn>
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
      title: {
          value: this.question_data.title,
          error: ''
      },

      titleRules: [
        value => !!value || "Required.",
        v => (!v ||v && v.length >= 8) || 'Minimum length is 8 characters'
      ],

      //Question
      question: {
          value: this.question_data.body,
          error: ''
      },
      questionRules: [
         value => !!value || "Required.",
         v => (!v ||v && v.length >= 8) || 'Minimum length is 8 characters'
      ],

      //Category
      category: {
          value: '',
          error: ''
      },
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
        this.getCategories()
    },

  methods: {

    getCategories() {
        axios.get('/api/categories')
        .then(res => this.processCategories(res.data.data))
    },

    submit() {
        const validateForrm = this.$refs.form.validate()
        const current_path = `/question/${this.question_data.slug}`
        if(validateForrm) {
            let formData = { category_id: this.category.value.value, title: this.title.value, body: this.question.value }
            axios.put (`/api/questions/${this.question_data.slug}`, formData)
            .then(res => {

                //this to avoid the "NavigationDuplicated" error when the title remain the same (slug) and try to route push to the same path
                if(current_path !== res.data.path) {
                    console.log(`Data path: ${res.data.path}`)
                    this.$router.push(res.data.path) // redirecting the user to the newly created question page
                }
                EventBus.$emit('finishEdit')
            })
            .catch(error => {
                this.question.error = error.response.data.errors.body,
                this.title.error = error.response.data.errors.title
                this.category.error = error.response.data.errors.category_id
            })
        }
    },

    //cancel the edit
    cancel() {
        EventBus.$emit('finishEdit')
    },

    // reset() {
    //   this.$refs.form.reset();
    // },

    //process and adding the categories into the categories array
    processCategories(catData) {
        for (let [key, value] of Object.entries(catData)) {

            //selected category
            if(key == this.question_data.category_id) {
                this.category.value = { text: value.name, value: value.id }
            }
            var itemObj = { text: value.name, value: value.id }
            this.categoryItems.push(itemObj)
        }
        this.categoriesLoaded = true
    }
  }
};
</script>
