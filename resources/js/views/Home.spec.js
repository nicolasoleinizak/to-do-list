import { mount } from '@vue/test-utils';
import Home from './Home.vue';
import { describe, it, expect } from 'vitest';

describe('Home component', () => {
  describe('Elements renderitazion', () => {
    const wrapper = mount(Home);
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
  })
});