<script>
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import BackendLayout from '@/Layouts/BackendLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
  components: { FrontendLayout, BackendLayout, GuestLayout, AuthenticatedLayout },
  computed: {
    layoutPosition() {
      const { component = '' } = this.$page;
      const fileName = [
        { code: 'Frontend', com: 'FrontendLayout' },
        { code: 'Backend', com: 'BackendLayout' },
        { code: 'Auth', com: 'GuestLayout' },
        { code: 'Profile', com: 'BackendLayout' },
      ];
      const position = fileName.find(({ code }) => component.includes(code));
      return position?.com ?? 'AuthenticatedLayout';
    },
  },
};
</script>

<template>
  <section id="app-layout">
    <component :is="layoutPosition">
      <slot />
    </component>
  </section>
</template>
