<script>
import mountain from '/images/Mountain.jpg';

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
    // console.log(this.response);
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
      <div class="board w-full h-[200px]"></div>
      <h1 class="title">{{ title }}</h1>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#frontend-index {
  @apply w-full min-h-screen overflow-y-auto bg-gradient-to-tr p-5 from-black to-gray-600 bg-cover;
  background-image: url('../../../images/Mountain.jpg');
  .title {
    @apply text-[6.25rem] text-center text-grey-light justify-self-center items-center;
  }

  .btn-base {
    @apply p-1.5 text-xl rounded-md text-white cursor-pointer hover:text-gray-400 hover:scale-110;
  }
}
</style>
