<template>
  <div>
    <div class="first">
      <h2>
        Mijn toekomstige
        collega’s
      </h2>
      <hr>
    </div>
  <b-container fluid>

    <b-row>
      <b-col class="caruselMy">
        <!-- swiper -->
        <div class="slider-wrap-main">
          <swiper :options="swiperOption" class="slider-swiper-main">
            <swiper-slide v-for="(specialist, index) in profiles" :key="index + Math.random()">
              <Anketa
                :name="specialist.name"
                :role="specialist.role"
                :img="specialist.user_avatar"
                :mainText="specialist.description"
                :type="'stars'">
              </Anketa>
            </swiper-slide>

          </swiper>
          <div class="swiper-button-prev spec-left" slot="button-prev"></div>
          <div class="swiper-button-next spec-right" slot="button-next"></div>
        </div>





        <!--<CaruselSpecialists type="star">-->
          <!--<Anketa-->
            <!--v-for="profile in profiles"-->
            <!--:key="profile.name + Math.random()"-->
            <!--:name="profile.name"-->
            <!--:text="profile.text"-->
            <!--:img="profile.img"-->
            <!--:mainText="profile.description"-->
            <!--&gt;</Anketa>-->
        <!--</CaruselSpecialists>-->
      </b-col>
    </b-row>
  </b-container>
  </div>
</template>
<script>

  import Anketa from './RegistrationAncet';
  import { swiper, swiperSlide } from 'vue-awesome-swiper'


  export default {
    data(){
      return {
        swiperOption: {
          slidesPerView: 3,
          loop: true,
          setWrapperSize: true,
          spaceBetween: 0,
          breakpoints: {
            575: {
              slidesPerView: 1,
              spaceBetween: 0
            },
            1200: {
              slidesPerView: 2,
              spaceBetween: 0
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
            description:'Lorem ipsum dolor sit amet, consec tet ur adipisicing elit sed do eiusmod temp or nisi. Lorem ipsum dolor sit amet, con sec tetur adipisicing. Lorem ipsum.'
          },
          {
            img:'photo2.png',
            name:'Thijs',
            text:'Copywriter',
            description:'Lorem ipsum dolor sit amet, consec tet ur adipisicing elit sed do eiusmod temp or nisi. Lorem ipsum dolor sit amet, con sec tetur adipisicing. Lorem ipsum.'

          },
          {
            img:'photo3.png',
            name:'Jochem',
            text:'Grafisch vormgever',
            description:'Lorem ipsum dolor sit amet, consec tet ur adipisicing elit sed do eiusmod temp or nisi. Lorem ipsum dolor sit amet, con sec tetur adipisicing. Lorem ipsum.'
          },
          {
            img:'photo1.png',
            name:'Lionel',
            text:'Grafisch vormgever',
            description:'Lorem ipsum dolor sit amet, consec tet ur adipisicing elit sed do eiusmod temp or nisi. Lorem ipsum dolor sit amet, con sec tetur adipisicing. Lorem ipsum.'
          },
          {
            img:'photo3.png',
            name:'Jochem',
            text:'Grafisch vormgever',
            description:'Lorem ipsum dolor sit amet, consec tet ur adipisicing elit sed do eiusmod temp or nisi. Lorem ipsum dolor sit amet, con sec tetur adipisicing. Lorem ipsum.'
          },
          {
            img:'photo2.png',
            name:'Thijs',
            text:'Copywriter',
            description:'Lorem ipsum dolor sit amet, consec tet ur adipisicing elit sed do eiusmod temp or nisi. Lorem ipsum dolor sit amet, con sec tetur adipisicing. Lorem ipsum.'

          },
        ],
      }
    },
    components:{
      Anketa,
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
  h3 {
    font-size: 2rem;
  }
  p {
    font-size: 1.7rem;
  }
  .first{
    margin: 5% 0 5% 11%;
    h2{
      word-break: break-word;
      color: #00c8d7;
      font-family: GolanoSemi;
      font-size: 3.82vw;
      font-weight: 400;
      width: 50%;
      letter-spacing: -2px;
      margin-bottom: 3%;
    }
    hr{
      margin:29px 0 29px 0;
      width: 5.5%;
      height: 0.5vw;
      background-color: #00c8d7;
    }
  }
  .caruselMy{
    padding: 0 5%;
    margin-bottom: 4%;
  }
  .btnCenter{
    text-align: center;
    margin-bottom: 5%;
    button{
      font-size: 1.5vw;
      padding: 1% 2%;
    }
  }
  @media screen  and (max-width: 1300px){
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
  @media screen  and (max-width: 985px){
    .swiper-button-prev {
      left: 20px;
    }
    .swiper-button-next {
      right: 20px;
    }
  }
  @media screen  and (max-width: 767px){
    .first h2 {
      font-size: 2rem;
    }
    .first hr {
      width: 10%;
      height: 0.5vw;
    }
  }
  @media screen and (max-width:720px ){
    .first h2{
      width: 100%;
    }
  }
  @media screen and (max-width:670px ){
    .first h2 {
      padding-right: 4%;
    }
  }

  @media screen and (max-width:637px ){
    .caruselMy{
      padding: 0;
    }
    .btnCenter button{
      font-size: 3vw;
      border-radius: 5px;
      border-width: 2px;
      padding: 15px;
    }
    .swiper-button-prev {
      left: 0;
    }
    .swiper-button-next {
      right: 0;
    }
  }
  @media screen and (max-width:565px ){

    .slider-swiper-main {
      width: 100%;
    }

  }
  @media screen and (max-width:530px ){
    .first {
      margin: 10% 0;
      h2{
        padding-left: 10%;
      }
      hr {
        margin-left: 11%;
      }
    }
  }
  @media screen and (max-width:495px ){
    .swiper-button-prev {
      top: 45%;
    }
    .swiper-button-next {
      top: 45%;
    }
  }
  @media screen and (max-width:400px ){
    .swiper-button-prev {
      top: 38%;
    }
    .swiper-button-next {
      top: 38%;
    }
  }
  @media screen and (max-width:320px ){
    .container-fluid {
      padding: 0;
    }
    .swiper-button-prev {
      left: 20px;
    }
    .swiper-button-next {
      right: 20px;
    }

  }
</style>
