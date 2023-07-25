<template>
  <v-btn class="circular-button pa-0" variant="outlined" :color="buttonColor">
    <slot></slot>
  </v-btn>
</template>

<script>
  export default {
    props: {
      buttonColor: {
        type: String,
        default: 'secondary'
      }
    }
  }
</script>

<style>
  .circular-button{
    min-width: 35px !important;
    width: 35px !important;
    height: 35px !important;
    border-radius: 17px !important;
  }
</style>