<template>
    <div>
        <HomeHeader></HomeHeader>
        <HomeSpecialistSkill></HomeSpecialistSkill>
        <HomeThreeQuestions></HomeThreeQuestions>
        <HomeCompanies></HomeCompanies>
        <HomeSpecialistsSlider></HomeSpecialistsSlider>
        <HomeDeirectionsDevelop></HomeDeirectionsDevelop>
        <HomeWerktHet></HomeWerktHet>
        <HomeOurClients></HomeOurClients>
    </div>
</template>
<script>
    import HomeHeader from './HomeHeader';
    import HomeSpecialistSkill from './HomeSpecialistSkill';
    import HomeThreeQuestions from './HomeThreeQuestions';
    import HomeCompanies from './HomeCompanies';
    import HomeSpecialistsSlider from './HomeSpecialistsSlider';
    import HomeDeirectionsDevelop from './HomeDeirectionsDevelop';
    import HomeWerktHet from './HomeWerktHet';
    import HomeOurClients from './HomeOurClients';
    export default {
        components:{
            HomeHeader,
            HomeSpecialistSkill,
            HomeThreeQuestions,
            HomeCompanies,
            HomeSpecialistsSlider,
            HomeDeirectionsDevelop,
            HomeWerktHet,
            HomeOurClients,
        },
    }
</script>
<style lang="scss">
  @media screen and (max-width:320px) {
    body {
      overflow-x: hidden;
    }
    .row {
      margin: 0;
    }
  }
</style>
