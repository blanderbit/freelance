<template>
  <div>
    <SpecialistHeader></SpecialistHeader>
    <Benefits></Benefits>
    <HowItWorks></HowItWorks>
    <RegistrationCompanies></RegistrationCompanies>
    <!--<Slider></Slider>-->
  </div>
</template>
<script>
  import SpecialistHeader from './SpecialistHeader';
  import HomeHeader from './../HomePage/HomeHeader';
  import Benefits from './Benefits';
  import HowItWorks from './HowItWorks';
  import RegistrationCompanies from './RegistrationCompanies';
  // import Slider from './RegistrationSlider';

  export default {
    components:{
      SpecialistHeader,
      Benefits,
      HowItWorks,
      RegistrationCompanies,
      // Slider
      HomeHeader
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
