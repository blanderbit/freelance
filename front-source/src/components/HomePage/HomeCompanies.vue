<template>
    <div class="main">
        <div class="first">
            <h2>
              Designers, copywriters en online marketeers on demand inzetbaar wanneer jij dat wilt!
            </h2>
            <hr>
        </div>
        <div class="middle">
            <p>Causeffect geeft ondernemers hun vrijheid terug door flexibele werkkrachten aan te bieden.
                Je kunt specialisten inhuren wanneer het jouw uitkomt en zolang jij wilt.
            </p>
            <b-container fluid class="companies">
                <b-row class="companies-items">
                    <b-col md="2" sm="4" cols="12" v-for="n in 10" :key="n +Math.random()">
                        <img v-lazy="sourceImages(n)"
                             :alt="'portfolio item №'+n">
                    </b-col>
                </b-row>
            </b-container>

          <!-- swiper -->
          <div class="slider-wrap-main">
            <swiper :options="swiperOption" class="slider-swiper-main">
              <swiper-slide class="swiper-item" v-for="n in 10" :key="n +Math.random()" :src="sourceImages(n)">
                <img :src="sourceImages(n)" :alt="'portfolio item №'+n">
              </swiper-slide>

            </swiper>
            <div class="swiper-button-prev comp-left" slot="button-prev"></div>
            <div class="swiper-button-next comp-right" slot="button-next"></div>
          </div>

          <div class="hideButton">
              <router-link to="/huurEenSpecialist?user_hourly_rate=30.00&user_place_to_work=&user_region=&user_city=">
                <Button
                        btnText="BEKIJK MEER WERK"
                        btnClass="btnWhite"></Button>
              </router-link>
            </div>
            <h2 class="headerTwo">
                Ontmoet onze
                specialisten
            </h2>
            <hr>
        </div>
    </div>
</template>
<script>
    import Button from '../common/Button';
    import { swiper, swiperSlide } from 'vue-awesome-swiper'
    export default {
      data() {
        return {
          swiperOption: {
            slidesPerView: 1,
            loop: true,
            setWrapperSize: true,
            spaceBetween: 0,
            breakpoints: {
              575: {
                slidesPerView: 1,
                spaceBetween: 2
              },
            },
            navigation: {
              nextEl: '.comp-right',
              prevEl: '.comp-left'
            }
          },
        }
      },
        components:{
          Button,
        },
        methods:{
            sourceImages(n){
                return require(`../../assets/portfolio-item${n}.png`)
            }
        }
    }

</script>
<style scoped lang="scss">

  .slider-wrap-main {
    width: 100%;
    position: relative;
    display: none;
  }
  .slider-swiper-main {
    width: 90%;
    text-align: center;
  }
  .swiper-button-prev {
    width: 45px;
    height: 85px;
    left: 80px;
    background: url("../../assets/icons/arrow-carousel-left.png") no-repeat;

  }
  .swiper-button-next {
    width: 45px;
    height: 85px;
    right: 80px;
    background: url("../../assets/icons/arrow-carousel-right.png") no-repeat;

  }
  .swiper-item {
    img {
      width: 60%;
    }
  }

    .hideButton{
        text-align: center;
        margin-top: 5%;
        button{
            border-radius: 10px;
            font-size: 3vw;
            padding: 2% 3%;
        }
        display: none;
    }
    .main{
        margin-bottom: 5%;
    }
    h2{
        word-break: break-word  ;
        color: #00c8d7;
        font-family: GolanoSemi;
        font-size: 3.82vw;
        font-weight: 400;
        width: 55%;
        letter-spacing: 2px;
    }
    .first{
        margin-left: 10%;
    }
    hr{
        margin:29px 0 29px 0;
        width: 5.5%;
        height: 0.5vw;
        background-color: #00c8d7;
    }
    .middle{
        background-image: url("../../assets/bigArrow.png");
        background-repeat: no-repeat;
        background-size: contain;
        padding-left: 10%;
    }

    p{
        margin-top: 1%;
        padding: 2% 0 0 2.7%;
        width: 43%;
        color: #969696;
        font-family: GolanoRegular;
        font-size: 1.535vw;
        font-weight: 400;
        line-height: 1.6;
        letter-spacing: -0.9px;
    }
    .col-md-2{
        padding: 0px;
        flex-grow: 0;
        margin: 0px 0px 20px 15px;
    }
    .companies{
        padding-top: 4%;
        padding-right: 2%;
    }
    img{
        width: 275px;
        max-width: 100%;
    }
    h2.headerTwo{
        margin-top: 5.5%;
    }
    .companies-carousel {
      display: none;
      margin-top: 10%;
      justify-content: center;
    }
    @media screen and (max-width: 1200px){
      p{
        font-size: 1.4rem;
      }
    }
    @media screen and (max-width: 767px){
      .first {
        margin: 0;
      }
      .main {
        padding-left: 11%;
        padding-right: 12%;
      }

      h2{
        font-size: 2rem;
        width: 100%;
        text-align: left;
      }
      .row{
          margin: 0;
      }
      hr{
          width: 10%;
          font-size: 1vw;
      }
      .middle{
          background: white;
      }
      p{
        margin: 0;
        text-align: left;
        font-size: 1.5rem;
        padding: 0;
        width: 100%;
        margin-bottom: 5%;
      }
      .col-6{
          text-align: center;
          margin: 0px;
          padding: 0px 0px 20px 15px;
          &:nth-child(n+5){
              display: none;
          }
        }
        .middle{
            padding-left: 0px;
          width: 100%;
        }
        .headerTwo{
            font-size: 2rem;
        }
        .headerTwo,hr{
            margin-left: 0;
        }
        .hideButton{
            display: block;
        }
      .hideButton button {
        width: 60%;
        font-size: 1.2rem;
      }
      .companies-items {
        display: flex;
        justify-content: center;
      }
    }
    @media screen  and (max-width: 670px){
      hr {
        margin: 2rem 0;
        width: 14%;
      }
      .hideButton {
        margin: 10% 0;
      }
      h2.headerTwo {
        margin-left: 0;
      }
    }
    @media screen and (max-width: 575px){
      .companies {
        display: none;
      }
      .slider-wrap-main {
        display: flex;
      }
      .companies-carousel {
        display: flex;
      }
      .main {
        padding: 0;
      }
      h2, p {
        padding-left: 9%;
      }
      hr {
        margin-left: 9%;
      }
      .swiper-button-prev {
        background-size: contain;
        width: 35px;
        height: 65px;
        left: 30px;
      }
      .swiper-button-next {
        background-size: contain;
        width: 35px;
        height: 65px;
        right: 30px;
      }
    }
    @media screen and (max-width: 555px){
      .hideButton button {
        font-size: 1rem;
      }
    }
    @media screen and (max-width: 485px){
      .hideButton button {
        width: 80%;
        font-size: 1rem;
      }
    }
    @media screen and (max-width: 450px){
      .companies {
        padding: 0;
        text-align: center;
      }
      h2 {
        font-size: 2.5rem;
      }
      p{
        font-size: 1.2rem;
      }
    }
    @media screen and (max-width: 414px) {
      .hideButton button {
        width: 80%;
        font-size: 1rem;
        padding: 3% 0;
      }
      .slider-swiper-main {
        width: 100%;
      }
      .swiper-item img {
        width: 100%;
      }
      .swiper-button-prev {
        left: 0;
      }
      .swiper-button-next {
        right: 0;
      }
    }
    @media screen  and (max-width: 360px) {
      h2 {
        font-size: 2rem;
      }
      p{
        font-size: 1rem;
      }
    }

    @media screen and (max-width: 320px){
      .companies {
        padding: 0;
        margin-left: -6px;
      }
      .hideButton button {
        padding: 5% 0;
        width: 80%;
        border-radius: 10px;
        font-size: 1rem;
      }
      hr {
        margin-left: 2%;
      }
      .first{
        margin-left: 7%;
        h2 {
          font-size: 2rem;
          text-align: left;
          padding-left: 2%;
        }
      }
      .middle{
        h2 {
          width: 100%;
          font-size: 2rem;
          text-align: left;
          padding-left: 9%;
        }
        hr {
          margin-left: 9%;
        }
        p {
          font-size: 1.5rem;
          text-align: left;
          padding-left: 7%;
        }
      }
    }
</style>
