<template>
    <div class="wrapp">
      <div class="title">
        <h2>Het team</h2>
        <hr>
      </div>
      <div class="images-team">
        <img v-for="n in 3" v-lazy="sourceImages(n)" :key="n + Math.random()" alt="person">
      </div>

      <div class="team-slider">
        <!-- swiper -->
        <div class="slider-wrap-main">
          <swiper :options="swiperOption" class="slider-swiper-main">
            <swiper-slide v-for="n in 3" :key="n + Math.random()">
              <img :src="sourceImages(n)" alt="portfolio_item">
            </swiper-slide>

          </swiper>
          <div class="swiper-button-prev comp-left" slot="button-prev"></div>
          <div class="swiper-button-next comp-right" slot="button-next"></div>
        </div>
      </div>
    </div>
</template>

<script>

  import { swiper, swiperSlide } from 'vue-awesome-swiper'
    export default {
        data(){
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
      methods:{
        sourceImages(n){
          return require(`../../assets/Layer_${n}.png`)
        }
      },
    }
</script>

<style scoped lang="scss">
  .slider-wrap-main {
    width: 100%;
    position: relative;
  }
  .slider-swiper-main {
    width: 90%;
    text-align: center;
  }
  .swiper-button-prev {
    width: 35px;
    height: 65px;
    left: 10px;
    background: url("../../assets/icons/arrow-carousel-left.png") no-repeat;
    background-size: contain;

  }
  .swiper-button-next {
    width: 35px;
    height: 65px;
    right: 10px;
    background: url("../../assets/icons/arrow-carousel-right.png") no-repeat;
    background-size: contain;

  }
  .swiper-slide {
    img {
      width: 90%;
    }
  }
  .wrapp {
    margin-top: 20px;
    background-image: url("../../assets/bigArrow.png");
    background-repeat: no-repeat;
    background-position: 0 249px;
    padding-bottom: 8%;
  }
  .title {
    margin-top: 5%;
    margin-left: 10%;
    h2 {
      color: #00c8d7;
      font-family: GolanoSemi;
      font-size: 70px;
      font-weight: 400;
      line-height: 90px;
      padding-left: 10px;
    }
    hr {
      width: 5.5%;
      height: 10px;
      margin-top: 35px;
      margin-left: 15px;
      background-color: #00c8d7;
    }
  }
  .images-team {
    margin-top: 4.7%;
    margin-left: 11%;

    img {
      margin-right: 11px;
      width: 30%;
    }
  }
  .team-slider {
    display: none;
  }
  @media screen  and (max-width: 1080px){
    .wrapp {
      margin-top: 17%;
    }
  }
  @media screen  and (max-width: 920px){
    .wrapp {
      margin-top: 25%;
    }
  }
  @media screen  and (max-width: 840px){
    .wrapp {
      margin-top: 15%;
    }
  }
  @media screen  and (max-width: 770px){
    .title{
      h2{
        font-size: 50px;
        line-height: 50px;
      }
      hr {
        height: 5px;
      }
    }
  }
  @media screen  and (max-width: 767px){
    .wrapp {
      margin-top: 20%;
    }
    .title{
      h2{
        text-align: left;
        font-size: 2rem;
        margin-top: 10%;
      }
      hr {
        margin-left: 1%;
        margin-top: 2rem;
        margin-bottom: 2rem;
        width: 13.6%;
        height: 0.5vw;
        max-height: 100%;
      }
    }
  }
  @media screen  and (max-width: 690px) {
    .wrapp {
      margin-top: 30%;
    }
  }
  @media screen  and (max-width: 670px){
    .images-team {
      display: none;
    }
    .team-slider {
      display: block;
    }
    .wrapp {
      margin-top: 0;
    }
    .title h2 {
      font-size: 3rem;
    }
  }
  @media screen  and (max-width: 480px){
    .swiper-button-prev {
      left: 0;

    }
    .swiper-button-next {
      right: 0;
    }
  }
  @media screen  and (max-width: 450px){
    .title h2 {
      font-size: 2.5rem;
    }
  }
  @media screen  and (max-width: 414px){
    .slider-swiper-main {
      width: 100%;
    }
    .swiper-slide {
      img {
        width: 100%;
      }
    }
  }
  @media screen  and (max-width: 320px){
    .title{
      margin-left: 0;
      h2{
        font-size: 35px;
        line-height: 30px;
      }
      hr {
        margin-left: 6%;
        margin-top: 2rem;
        margin-bottom: 2rem;
        width: 13.6%;
        height: 0.5vw;
        max-height: 100%;
      }
    }
    .images-team {
      text-align: center;
      img {
        width: 100%;
        margin-bottom: 2%;
        margin-left: -25px;
      }
    }
  }

</style>
