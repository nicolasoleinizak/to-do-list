<script>
  import { formRules } from '../helpers/formRules';
  import TitleLogo from '../components/TitleLogo.vue';

  export default{
    data: () => ({
      email: "",
      password: "",
      emailRules: [
        formRules.email,
      ],
    }),
    methods: {
      register () {
        alert("Register");
      },
    },
    components: {
      TitleLogo
    }
  }
</script>

<template>
  <v-container class="bg-primary fill-height justify-center" fluid>
        <v-card fluid class="pa-6 rounded-lg w-100 h-100">
          <v-container fluid class="fill-height">
            <TitleLogo />
            <p class="text-h4 w-100 text-center">Register</p>
            <v-spacer></v-spacer>
            <v-form class="w-100 align-center">
              <v-text-field label="Email" type="email" v-model="email" :rules="emailRules"/>
              <v-text-field label="Password" type="password"/>
              <v-container class="d-flex flex-wrap justify-center">
                <v-btn variant="flat" color="primary" class="ma-3 px-15" @click="this.register">Register</v-btn>
                <router-link to="/login"><v-btn variant="outlined" color="primary" class="ma-3">Login</v-btn></router-link>
              </v-container>
            </v-form>
          </v-container>
        </v-card>
  </v-container>
</template>