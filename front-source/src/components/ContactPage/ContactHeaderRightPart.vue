<template>
  <div class="item-wrapp">
    <div class="contact-item">
      <i class="fas fa-envelope" ></i>
      <p class="base-email" style="margin-top: 20px">{{base_email}}</p>
    </div>
    <div class="contact-item">
      <i class="fas fa-phone phone"></i>
      <h3>085 130 3493</h3>
    </div>

  </div>

</template>

<script>
  import { base_email } from '../../axios.config';
  export default {
    data() {
      return {
        base_email: base_email
      }
    },
  }
</script>

<style scoped lang="scss">
  .base-email {
    font-size: 35px;

    @media screen and (max-width: 1366px){
      font-size: 20px;
    }

    @media screen and (max-width: 1366px){
      font-size: 14px;
    }
  }
  .item-wrapp {
    width: 100%;
    padding-top: 35%;
    padding-left: 4%;
  }
  .contact-item {
    display: flex;
    color: #ffffff;
    font-family: GolanoRegular;
    font-size: 40px;
    font-weight: 400;
    line-height: 70px;
    margin-bottom: 35px;
    position: relative;
    i {
      font-size: 2.2rem;
      position: absolute;
    }

    .phone {
      transform: rotate(80deg);
    }
    h3 {
      font-size: 2.2vw;
      margin-left: 14%;
    }

  }
  @media screen  and (max-width: 1200px){
    .contact-item {
      i {
        font-size: 2rem;
      }

    }
  }
  @media screen  and (max-width: 991px){
    .item-wrapp {
      padding-top: 3%;
    }
    .contact-item {
      margin-bottom: 5px;
      h3 {
        font-size: 3.2vw;
      }

    }
  }
  @media screen  and (max-width: 540px){
    .item-wrapp {
      padding-top: 3%;
    }
    .contact-item {
      margin-bottom: 5%;
      h3 {
        font-size: 6.2vw;
      }

    }
  }
</style>
