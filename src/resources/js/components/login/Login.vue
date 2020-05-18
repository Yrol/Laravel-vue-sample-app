<template>
  <form id="loginForm">
    <!-- Email -->
    <v-text-field
      v-model="email"
      :error-messages="emailErrors"
      label="E-mail"
      name="email"
      required
      @input="$v.email.$touch()"
      @blur="$v.email.$touch()"
    ></v-text-field>

    <!-- Password -->
    <v-text-field
      v-model="password"
      :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
      :rules="[passwordRules.required, passwordRules.min]"
      :type="show ? 'text' : 'password'"
      name="password"
      label="password"
      required
      hint="At least 8 characters"
      value
      class="input-group--focused"
      @click:append="show = !show"
    ></v-text-field>

    <v-btn class="mr-4" @click="submit">submit</v-btn>
    <v-btn @click="clear">clear</v-btn>
  </form>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, maxLength, email } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],

  validations: {
    email: { required, email }
  },

  //values that'll be return on submission. Binding values
  data() {
    return {
      email: "",
      password: "",
      show: false,
      passwordRules: {
        required: value => !!value || "Required.",
        min: v => v.length >= 8 || "Min 8 characters"
      }
    };
  },

  computed: {
    emailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) return errors;
      !this.$v.email.email && errors.push("Must be valid e-mail");
      !this.$v.email.required && errors.push("E-mail is required");
      return errors;
    }
  },

  methods: {
    submit() {
      this.$v.$touch();
      let data = { email: this.email, password: this.password };
      User.login(data);
    },
    clear() {
      this.$v.$reset();
      this.email = "";
      this.password = "";
    }
  }
};
</script>

<style>
/* .login-text { margin-bottom: 1000px;} */
</style>
