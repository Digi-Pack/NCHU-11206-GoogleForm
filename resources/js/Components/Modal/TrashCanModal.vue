<script>
import close from '/images/close.svg';

export default {
  props: {
    formUrl: String,
  },
  emits: [
    'closeModel',
  ],
  data() {
    return {
      close,
    };
  },
  mounted() {
    // console.log(this.formUrl);
  },
  methods: {
    closing() {
      this.$emit('closeModel');
    },
  },
};
</script>

<template>
  <section id="TrashCanModal">
    <div class="container">
      <div class="content">
        <div class="flex justify-between items-center">
          <h1 class="text-[24px] text-black">檔案已移至垃圾桶</h1>
          <button type="button" class="text-[28px] font-bold text-black" @click="closing()">
            <img :src="close" alt="">
          </button>
        </div>
        <div class="pt-[15px]">
          <div>
            <span>「未命名表單」</span>
            <span>將於30天後永刪除。如果這個檔案已與他人共用,協作者在檔案永久刪除前仍可另存副本。如要存取這個檔案,請將這個檔案移出垃圾桶。</span>
          </div>
          <div class="flex justify-start mt-7">
            <button type="button" class="btn px-5 py-2 border border-grey-light bg-grey-middle hover:bg-blue-light hover:shadow rounded-[10px] mr-3"
              @click="closing()">移出垃圾桶</button>
            <button type="button"
              class="btn px-5 py-2 rounded-[10px] bg-blue text-white hover:shadow hover:shadow-gray-400">前往表單主頁面</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#TrashCanModal {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#e6e6e65a] z-20;

    .content {
      @apply w-[500px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-8;
    }
  }
}
</style>
