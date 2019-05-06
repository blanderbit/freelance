<template>
  <div class="wrapp">

    <div class="img">
      <img v-lazy="getBaseURL() + selectedSpecialist.user_avatar" alt="photo">
    </div>

    <!--<div class="confirmation">-->
      <!--<h2>Uw afspraak met <span>{{ selectedSpecialist.firstname }}</span> is bevestigd!</h2>-->
      <!--<p>U ontvangt een bevestiging via de e-mail.</p>-->
    <!--</div>-->
    <!--<hr>-->
    <!---->
    <!--<div class="information-item">-->
      <!--<img v-lazy="mysrc1" alt="image">-->
      <!--<h2>Maak kennis met je specialist</h2>-->
      <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,-->
        <!--sed do eiusmod tempor inci didunt ut labore et dolore.</p>-->
    <!--</div>-->
    <!---->
    <!--<div class="information-item">-->
      <!--<img v-lazy="mysrc2" alt="image">-->
      <!--<h2>Vertel je specialist over je verwachtingen</h2>-->
      <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,-->
        <!--sed do eiusmod tempor inci didunt ut labore et dolore.</p>-->
    <!--</div>-->
    <!---->
    <!--<div class="information-item">-->
      <!--<img v-lazy="mysrc3" alt="image">-->
      <!--<h2>De voorbereiding op de samenwerking</h2>-->
      <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,-->
        <!--sed do eiusmod tempor inci didunt ut labore et dolore.</p>-->
    <!--</div>-->

    <hr class="lastHr">

    <div class="gratitude">
      <h2>Bedankt voor de getoonde interesse!</h2>
    </div>

    <div class="btn">
      <!--<Button-->
        <!--btnText="MAAK ACCOUNT AAN"-->
        <!--btnClass="btnOrangeNav"-->
        <!--stylesImg="width:8%">-->
      <!--</Button>-->
    </div>


  </div>
</template>
<script>
  import { mapGetters } from 'vuex';
  import Button from './common/Button';
  import {base_url} from "../axios.config";
  export default {
      data(){
          return {
              mysrc:require(`../assets/icons/close.png`),
              mysrc1:require(`../assets/object_1.png`),
              mysrc2:require(`../assets/object_2.png`),
              mysrc3:require(`../assets/object_3.png`),
          }
      },
    computed: {
      ...mapGetters({
        selectedSpecialist: 'specialistList/getSelectedSpecialist',
      }),
    },
    components: {
      Button,
    },
    methods: {
      getBaseURL: () => base_url,
    },

  }
</script>
<style scoped lang="scss">
  .wrapp {
    background: white;
    width: 100%;
    text-align: center;
    padding-top: 2%;
    position: relative;

  }
  .img img {
    width: 35%;
    border-radius: 50%;
  }
  .confirmation {
    margin-top: 3%;
    margin-bottom: 3%;
    color: #646464;
    h2 {
      font-size: 1.7rem;
      font-weight: 400;
      line-height: 50px;
      font-family: GolanoRegular;
      margin: 0;
    }
    span {
      font-family: GolanoSemi;
      font-size: 2rem;
      font-weight: 600;
      line-height: 50px;
    }
    p {
      font-family: GolanoRegular;
      font-size: 25px;
      font-weight: 400;
    }
  }
  hr {
    width: 90%;
    height: 2px;
    background-color: #d7d7d7;
  }
  .information-item {
    margin-top: 9%;
    h2 {
      margin-top: 4%;
      color: #646464;
      font-family: GolanoSemi;
      font-size: 40px;
      font-weight: 400;
      line-height: 42.29px;
    }
    p {
      color: #969696;
      font-family: GolanoRegular;
      font-size: 1.5rem;
      font-weight: 400;
      line-height: 51.69px;
      margin: 3% 14% -8px 14%;
    }
  }
  .lastHr {
    margin-top: 9%;
  }
  .gratitude {
    margin-top: 4%;
    h2 {
      color: #00c7d6;
      font-family: GolanoSemi;
      font-size: 40px;
      font-weight: 400;
      line-height: 50px;
    }
  }
  .btn {
    width: 70%;
    margin-top: 3%;
    margin-bottom: 7%;
    button {
      width: 100%;
      font-size: 1.5rem;
      font-weight: 400;
      text-transform: uppercase;
      padding: 5% 0;
      img {
        width: 7%;
      }
    }
  }
  .form-close{
    position: absolute;
    right: 25px;
    top: 25px;;
    img {
      cursor: pointer;
    }
  }
  @media screen  and (max-width: 1400px) {
    .btn {
      width: 80%;
      button {
        font-size: 1.2rem;
      }
    }
  }
  @media screen  and (max-width: 930px){
    .confirmation h2 {
      font-size: 1.7rem;
      line-height: 1;
    }
    .confirmation span {
      font-size: 1.6rem;
    }
    .information-item p {
      line-height: 1.5;
    }
    .information-item h2 {
      font-size: 1.7rem;
    }
    img {
      width: 20%;
    }
    .gratitude h2 {
      font-size: 1.7rem;
    }
    .img img {
      width: 45%;
    }
    .form-close {
      right: -15px;
      width: 20%;
    }
  }

  @media screen  and (max-width: 600px){
    .btn {
      width: 100%;
    }
  }
  @media screen  and (max-width: 600px){
    .btn button{
      font-size: 1rem;
    }
  }
  @media screen  and (max-width: 600px){
    .btn button{
      font-size: 1rem;
    }
  }

</style>
