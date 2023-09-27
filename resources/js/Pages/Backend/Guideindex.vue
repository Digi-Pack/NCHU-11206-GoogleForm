<script>
export default {
  props: {
    response: {
      type: Object,
      required: true,
      default: () => {
        return {};
      },
    },
  },
};
</script>

<template>
  <section id="guideindex">
    <div v-for="item in response.rt_data" :key="item.id">
      <h1>{{ item.qu_naires_title }}</h1>
      <Link :href="route('edit.old', { id: item.id })">
        <button type="button" class="px-6 py-3 border border-black rounded-[5px]">編輯</button>
      </Link>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#guideindex {}
</style>
