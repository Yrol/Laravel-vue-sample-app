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
            let formData = { category_id: this.category.value, title: this.title, body: this.question }
            axios.put (`/api/questions/${this.question_data.slug}`, formData)
            .then(res => {

                //this to avoid the "NavigationDuplicated" error when the title remain the same (slug) and try to route push to the same path
                if(current_path !== res.data.path) {
                    this.$router.push(res.data.path) // redirecting the user to the newly created question page
                }
                EventBus.$emit('finishEdit')
            })
            .catch(error => this.errors = error.response.data.error)
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
