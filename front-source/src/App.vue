<template>
  <div class="app">
    <div v-show="clickedPopUp" class="order-specialist-wrap" @click.self="onClosePopUp()">
      <div class="specialist-popup" style="margin-top: 5vh;">

        <span class="form-close" >
          <img v-lazy="mysrc2" alt="close" @click="onClosePopUp()">
        </span>

        <OrderSpecialist v-if="partPopUp==1"></OrderSpecialist>
        <ConfirmationSpecialist v-if="partPopUp==2"></ConfirmationSpecialist>
        <AppointmentSpecialist v-if="partPopUp==3"></AppointmentSpecialist>
      </div>

    </div>
    <router-view></router-view>
    <Footer></Footer>
  </div>
</template>

<script>
    import "bootstrap/dist/css/bootstrap.min.css";
    import "bootstrap-vue/dist/bootstrap-vue.css";
    import { mapGetters } from 'vuex';

    import OrderSpecialist from './components/OrderSpecialistPage';
    import ConfirmationSpecialist from './components/common/ConfirmationSpecialist';
    import AppointmentSpecialist from './components/AppointmentSpecialist';
    import Footer from './components/common/Footer';

    export default {
      data(){
        return {
          mysrc2:require(`./assets/icons/close.png`),
        }
      },
      methods:{
        onClosePopUp(){
          const elBody = document.getElementsByTagName('body')[0];
          this.$store.dispatch('specialistPopUp/statePopUpAct', false);
          elBody.style.overflowY= 'scroll';
        }
      },
      computed: {
        ...mapGetters({
          clickedPopUp: 'specialistPopUp/getSpecialistClickedPopUp',
          partPopUp: 'specialistPopUp/getSpecialistPartPopUp',
        })
      },
      components:{
        OrderSpecialist,
        ConfirmationSpecialist,
        AppointmentSpecialist,
        Footer
      },
      beforeCreate: function () {
        this.$store.dispatch('specialistList/allUsersList');
      }

    }
</script>

<style>

      @font-face {
              font-family: GolanoSemi;
              src: url("./assets/fonts/GalanoGrotesqueSemiBold.otf") format("opentype");
      }
      @font-face {
              font-family: GolanoRegular;
              src: url("./assets/fonts/GalanoGrotesqueRegular.otf") format("opentype");
      }

      *{
              box-sizing: border-box;
      }
      .app {
        overflow-x: hidden;
      }

      /*styles for the component TimePicker in OrderSpecialistPage/DirectPart.vue*/
      .form-control {
        border: none !important;
        color: #646464;
        font-family: GolanoRegular;
        font-size: 1.5rem;
        line-height: 35px;
        padding: 0 !important;
        height: auto;
      }
      .form-control:focus {
        border: none !important;
        box-shadow: none;
      }
      .form-group input.form-control.text-center {
          width: 40px !important;
        }

      tr.text-center {
        display: none;
      }
      .order-specialist-wrap {
        position: fixed;
        z-index: 1000;
        width: 100%;
        height: 100vh;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        background: #000000d6;
        overflow-y: scroll;
      }
      .specialist-popup {
        width: 36%;
        position: relative;
      }
      .form-close {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1;
        cursor: pointer;
      }
      @media screen and (max-width: 1200px) {
        .specialist-popup {
          width: 40%;
        }
      }
      @media screen and (max-width: 980px) {
        .specialist-popup {
          width: 50%;
        }
      }
      @media screen and (max-width: 760px) {
        .specialist-popup{
          width: 60%;
        }
      }
      @media screen and (max-width: 480px) {
        .specialist-popup{
          width: 75%;
        }
      }
      @media screen and (max-width:320px ){
        body {
          overflow-x: hidden;
        }
      }
</style>
