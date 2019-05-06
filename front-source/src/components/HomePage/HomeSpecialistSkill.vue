<template>
  <div class="wrappHead">
      <div class="text-center">
          <h2>Diverse communicatie specialisten staan voor je klaar</h2>
          <p>Copywriters al vanaf  <b>€27,50 </b> per uur</p>
          <Button :path="'/huurEenSpecialist'"
                  btnClass="btnWhite"
                  btnText="BEKIJK ALLE SPECIALISTEN">
          </Button>
      </div>
      <div class="cellMargin">
        <HomeCellSkill v-for="(cell,index) in cells"
                       :key="Math.random()+index"
                       :img_url="cell.img_url"
                       :name="cell.name">
        </HomeCellSkill>
      </div>
      <div class="carousel">
        <!-- swiper -->
        <div class="slider-wrap-main">
          <swiper :options="swiperOption" class="slider-swiper-main">
            <swiper-slide v-for="(cell,index) in cells" :key="Math.random()+index">
              <HomeCellSkill
                :img_url="cell.img_url"
                :name="cell.name">
              </HomeCellSkill>
            </swiper-slide>
          </swiper>
          <div class="swiper-button-prev scill-left" slot="button-prev"></div>
          <div class="swiper-button-next scill-right" slot="button-next"></div>
        </div>
      </div>
  </div>
</template>

<script>
    import axios from "../../axios.config";
    import {mapGetters} from 'vuex';
    import Button from '../common/Button';
    import HomeCellSkill from './HomeCellSkill';
    import { swiper, swiperSlide } from 'vue-awesome-swiper'

    export default {
        data(){
            return {
              swiperOption: {
                slidesPerView: 2,
                loop: true,
                setWrapperSize: true,
                spaceBetween: 40,
                breakpoints: {
                  575: {
                    slidesPerView: 1,
                    spaceBetween: 2
                  },
                },
                navigation: {
                  nextEl: '.scill-right',
                  prevEl: '.scill-left'
                }
              },
            }
        },
        components:{
            Button,
            HomeCellSkill
        },
        computed: {
            ...mapGetters({
                 cells: 'other_request/getCategoriesListListWithStore',
            })
        },
        mounted: function(){
          this.$store.dispatch('other_request/getCategoriesWithServer');
        }
    }
</script>
<style scoped lang="scss">
  .slider-wrap-main {
    width: 100%;
  }
  .slider-swiper-main {
    width: 90%;
  }
  .swiper-slide {
    display: flex;
    justify-content: center;
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
    h2{
        word-break: break-word;
        text-align: center;
        font-size: 3.5vw;
        font-weight: 400;
        line-height: 0.9;
        letter-spacing: 2px;
        color: #00c8d7;
        font-family:GolanoSemi ;
        margin-bottom: 0px;
    }
    .wrappHead{
        margin-top: 7.2%;
       padding-left: 11%;
        padding-right: 12%;
    }
    p{
        font-size: 2.18vw;
        color: #969696;
        font-family:GolanoRegular ;
        line-height: 1.8;
        letter-spacing: -1px;
    }
    .cellMargin{
      margin-top: 4%;
      display: flex;
      flex-wrap: wrap;
    }
    .carousel {
      display: none;
      margin-top: 10%;
      justify-content: center;
    }
    @media screen and (max-width: 1440px){
      .btnWhite {
        width: 40%;
        font-size: 1.4rem;
      }
    }
    @media screen  and (max-width: 1200px){
      p {
        font-size: 1.4rem;
      }
      .btnWhite {
        width: 50%;
        font-size: 1.2rem;
      }
    }
    @media screen and (max-width: 850px){
      .btnWhite {
        font-size: 1.1rem;
      }
    }
    @media screen and (max-width: 767px){
      .wrappHead {
        padding-left: 9%;
      }
      h2{
        text-align: left;
        font-size: 2.2rem;
        letter-spacing: 2px;
        line-height: 1;
      }
      p{
        font-size: 1.5rem;
        text-align: left;
      }
      .btnWhite{
        width: 60%;
        padding: 3% 0;
        margin-bottom: 10%;
      }
      .text-center {
        padding: 0;
        button {
          margin: 8% 0;
        }
      }
      .row {
        padding: 0;
        margin: 0;
      }
    }
    @media screen and (max-width: 690px){
      .btnWhite {
        width: 80%;
      }
    }
    @media screen  and (max-width: 670px){
      .wrappHead {
        margin: 10% 0;
      }
      h2{
        font-size: 2.7rem;
      }
      hr {
        margin: 2rem 0;
      }
    }
    @media screen and (max-width: 590px){
        .btnWhite{
            width: 70%;
            font-size: 1rem;
        }
    }
    @media screen and (max-width: 575px){
      .wrappHead {
        padding: 0;
      }
      h2{
        padding-left: 9%;
      }
      p {
        padding-left: 9%;
      }
      .cellMargin {
        display: none;
      }
      .carousel {
        display: flex;
        margin-top: 5%;
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
    @media screen and (max-width: 540px){
      .btnWhite {
        width: 90%;
      }
    }
    @media screen  and (max-width: 450px) {
      h2 {
        font-size: 2.5rem;
      }
      p{
        font-size: 1.2rem;
        margin-top: 5%;
      }
    }
    @media screen and (max-width: 414px){
        .wrappHead {
            padding: 0;
        }
      p {
        margin-top: 5%;
      }
      .btnWhite{
        width: 80%;
        font-size: 1rem;
      }
      .slider-swiper-main {
        width: 100%;
      }
      .swiper-button-prev {
        left: 0;
      }
      .swiper-button-next {
        right: 0;
      }
    }
    @media screen and (max-width: 380px){
      .btnWhite {
        width: 95%;
      }
    }
    @media screen  and (max-width: 360px) {
      h2 {
        font-size: 2.3rem;
      }
      p {
        font-size: 1.4rem;
      }
    }
    @media screen and (max-width:320px){
        .btnWhite{
            width: 100%;
        }
      .text-center {
        h2 {
          font-size: 2rem;
          text-align: left;
          margin: 0;
        }
        p {
          font-size: 1.5rem;
          text-align: left;
          margin-top: 5%;
          margin-bottom: 10%;
          b {
            font-size: 9vw;
          }
        }
      }
      .text-center button {
        width: 90%;
        font-size: 1rem;
        padding: 5% 0;
      }
      .cellMargin {
        margin-top: 10%;
      }
      p {
        font-size: 1.5rem;
        margin: 0 2%;
      }
    }
</style>
