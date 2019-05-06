<template>
  <div class="main-companies">
    <div class="first">
      <h2>
        Voor wie kan <br> ik gaan werken
      </h2>
      <hr>
    </div>
    <div class="middle">
      <p>Wij zijn een duurzaam communicatiebureau
        gefocust op resultaatgerichte online marketing
        oplossingen voor MKB bedrijven.</p>
      <div class="companies">
        <div class="companies-items">
          <div class="img-items" v-for="n in 10" :key="n +Math.random()">
            <img v-lazy="sourceImages(n)" :alt="'portfolio item №'+n">
          </div>
        </div>
      </div>
      <div class="img-items-slider">
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
          <Button
            btnText="BEKIJK MEER WERK"
            btnClass="btnWhite"></Button>
        </div>
      </div>


<div class="hideButton">
 <Button
   btnText="BEKIJK MEER WERK"
   btnClass="btnWhite"></Button>
</div>

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
      Button
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
  }
  .slider-swiper-main {
    width: 70%;
  }
  .swiper-button-prev {
    width: 35px;
    height: 65px;;
    top: 45%;
    left: 10px;
    background: url("../../assets/icons/arrow-carousel-left.png") no-repeat;
    background-size: contain;
  }
  .swiper-button-next {

    width: 35px;
    height: 65px;
    top: 45%;
    right: 10px;
    background: url("../../assets/icons/arrow-carousel-right.png") no-repeat;
    background-size: contain;

  }

  .img-items-slider {
    display: none;
  }

.main-companies{
margin-bottom: 5%;
margin-top: 6%;
margin-left: 1%;
}
.hideButton{
text-align: center;
margin-top: 5%;
button{
border-radius: 5px;
font-size: 3vw;
padding: 2% 3%;
}
display: none;
}

h2{
word-break: break-word  ;
color: #00c8d7;
font-family: GolanoSemi;
font-size: 3.82vw;
font-weight: 400;
width: 50%;
letter-spacing: -2px;
margin-bottom: 3%;
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

padding-left: 10%;
}

p{
margin-top: 1%;
padding: 2% 0 0 2.7%;
width: 43%;
color: #969696;
font-family: GolanoRegular;
font-size: 1.7rem;
font-weight: 400;
line-height: 1.6;
letter-spacing: -0.9px;
}
.col-md-2{
padding: 0px;
flex-grow: 0;
margin: 0px 8px 20px 15px;
}
.companies{
padding-top: 4%;
padding-right: 2%;
}
.companies-items {
  display: flex;
  justify-content: flex-start;
  flex-wrap: wrap;
}
.img-items {
  width: 17%;
  margin-right: 2%;
  margin-bottom: 3%;
}
img{
width: 100%;
margin-bottom: 5%;
}
  @media screen and (max-width: 1200px){
    p {
      font-size: 1.5rem;
    }
  }
@media screen and (max-width: 991px){
  .main-companies {
  margin-left: 0;
}
  .companies-items {
    margin-left: 8%;
    justify-content: center;
  }
  .img-items {
    width: 17%;
  }
  .middle {
  padding-left: 0;
  }
  p {
  margin: 0;
  width: 100%;
  padding-left: 10%;
}

}
@media screen and (max-width: 767px){
.first h2{
font-size: 2rem;
width: 100%;
}
.row{
margin: 0px;
}
hr{
width: 10%;
}
.middle{
background: white;
}
p{
padding-left: 15%;
width: 90%;
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
}

.hideButton{
display: block;
}
}
@media screen  and (max-width: 670px){
  .first p {
    font-size: 1.5rem;
  }
}
@media screen and (max-width: 575px){
  .companies {
    display: none;
  }
  .img-items-slider {
    display: block;
    margin-top: 5%;
  }
  .carousel-item{
    width: 70% !important;
  }
  .slider-item {
    img {
      width: 50%;
    }
  }

}
@media screen  and (max-width: 570px){
  .middle {
    text-align: center;
  }
  p {
    width: 100%;
    font-size: 1.5rem;
    padding: 0 6%;
  }
}
@media screen and (max-width: 530px) {
.main-companies {
margin-left: 0;
}
.first {
margin-left: 0;
  h2 {
    padding-left: 10%;
  }
hr {
  margin-left: 11%;
}
}
p {
width: 100%;
padding: 0;
line-height: 1.5;
font-size: 1.5rem;
  text-align: left;
  padding-left: 10%;
}
.hideButton button {
width: 90%;
font-size: 1.4rem;
}

}
  @media screen and (max-width: 414px) {
    .slider-swiper-main {
      width: 100%;
    }
  }
@media screen and (max-width: 320px) {
.first h2 {
width: 100%;
font-size: 2.5rem;
}
  .img-items{
    width: 48%;
  }
}
</style>
