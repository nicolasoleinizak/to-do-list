<template>
  <v-app-bar>
    <v-app-bar-nav-icon>
      <v-icon icon="mdi-menu" />
    </v-app-bar-nav-icon>
    <v-app-bar-title><Logo class="in-bar-logo"></Logo></v-app-bar-title>
  </v-app-bar>
</template>

<script>
  import Logo from '../components/Logo.vue';
  export default{
    components: {
      Logo,
    },
  }
</script>

<style>
  .in-bar-logo{
    max-width: 200px;
  }
</style>
