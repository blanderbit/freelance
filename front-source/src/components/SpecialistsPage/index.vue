<template>
    <div>
      <SpecialistHeader></SpecialistHeader>
    </div>
</template>

<script>
  import SpecialistHeader from './SpecialistHeader';
    export default {
        components: {
          SpecialistHeader
        },
      methods: {
        scrollToTop() {
          window.scrollTo(0, 0);
        }
      },
      mounted() {
        this.scrollToTop();
      },
    }
</script>

<style scoped>

</style>
