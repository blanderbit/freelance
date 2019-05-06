<template>
  <div>
    <ContactHeader></ContactHeader>
    <div class="address-item">
      <h2>Zanddwarsstraat 12, Amsterdam</h2>
      <hr>
    </div>
    <div class="map-item">
      <img v-lazy="src1" alt="map">
    </div>
  </div>
</template>
<script>


  import ContactHeader from './ContactHeader';



  export default {
      data(){
          return {
              src1:require(`../../assets/icons/map.png`),
          }
      },
    components: {
      ContactHeader,
    },
    methods: {
      scrollToTop() {
        window.scrollTo(0, 0);
      }
    },
    mounted() {
      this.scrollToTop();
    },

  }
</script>
<style scoped lang="scss">
  h2{
    word-break: break-word;
    margin-left: 15px;
    letter-spacing: -4px;
    color: #00c8d7;
    font-family: GolanoSemi;
    font-size: 70px;
    font-weight: 400;
    line-height: 90px;
    margin-bottom: 30px;
    letter-spacing: 1px;
  }
  hr{
    width: 5.4%;
    height: 10px;
    margin-top: 40px;
    margin-left: 34px;
    background-color: #00c8d7;
  }
  .address-item {
    padding: 10% 0 0 10%;

  }
  .map-item {
    height: auto;
    margin-top: 85px;
    padding-left: 12%;
    padding-bottom: 130px;
    background-image: url("../../assets/bigArrow.png");
    background-repeat: no-repeat;
    background-size: contain;
    background-position-x: -5px;
    img {
      width: 95%;
    }
  }

  @media screen  and (max-width: 1200px){
    h2{
      font-size: 3.5rem;
    }
  }
  @media screen  and (max-width: 767px){
    h2 {
      font-size: 2rem;
      margin-left: 0;
      line-height: 1.3;
    }
    hr {
      width: 10%;
      margin-left: 0;
      height: 0.5vw;
    }
  }
  @media screen  and (max-width: 540px){
    .address-item {
      padding: 0;
      padding-left: 9%;
      margin-top: 10%;
    }
    .map-item {
      padding-left: 0;
      img {
        width: 100%;
      }
    }
  }
  @media screen  and (max-width: 320px){
    h2{
      font-size: 2rem;
      line-height: 35px;
      margin-bottom: 0;
    }
    hr {
      width: 14%;
      height: 0.5vw;
    }

    .map-item {
      margin-top: 40px;
      padding-left: 3%;
      img {
        width: 98%;
      }
    }
  }


</style>
