<template>
    <b-container fluid class="main-wrap">
        <b-row>
            <b-col class="caruselMy">
              <!-- swiper -->
              <div class="slider-wrap-main">
              <swiper :options="swiperOption" class="slider-swiper-main">
                <swiper-slide v-for="specialist in specialistList" :key="specialist.id + Math.random()">
                  <Anketa
                    :name="specialist.firstname"
                    :lastName="specialist.lastname"
                    :role="specialist.role"
                    :user_avatar_url="specialist.user_avatar"
                    :specialistId="specialist.id"
                    :stars="calcRating(specialist.rating)"
                    :type="'stars'">
                  </Anketa>
                </swiper-slide>

              </swiper>
                <div class="swiper-button-prev spec-left" slot="button-prev"></div>
                <div class="swiper-button-next spec-right" slot="button-next"></div>
              </div>
            </b-col>
        </b-row>
        <b-row>
            <b-col class="btnCenter">
                <Button :path="'/huurEenSpecialist'"
                        btnText="BEKIJK ALLE SPECIALISTEN"
                        btnClass="btnWhite"
                ></Button>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
  import { mapGetters } from 'vuex';
    import Anketa from '../Anketa';
    import Button from '../common/Button';


  import { swiper, swiperSlide } from 'vue-awesome-swiper'

    export default {
        data(){
            return {
              swiperOption: {
                slidesPerView: 3,
                loop: true,
                setWrapperSize: true,
                spaceBetween: 40,
                breakpoints: {
                  575: {
                    slidesPerView: 1,
                    spaceBetween: 10
                  },
                  1107: {
                    slidesPerView: 2,
                    spaceBetween: 10
                  },
                },
                navigation: {
                  nextEl: '.spec-right',
                  prevEl: '.spec-left'
                }
              },
                profiles:[
                    {
                        img:'photo1.png',
                        name:'Lionel',
                        text:'Grafisch vormgever',
                        stars:5
                    },
                    {
                        img:'photo2.png',
                        name:'Thijs',
                        text:'Copywriter',
                        stars:5
                    },
                    {
                        img:'photo3.png',
                        name:'Jochem',
                        text:'Grafisch vormgever',
                        stars:5
                    }
                ],
            }
        },
      methods: {
        calcRating(num){
          let quantity = 1;
          (num == 0 || num == 1) ? quantity : quantity = Math.floor(num/2);
          return quantity;
        },
      },
      computed: {
        ...mapGetters({
          specialistList: 'specialistList/getAllUsers'
        }),
      },
        components:{
            Anketa,
            Button,
            swiper,
            swiperSlide
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
  .caruselMy{
        padding: 0 5%;
        margin-bottom: 4%;
    }
    .btnCenter{
        text-align: center;
        margin-bottom: 5%;
        button{
            font-size: 1.1rem;
            padding: 1% 2%;
          border-radius: 10px;
        }
    }
    .noneCarusel{
        display: none;
        padding: 0px;
    }
  @media screen and (max-width: 1320px) {
    .swiper-button-prev {
      background-size: contain;
      width: 35px;
      height: 65px;
      left: 60px;
    }
    .swiper-button-next {
      background-size: contain;
      width: 35px;
      height: 65px;
      right: 60px;
    }
  }
  @media screen and (max-width: 960px) {
    .swiper-button-prev {
      left: 40px;
    }
    .swiper-button-next {
      right: 40px;
    }
  }
    @media screen and (max-width: 767px) {
      .btnCenter button{
        width: 50%;
        font-size: 1.2rem;
        padding: 2% 0;
      }
      .swiper-button-prev {
        left: 20px;
      }
      .swiper-button-next {
        right: 20px;
      }
    }
  @media screen and (max-width:670px ){
    .btnCenter button{
      width: 60%;
    }
  }
    @media screen and (max-width:637px ){

        .noneCarusel{
            display: block;
        }
        .btnCenter button{
          font-size: 3vw;
          padding: 15px;
        }
    }
    @media screen and (max-width: 575px){
      .caruselMy {
        padding: 0;
      }
    }
    @media screen and (max-width:480px){
      .btnCenter button{
        width: 80%;
        font-size: 1rem;
        padding: 3% 0;

      }
    }
    @media screen and (max-width: 414px) {
      .btnCenter button{
        width: 90%;
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
    @media screen and (max-width: 360px) {
      .btnCenter {
        padding: 0;
      }
      .btnCenter button{
        width: 90%;
      }
    }

    @media screen and (max-width: 320px ){
      .btnCenter button{
        padding: 5% 0;
        width: 95%;
        margin: 12% 0;
      }
        .main-wrap {
            padding: 0;
        }
    }
</style>
