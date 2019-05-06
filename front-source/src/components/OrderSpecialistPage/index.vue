<template>
    <div class="order-main">
      <SpecialistCard></SpecialistCard>
      <SpecialistCalendar></SpecialistCalendar>
    </div>
</template>

<script>
  import SpecialistCard from './SpecialistCard';
  import SpecialistCalendar from './SpecialistCalendar';
    export default {
        components: {
          SpecialistCard,
          SpecialistCalendar
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

<style scoped lang="scss">
  .order-main {
    width: 100%;
    padding-bottom: 5%;
    background: white;
    position: relative;
  }
  .form-close{
    position: absolute;
    right: 25px;
    top: 25px;;
    img {
      cursor: pointer;
    }
  }
  @media screen  and (max-width: 800px) {
    .order-main {
      width: 100%;
    }
  }

</style>
