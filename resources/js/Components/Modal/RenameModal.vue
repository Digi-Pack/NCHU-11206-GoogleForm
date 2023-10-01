<script>
import close from '/images/close.svg';

export default {
  props: {
    // show: Boolean, // 父组件传递的控制显示的属性
    modalData: Object,
  },
  data() {
    return {
      close,
      show: true,
      newName: '',
    };
  },
  methods: {
    closing() {
      this.show = false;
    },
    sendName() {
      // 在这里使用 modalData 数据
      console.log(this.modalData);
    },
  },
};
</script>

<template>
  <section v-if="show" id="RenameModal">
    <div class="container">
      <div class="content">
        <div class="flex justify-between items-center">
          <h1 class="text-[24px] text-black">重新命名</h1>
          <button type="button" class="text-[28px] font-bold text-black" @click="closing()">
            <img :src="close" alt="">
          </button>
        </div>
        <div class="pt-[15px]">
          <div>
            <div class="text-gray-400 text-lg">請輸入新的項目名稱:</div>
            {{ newName }}{{ modalData }}
            <input v-model=" newName " type="text" class="rounded-[5px] leading-5 mt-5 w-full">
          </div>
          <div class="flex justify-end mt-7">
            <button type="button" class="btn px-5 py-2 border border-grey text-purple hover:bg-blue-light hover:shadow rounded-[10px] mr-3"
              @click="closing()">取消</button>
            <button type="button"
              class="btn px-5 py-2 rounded-[10px] bg-blue text-white hover:shadow hover:shadow-gray-400" @click="sendName()">確定</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#RenameModal {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#0101015a] z-10;

    .content {
      @apply w-[500px] h-[300px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-8;
    }
  }
}
</style>
