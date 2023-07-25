import { mount } from '@vue/test-utils';
import Home from './Home.vue';
import { describe, it, expect, vi } from 'vitest';

const routerMock = {
  push: vi.fn(() => {}),
}

const todos = [
  {
    id: 1,
    body: 'test-todo-1',
    is_prioritary: 0,
    is_completed: 0
  },
  {
    id: 2,
    body: 'test-todo-2',
    is_prioritary: 0,
    is_completed: 1
  }
]

vi.mock('../../services/todosService.js', () => ({
  getTodosService: vi.fn(async () => todos),
  createTodoService: vi.fn(async (data) => {
    const nextId = Math.max(...todos.map((todo) => todo.id))+1;
    const newTodo = {
      id: nextId,
      ...data,
      is_prioritary: 0,
      is_completed: 0
    };
    return {
      data: {
        todo: newTodo
      }
    };
  }),
  deleteTodoService: vi.fn(async (id) => {
    const todoIndex = todos.findIndex((todo) => todo.id == id);
    todos.splice(todoIndex, 1);
    return true;
  }),
  updateTodoService: vi.fn(async (data) => {
    const todoIndex = todos.findIndex((todo) => todo.id == data.id);
    todos.splice(todoIndex, 1, data);
    return true;
  })
}))


describe('Home component', () => {
  describe('Elements renderitazion', () => {
    const wrapper = mount(Home, {
        global: {
          mocks: {
            $router: routerMock
          }
        }
    });
    it('Should render a v-app-bar element', () => {
      expect(wrapper.find('v-app-bar').exists()).toBe(true);
    })
    it('Should render a v-app-bar-nav element', () => {
      expect(wrapper.find('v-app-bar-nav-icon').exists()).toBe(true);
    })
    it('Should render a v-icon element', () => {
      expect(wrapper.find('v-icon').exists()).toBe(true);
    })
    it('Should render the logo svg', () => {
      expect(wrapper.find('svg').exists()).toBe(true);
    })
  });

  describe('Todos CRUD', () => {
    const wrapper = mount(Home, {
      global: {
        mocks: {
          $router: routerMock
        }
      }
    });
    describe('Todo listing', () => {
      it('Should list the items', () => {
        expect(wrapper.text()).toContain(todos[0].body)
        expect(wrapper.text()).toContain(todos[1].body)
      })
    });
    describe('Todo creation', () => {
      it('Should add a new item to the list when clicking "new" button', async () => {
        await wrapper.find('#new-item-button').trigger('click');
        expect(wrapper.text()).toContain('New task')
      })
    });
    describe('Todo deletion', () => {
      it('Should remove an item from the list', async () => {
        wrapper.vm.handleItemDelete(1);
        expect(todos.length).toBe(2);
      })
    });
    describe('Todo update', () => {
      it('Should update an item body when it is requested', async () => {
        const modifiedItem = {
          ...todos[0],
          body: 'New body'
        };
        await wrapper.vm.handleItemChange(modifiedItem);
        expect(wrapper.text()).toContain('New body');
      })
    })
  })
});