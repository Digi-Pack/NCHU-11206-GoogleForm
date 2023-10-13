<script setup>
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';
// import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-h-screen w-full flex flex-col justify-center items-center pt-6 bg-gradient-to-tr from-[#2b0e2b] to-purple">
    <div>
    </div>
    <div class="w-full max-w-lg mt-6 px-10 py-8 drop-shadow-md shadow-md bg-[#ffffff3a] overflow-hidden rounded-lg relative z-10">
      <div class="line1"></div>
      <div class="line2"></div>
      <div class="line3"></div>
      <div class="line4"></div>
      <slot />
    </div>
  </div>
</template>

<style lang="scss" scoped>
  @keyframes right {

  50%,
  100% {
      left: 100%;
  }
  }

  @keyframes bottom {

  50%,
  100% {
      top: 100%;
  }
  }

  @keyframes left {

  50%,
  100% {
      right: 100%;
  }
  }

  @keyframes top {

  50%,
  100% {
      bottom: 100%;
  }
  }
  .line1 {
    @apply w-full h-[10px] absolute rounded-full -left-[100%] top-0 bg-gradient-to-r from-transparent to-grey-middle;
    animation: right 3s linear 0.5s infinite;
  }

  .line2 {
    @apply w-[10px] h-[100%] absolute rounded-full right-0 -top-[100%] bg-gradient-to-b from-transparent to-grey-middle;
    animation: bottom 3s linear 1.3s infinite;
  }

  .line3 {
    @apply w-full h-[10px] absolute rounded-full -right-[100%] bottom-0 bg-gradient-to-l from-transparent to-grey-middle;
    animation: left 3s linear 2s infinite;
  }

  .line4 {
    @apply w-[10px] h-[100%] absolute rounded-full left-0 -bottom-[100%] bg-gradient-to-t from-transparent to-grey-middle;
    animation: top 3s linear 2.8s infinite;
  }
</style>
