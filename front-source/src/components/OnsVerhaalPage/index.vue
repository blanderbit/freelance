<template>
    <div>
      <OnsWerkHeader></OnsWerkHeader>
    </div>
</template>
<script>

  import OnsWerkHeader from './OnsVerhaalHeader';
  export default {
    components: {
      OnsWerkHeader,
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
