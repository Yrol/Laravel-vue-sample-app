<template>
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <!-- Name -->
    <v-text-field
      v-model="name"
      :counter="20"
      :rules="nameRules"
      label="Name"
      required
    ></v-text-field>

    <!-- Email -->
    <v-text-field
      v-model="email"
      :rules="emailRules"
      label="E-mail"
      required
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

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="submit"
    >
      Submit
    </v-btn>

    <v-btn
      color="error"
      class="mr-4"
      @click="reset"
    >
      Reset Form
    </v-btn>

    <!-- <v-btn
      color="warning"
      @click="resetValidation"
    >
      Reset Validation
    </v-btn> -->
  </v-form>
</template>

<script>
  export default {
    data: () => ({
      valid: true,

      //name
      name: '',
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 10) || 'Name must be less than 10 characters',
      ],

      //email
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],

      //password
      show: false,
      password: '',
      passwordRules: {
        required: value => !!value || "Required.",
        min: v => v.length >= 8 || "Min 8 characters"
      }
    }),

    methods: {
      submit () {
        const validateForrm = this.$refs.form.validate()
        if(validateForrm) {
            let data = { name: this.name, email: this.email, password: this.password }
            User.signup(data)
        }
      },
      reset () {
        this.$refs.form.reset()
      },
    //   resetValidation () {
    //     this.$refs.form.resetValidation()
    //   },
    },
  }
</script>
