<script>
export default {};
</script>

<template>
  <section id="frontend-layout">
    <header id="header"></header>
    <main id="main">
      <slot />
    </main>
  </section>
</template>

<style lang="scss" scoped>
#frontend-layout {
  @apply w-full;
}

</style>
