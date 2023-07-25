<script>
  import Logo from '../components/Logo.vue';
  import TodosList from '../components/Todos/TodosList.vue';
  import { 
    getTodosService,
    updateTodoService,
    createTodoService,
    deleteTodoService,
  } from '../../services/todosService';

  export default{
    data() {
        return {
            items: [],
            baseTodo: {
              is_completed: false,
              is_prioritary: false,
            },
            drawer: false,
        };
    },
    methods: {
      getTodos: async function() {
        getTodosService().then((data) => this.items = data)
      },
      handleItemChange: async function(data) {
        const originalItem = this.items.find((item) => item.id == data.id);
        const itemIndex = this.items.findIndex((item) => item.id == data.id)
        this.items.splice(itemIndex, 1, data);
        try {
          await updateTodoService(data);
        } catch (error) {
          this.items.splice(itemIndex, 1, originalItem);
        }
      },
      createNewTodo: async function() {
        try {
          const {data: { todo }} = await createTodoService({
            body: "New task"
          });
          this.items.push({
            ...this.baseTodo,
            ...todo,
          });
        } catch (error) {
          alert('There was a problem trying to create a new item')
        }
      },
      handleItemDelete: async function(id) {
        try {
          await deleteTodoService(id);
          const itemIndex = this.items.findIndex((item) => item.id == id);
          this.items.splice(itemIndex,1);
        } catch (error) {
          alert('There was a problem trying to delete the item')
        }
      }
    },
    beforeMount() {
      if(!localStorage.token){
        this.$router.push('/login');
      }
    },
    mounted() {
      this.getTodos();
    },
    computed: {
      pendingTasks() {
        return this.items
          .filter((item) => !item.is_completed)
          .sort((a, b) => {
            if(a.is_prioritary && !b.is_prioritary) return -1
            if(!a.is_prioritary && b.is_prioritary ) return 1

            if(a.id > b.id) return 1;
            if(a.id < b.id) return -1;

            return 0;
          })
      },
      completedTasks() {
        return this.items
          .filter((item) => item.is_completed)
      }
    },
    components: {
      Logo,
      TodosList
    }
  }
</script>

<template>
  <v-container fluid class="pa-2 pa-sm-5 pa-lg-10">
    <v-app-bar>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer">
        <v-icon icon="mdi-menu" />
      </v-app-bar-nav-icon>
      <v-app-bar-title><Logo class="in-bar-logo"></Logo></v-app-bar-title>
    </v-app-bar>
    <v-main>
      <h1 fluid class="text-center">To do's</h1>
      <TodosList v-if="pendingTasks.length > 0" :items="pendingTasks" title="Pending" v-on:itemChange="handleItemChange" v-on:itemDelete="handleItemDelete"></TodosList>
      <v-container fluid class="text-center">
        <v-btn id="new-item-button" variant="outlined" @click="createNewTodo">New task</v-btn>
      </v-container>
      <v-divider></v-divider>
      <TodosList v-if="completedTasks.length > 0" :items="completedTasks" title="Completed" v-on:itemChange="handleItemChange" v-on:itemDelete="handleItemDelete"></TodosList>
    </v-main>
    <v-navigation-drawer
        v-model="drawer"
        location="bottom"
        temporary
      >
        <v-list>
          <v-list-item>
            <v-btn id="logout-button" block variant="outlined" @click="$emit('logout')">Logout</v-btn>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
  </v-container>
</template>

<style>
  .in-bar-logo{
    max-width: 200px;
  }
</style>
