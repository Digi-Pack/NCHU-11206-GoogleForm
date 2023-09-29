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
    <span>假的導覽頁(等待前端導覽頁中.....)</span>
    <br>
    <span>目前這頁做好的功能：可以看到從edit/index頁面新增的表單</span>
    <br>
    <span>新增的表單點進去可以修改表單內容</span>
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
