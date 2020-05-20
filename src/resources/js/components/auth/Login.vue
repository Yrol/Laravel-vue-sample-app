<template>
  <v-form ref="form" v-model="valid" lazy-validation>
    <!-- Email -->
    <v-text-field v-model="email" :rules="emailRules" label="E-mail" required></v-text-field>

    <!-- Password -->
    <v-text-field
      v-model="password"
      :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
      :rules="passwordRules"
      :type="show ? 'text' : 'password'"
      name="password"
      label="password"
      required
      hint="At least 8 characters"
      value
      class="input-group--focused"
      @click:append="show = !show"
    ></v-text-field>

    <v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">Sign up</v-btn>

    <v-btn color="error" class="mr-4" @click="reset">Reset Form</v-btn>
  </v-form>
</template>

<script>
import { validationMixin } from "vuelidate";
import User from "../../helpers/User"
import router from "../../router/Router"
import { required, maxLength, email } from "vuelidate/lib/validators";

export default {

    created() {
        if(User.loggedIn()){
            router.push({ name: 'forum'})
        }
    },

  //values that'll be return on submission. Binding values
  data() {
    return {
      valid : true,

      //email
      emailServerErrors: 'test error',
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],

      //password
      show: false,
      password: '',
      passwordRules: [
         value => !!value || "Required.",
         v => (!v ||v && v.length >= 8) || 'Minimum length is 8 characters'
      ]
    };
  },

  methods: {
      submit () {
        const validateForrm = this.$refs.form.validate()
        if(validateForrm) {
            let data = { email: this.email, password: this.password }
            User.login(data)
        }
      },
      reset () {
        this.$refs.form.reset()
      },
  }
};
</script>

<style>
/* .login-text { margin-bottom: 1000px;} */
</style>
