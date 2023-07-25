<template>
  <h2>{{title}}</h2>
  <v-list density="compact">
    <v-list-item
    v-for="item in items"
    :key="item.id"
    class="pa-0"
    >
      <TodosListItem :item="item" v-on:itemChange="handleItemChange" v-on:itemDelete="handleItemDelete"/>
    </v-list-item>
  </v-list>
</template>

<script>
  import TodosListItem from './TodosListItem.vue';

  export default{
    props: ['items', 'title'],
    methods: {
      handleItemChange: function (data) {
        this.$emit('itemChange', data);
      },
      handleItemDelete: function (id) {
        this.$emit('itemDelete', id);
      } 
    },
    components: { TodosListItem },
    emits: ['itemChange', 'itemDelete']
}
</script>