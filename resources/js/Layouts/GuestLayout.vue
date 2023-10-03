<script setup>
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';
// import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-h-screen w-full flex flex-col justify-center items-center pt-6 bg-gradient-to-tr from-[#2b0e2b] to-purple">
    <div>
      <!-- <Link href="/">
        <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
      </Link> -->
    </div>

    <div class="w-full max-w-md mt-6 px-6 py-4 drop-shadow-md shadow-md bg-[#ffffff3a] overflow-hidden rounded-lg relative z-10">
      <slot />
    </div>
  </div>
</template>
