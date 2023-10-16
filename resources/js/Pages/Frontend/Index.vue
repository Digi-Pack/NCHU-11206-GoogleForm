<script>
import mountain from '/images/mountain.jpg';

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
      title: 'WELCOME',
      images: {
        mountain,
      },
    };
  },
  created() {
  },
};
</script>

<template>
  <section id="frontend-index">
    <div class="flex flex-col h-full">
      <div class="flex justify-between items-center gap-5 mb-5">
        <span class="text-[24px] text-white">Google 表單</span>
        <div class="flex justify-between items-center gap-5">
          <Link :href="route('register')" class="btn-base">註冊</Link>
          <Link :href="route('login')" class="btn-base">登入</Link>
        </div>
      </div>
      <div class="board w-full h-[calc(100vh-120px)] flex justify-center items-center">
        <h1 class="title">
          <span class="wave">W</span>
          <span class="wave">E</span>
          <span class="wave">L</span>
          <span class="wave">C</span>
          <span class="wave">O</span>
          <span class="wave">M</span>
          <span class="wave">E</span>
        </h1>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#frontend-index {
  @apply w-full min-h-screen overflow-y-auto bg-gradient-to-tr p-5 from-black to-gray-600 bg-cover bg-center;
  background-image: url('../../../images/mountain.jpg');
  .title {
    @apply text-[6.25rem] text-center text-grey-light justify-self-center items-center pb-32;
    @media(max-width:508px) {
      @apply text-[64px];
    }
    .wave {
      @apply inline-block;
      animation: wave 5s infinite; /* 應用波浪動畫，交替反向播放 */
      @for $i from 1 through 7 { /* 使用Sass的迴圈來設置不同的延遲 */
        &:nth-child(#{$i}) {
          animation-delay: $i * 0.25s; /* 每個<span>元素都有0.1秒的延遲 */
        }
      }
    }
  }
  @keyframes wave {
    0%, 100% {
      transform: translateY(0);
      @apply text-white;
    }
    50% {
      transform: translateY(-25px);
      @apply text-black text-xs;
    }
  }
  .btn-base {
    @apply p-1.5 text-xl rounded-md text-white cursor-pointer hover:text-gray-400 hover:scale-110;
  }
}
</style>
