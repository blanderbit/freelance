<template>
    <div class="main">
      <AppointmentSpecialist name="Lionel"
                             img="photo2.png"
                             >
      </AppointmentSpecialist>

      <ConfirmationSpecialist name="Lionel"
                              img="photo2.png">
      </ConfirmationSpecialist>

      <OrderSpecialist></OrderSpecialist>


    </div>
</template>
<script>
  import AppointmentSpecialist from './AppointmentSpecialist';
  import ConfirmationSpecialist from './common/ConfirmationSpecialist';
  import OrderSpecialist from './OrderSpecialistPage/index';

  export default {

    components: {
      AppointmentSpecialist,
      ConfirmationSpecialist,
      OrderSpecialist
    },
  }
</script>
<style scoped lang="scss">
  .main {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: hotpink;
  }

</style>
