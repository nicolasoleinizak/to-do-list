<script>
  import { formRules } from '../helpers/formRules';
  import AuthForm from '../components/AuthForm.vue';

  export default{
    data: () => ({
      email: "",
      password: "",
      emailRules: [
        formRules.email,
      ],
    }),
    methods: {
      login () {
        alert("Login");
        this.$router.push('/')
      },
    },
    components: {
      AuthForm
    }
  }
</script>

<template>
  <AuthForm title="Login">
    <v-form class="w-100 align-center">
      <v-text-field label="Email" type="email" v-model="email" :rules="emailRules"/>
      <v-text-field label="Password" type="password"/>
      <v-container class="d-flex flex-wrap justify-center">
        <v-btn variant="flat" color="primary" class="ma-3 px-15" @click="this.login">Log in</v-btn>
        <router-link to="/register"><v-btn variant="outlined" color="primary" class="ma-3">Create account</v-btn></router-link>
      </v-container>
    </v-form>
  </AuthForm>
</template>
