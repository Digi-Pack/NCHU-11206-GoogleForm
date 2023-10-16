<script>
import close from '/images/close.svg';
import youtube from '/images/youtube.png';

export default {
  props: {
    formData: Object,
  },
  emits: ['closeModel', 'videoUrl'],
  data() {
    return {
      close,
      youtube,
      url: '',
    };
  },
  computed: {
    embedUrl() {
      if (this.url.includes('youtube.com/watch?v=')) {
        return this.url.replace('watch?v=', 'embed/');
      }
      // 如果需要，处理其他URL格式
      return this.url;
    },
  },
  mounted() {
  },
  methods: {
    closing() {
      this.$emit('closeModel');
    },
    addvideo() {
      if (this.url.includes('youtube.com/watch?v=')) {
        this.url = this.url.replace('watch?v=', 'embed/');
      }
      this.$emit('videoUrl', this.url);
      this.url = '';
      this.closing();
    },
  },
};
</script>

<template>
  <section id="UploadYtVideo">
    <div class="container">
      <div class="content">
        <div class="top">
          <div class="w-full flex justify-between items-center mb-4">
            <h1 class="text-[24px] text-black">選取影片</h1>
            <button type="button" class="text-[28px] font-bold text-black" @click="closing()">
              <img :src="close" alt="">
            </button>
          </div>
          <div class="w-full flex gap-8">
            <button class="navbtn" type="button" @click="showUrl()">網址</button>
          </div>
        </div>
        <div class="pt-[15px] h-[270px] border-b">
          <div class="px-8">
            <div class="yt-add">
              <span class="text-normal font-bold">在這裡貼上Youtube網址:</span>
              <input type="url" class="w-2/3 h-[25px] border-gray-300 text-md" v-model="url">
            </div>
            <div v-if="url" class="text-grey flex flex-col items-center justify-center h-[180px] gap-2">
              <iframe class="w-1/2 h-screen" :src="embedUrl" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
            </div>
            <div v-else class="text-grey flex flex-col items-center justify-center h-[180px] gap-2">
              <div class="text-[14px]">如果您的網址正確，這裡將會顯示影片預覽畫面。較大的影片可能需要幾分鐘才會顯示。</div>
              <div class="text-[14px]">請注意，未經許可擅用他人在網路上的影片，不但沒有禮貌，更是侵權的行為。</div>
            </div>
          </div>
        </div>
        <div class="btn-all ">
          <button type="button"
            class="btn bg-blue text-white hover:shadow-gray-400 mr-5" @click="addvideo()">選取</button>
          <button type="button" class="btn border-grey-light bg-grey-middle hover:bg-blue-light mr-3"
            @click="closing()">取消</button>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#UploadYtVideo {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#e6e6e65a] z-20;
    .content {
      @apply w-[800px] h-[460px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 py-8;
      @media(max-width:850px) {
        @apply w-[90%];
      }
      .top {
        @apply w-full border-b pb-3 px-8 shadow-md;
      }
      .yt-add {
        @apply flex gap-5 mt-2 mb-5;
        @media(max-width:850px) {
          @apply flex-col;
          input {
            @apply w-full;
          }
        }
      }
    }
    .navbtn {
        @apply hover:border-b hover:border-purple;
    }
    .btn-all {
      @apply flex py-4 px-7;
      @media(max-width:450px) {
          @apply justify-between;
        }
      .btn {
        @apply px-6 py-2 rounded-[3px] hover:shadow border border-gray-300 text-xs font-semibold;
      }
    }
  }
}
</style>
