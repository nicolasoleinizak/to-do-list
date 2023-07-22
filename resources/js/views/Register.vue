<script>
  import { formRules } from '../helpers/formRules';
  import AuthForm from '../components/AuthForm.vue';

  export default{
    data: function () {
      return {
        name: "",
        email: "",
        password: "",
        passwordConfirmation: "",
        emailRules: [
          formRules.email,
        ],
        passwordRules: [
          formRules.password,
        ],
        confirmationPasswordRules: [
          value => value === this.password || 'Passwords must match.',
        ]
      }
    },
    methods: {
      register () {
        alert("Register");
      },
    },
    components: {
      AuthForm
    }
  }
</script>

<template>
  <AuthForm title="Register">
    <v-form class="w-100 align-center">
      <v-text-field label="Name" type="name" v-model="name"/>
      <v-text-field label="Email" type="email" v-model="email" :rules="emailRules"/>
      <v-text-field label="Password" type="password" v-model="password" :rules="passwordRules"/>
      <v-text-field label="Password confirmation" type="password" v-model="passwordConfirmation" :rules="confirmationPasswordRules"/>
      <v-container class="d-flex flex-wrap justify-center">
        <v-btn variant="flat" color="primary" class="ma-3 px-15" @click="this.register">Register</v-btn>
        <router-link to="/login"><v-btn variant="outlined" color="primary" class="ma-3">Login</v-btn></router-link>
      </v-container>
    </v-form>
  </AuthForm>
</template>