<script>
import link from '/resources/images/link.png';
import facebook from '/resources/images/facebook.svg';
import twitter from '/resources/images/twitter.svg';
import close from '/resources/images/close.svg';

export default {
  props: {
    formUrl: String,
  },
  data() {
    return {
      link,
      facebook,
      twitter,
      close,
      show: true,
    };
  },
  mounted() {
    console.log(this.formUrl);
  },
  methods: {
    closing() {
      this.show = false;
    },
    messageUrl() {
      return route('reply.index', { 'id': this.formUrl });
    },
    copy() {
      let copyText = document.getElementById('url');
      // Select the text field
      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices
      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.value);
      // Alert the copied text
      alert('Copied the text: ' + copyText.value);
    },
  },
};
</script>

<template>
  <section v-if="show" id="sendLinkModal">
    <div class="container">
      <div class="content">
        <div class="flex justify-between items-center">
          <h1 class="text-[28px] font-bold text-black">傳送表單</h1>
          <button type="button" class="text-[28px] font-bold text-black" @click="closing()">
            <img :src="close" alt="">
          </button>
        </div>
        <div class="flex justify-between items-end pt-[30px] pb-[10px] border-b border-black">
          <div class="flex">傳送方式
            <button type="button">
              <img :src="link" class="ml-[20px] w-[28px] h-[28px]" alt="">
            </button>
          </div>
          <div class="flex">
            <img :src="facebook" class="mr-[10px] w-[28px] h-[28px]" alt="">
            <img :src="twitter" class="mr-[10px] w-[28px] h-[28px]" alt="">
          </div>
        </div>
        <div class="pt-[30px]">
          <h3 class="font-semibold text-[20px]">連結</h3>
          <input type="url" class="border-x-0 border-t-0 w-[90%]" :value="messageUrl()" id="url">
          <div class="flex justify-end mt-5">
            <button type="button" class="btn px-5 py-2 text-gray-700 hover:bg-grey-light rounded-[10px] mr-3"
              @click="closing()">取消</button>
            <button type="button"
              class="btn px-5 py-2 border border-grey rounded-[10px] text-gray-700 hover:bg-grey-light" @click="copy()">複製</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#sendLinkModal {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#0101015a] z-10;

    .content {
      @apply w-[600px] h-[400px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-5;
    }
  }
}
</style>
