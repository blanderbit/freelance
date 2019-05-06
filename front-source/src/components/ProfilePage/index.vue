<template>
  <div>
    <ProfileHeader></ProfileHeader>
    <SpecialistCard></SpecialistCard>
    <Reviews></Reviews>
  </div>
</template>

<script>
  import ProfileHeader from './ProfileHeader';
  import SpecialistCard from './SpecialistCard';
  import Reviews from './Reviews';

  export default {
    components: {
      ProfileHeader,
      SpecialistCard,
      Reviews
    },
    mounted() {
        window.scrollTo(0, 0);

    },
  }
</script>

<style scoped lang="scss"></style>

