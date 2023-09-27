<script>
import sendLinkModal from '@/Components/Modal/SendLinkModal.vue';

export default {
  components: {
    sendLinkModal,
  },
  data() {
    return {
      show: false,
    };
  },
  methods: {
    open() {
      this.show = !this.show;
    },
  },
};
</script>

<template>
  <section>
    <SendLinkModal v-if="show">
    </SendLinkModal>
    <button type="button" @click="open()">點我</button>
  </section>
</template>

<style lang="scss" scoped>

</style>

