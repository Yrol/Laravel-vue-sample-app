<template>
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <!-- Name -->
    <v-text-field
      v-model="name.value"
      :counter="20"
      :rules="nameRules"
      :error-messages="name.error"
      label="Name"
      required
    ></v-text-field>

    <!-- Email -->
    <v-text-field
      v-model="email.value"
      :rules="emailRules"
      :error-messages="email.error"
      label="E-mail"
      required
    ></v-text-field>

    <!-- Password -->
    <v-text-field
      v-model="password.value"
      :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
      :rules="passwordRules"
      :type="showPass ? 'text' : 'password'"
      name="password"
      :error-messages="password.error"
      label="password"
      required
      hint="At least 8 characters"
      value
      class="input-group--focused"
      @click:append="showPass = !showPass"
    ></v-text-field>

    <!-- Password confirmation -->
    <v-text-field
      v-model="passwordConfirmation.value"
      :append-icon="showPassConfirmation ? 'mdi-eye' : 'mdi-eye-off'"
      :rules="passwordConfirmationRules"
      :type="showPassConfirmation ? 'text' : 'password'"
      name="password_confirmation"
      label="password"
      required
      hint="At least 8 characters"
      value
      class="input-group--focused"
      @click:append="showPassConfirmation = !showPassConfirmation"
    ></v-text-field>

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="submit"
    >
      Sign up
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
      name: {
          value: '',
          error: ''
      },
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 10) || 'Name must be less than 10 characters',
      ],

      //email
      email: {
          value: '',
          error: ''
      },
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],

      //password
      showPass: false,
      password: {
          value: '',
          error: ''
      },
      passwordRules: [
         value => !!value || "Required.",
         v => (!v ||v && v.length >= 8) || 'Minimum length is 8 characters'
      ],

      //password confirmation
      showPassConfirmation: false,
      passwordConfirmation: {
          value: '',
          error: ''
      },
      passwordConfirmationRules: [
        v => !!v || "Confirm password"
      ]
    }),

    methods: {
      submit () {
        const validateForrm = this.$refs.form.validate()
        if(validateForrm) {
            let data = { name: this.name.value, email: this.email.value, password: this.password.value,  password_confirmation: this.passwordConfirmation.value }
            User.signup(data)
                .then(() => {
                    console.log('register successful we can redirect from this view')
                })
                .catch(error => {//Injecting serverside validation errors to the form in-case
                    this.name.error = error.response.data.errors.name,
                    this.email.error = error.response.data.errors.email,
                    this.password.error = error.response.data.errors.password
            })
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
