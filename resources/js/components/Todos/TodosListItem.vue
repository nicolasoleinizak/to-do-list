<script>
  import ItemButton from './ItemButton.vue';

  export default {
    data() {
      return {
        isEditing: false
      }
    },
    methods: {
      toggleCompleted: function(value) {
        this.handleChange({
          ...this.item,
          is_completed: value,
        })
      },
      togglePrioritary: function(value) {
        this.handleChange({
          ...this.item,
          is_prioritary: !this.item.is_prioritary,
        })
      },
      changeBody: function(value) {
        this.handleChange({
          ...this.item,
          body: value,
        })
      },
      handleChange: function (modifiedItem) {
        this.$emit('itemChange', modifiedItem)
      },
      handleDelete: function (id) {
        this.$emit('itemDelete', id);
      },
      handleBodyChange: function() {
        if(this.item.body !== ""){
          this.changeBody(this.item.body);
          this.isEditing = false;
        } else {
          alert("The taks text can not be empty.")
        }
      }
    },
    props: ['item'],
    components: { ItemButton },
    emits: ['itemChange', 'itemDelete']
  }
</script>

<template>
  <div fluid class="items-list-grid align-center">
    <div cols="1" class="flex-grow-0 flex-shrink-0">
      <v-checkbox hide-details v-bind:model-value="item.is_completed == true" @update:model-value="toggleCompleted"></v-checkbox>
    </div>
    <div cols="10" class="flex-grow-1 flex-shrink-1" :class="item.is_completed && 'text-decoration-line-through'">
      <p v-if="!isEditing" @click="isEditing = true" class="task-body">{{ item.body }}</p>
      <div v-if="isEditing" class="body-field-grid align-center">
        <div>
          <v-text-field hide-details class="pa-0" v-model="item.body"></v-text-field>
        </div>
        <div>
          <ItemButton><v-icon icon="mdi-check" @click="handleBodyChange"></v-icon></ItemButton>
        </div>
      </div>
    </div>
    <div>
      <ItemButton :buttonColor="item.is_prioritary? 'highlight' : 'secondary'" @click="togglePrioritary">
        <v-icon icon="mdi-star"></v-icon>
      </ItemButton>
    </div>
    <div>
      <ItemButton><v-icon icon="mdi-delete" @click="() => handleDelete(item.id)"></v-icon></ItemButton>
    </div>
  </div>
</template>

<style>
  .task-body{
    min-width: 100px;
    min-height: 20px;
  }
  .items-list-grid{
    display: grid;
    grid-template-columns: 40px 1fr 40px 40px;
  }
  .body-field-grid{
    display: grid;
    grid-gap: 10px;
    grid-template-columns: 1fr 50px;
  }
</style>