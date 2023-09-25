<script>
import { router } from '@inertiajs/vue3';

export default {
  props: {
    response: {
      type: Object,
      required: false,
      default: () => ({}),
    },
  },
  data() {
    return {
      see: [
        { title: '問題標題', desc: '問題說明', request: 1, image: '圖片檔案', video: '影片網址', type: 11, options: [{ id: 1, value: '我不好' }, { id: 2, value: '你覺得呢' }], linear: [{ min: 1, max: 10, minText: 0, maxText: 100 }], square: [{ row: [{ id: 1, text: '晴天' }, { id: 2, text: '陰天' }], column: [{ id: 1, text: '下雨' }, { id: 2, text: '大豪雨' }, { id: 3, text: '沒有下雨' }] }],
        },
      ],
    };
  },
  created() {
    console.log(this.response);
  },
  methods: {
    addclick() {
      const { see } = this;
      const jsonData = JSON.stringify(see);
      console.log(jsonData);
      router.visit(route('index.Store'), { method: 'post', data: { jsonData } });
    },
  },
};
</script>

<template>
  <section id="frontend-index">
    <h1 class="title">{{ title }}</h1>
    <div class="flex justify-center gap-5 mb-5">
      <Link :href="route('register')" class="btn-base">註冊</Link>
      <Link :href="route('dashboard')" class="btn-base">登入</Link>
    </div>
    <button type="button" class="border border-black" @click="addclick()">132</button>
  </section>
</template>

<style lang="scss" scoped>
#frontend-index {
  @apply w-full h-full overflow-y-auto;

  .title {
    @apply text-[6.25rem] text-center;
  }

}
</style>
