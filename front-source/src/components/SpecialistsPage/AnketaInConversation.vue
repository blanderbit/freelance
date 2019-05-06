<template>
  <div class="wrapper">
    <div class="main">
      <div class="header">
        <img src="../../assets/tape.png" alt="tape" class="tape">
        <img :src="personBg" alt="first" class="logo-img">
        <h3>{{name}}</h3>
        <p>{{text}}</p>
      </div>
      <div class="body-items">
        <img
          v-for="star in stars"
          :key="Math.random()+star"
          :src="mysrc1"
          alt="star">
      </div>
      <div class="footer">

          <Button
            btnText="VRAAG AAN"
            btnClass="btnOrangeNav"
            stylesImg="width:15px">
          </Button>

        <Button
          btnText="BEKIJK PROFIEL"
          btnClass="btnWhite"
          stylesImg="width:15px">
        </Button>
      </div>
    </div>
    <div class="wrapp-disabled"></div>

  </div>
</template>
<script>
  import Button from '../common/Button';

  export default {
      data(){
          return {
              mysrc1: require(`../../assets/icons/star-active.png`),
            personBg: require(`../../assets/person.png`)
          }
      },
    components:{
      Button,

    },
    props:['name','text','img','stars'],
  }
</script>
<style scoped lang="scss">
  .wrapper{
    padding: 0 7.5px;
    position: relative;
  }
  div.main{
    border: 2px solid #d7d7d7;
  }
  img{
    max-width: 100%;
  }
  .header{
    padding: 4% 8% 0 8%;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-bottom: 2px solid #d7d7d7;
    position: relative;
    .logo-img {
      width: 55%;
      border-radius: 50%;
    }
  }
  .tape {
    width: 65%;
    position: absolute;
    top: 0;
    right: 0;
    z-index: 300;
  }

  .body-items{
    display: flex;
    justify-content: center;
    border-bottom: 2px solid #d7d7d7;
    padding: 6% 0px;
    p {
      color: #00c8d7;
      font-size: 25px;
      font-weight: 400;
      line-height: 30px;
      margin: 0;
      span {
        font-family: GolanoSemi;
      }

    }
  }
  .footer{
    width: 100%;
    padding: 7% 0px;
    display: flex;
    justify-content: center;
  }
  h3{
    font-size: 2vw;
    color: #646464;
    font-family: GolanoRegular;
    font-weight: 600;
    margin: 0px;
    margin-top: 10px;
  }
  p{
    color: #646464;
    font-family: GolanoRegular;
    font-size: 1.4vw;
    font-weight: 400;
    line-height: 1.5;
  }
  button{
    width: 45%;
    padding: 1% 7%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 3%;
    margin-left: 4%;


  }
  .wrapp-disabled {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
    background: #ffffff45;
    cursor: not-allowed;
  }
  @media screen and (max-width: 1780px) {
    .footer button{
      font-size: 1rem;
      padding: 3% 0 !important;
    }
  }
  @media screen and (max-width: 1600px) {
    .footer button{
      font-size: 0.8rem;
    }
  }
  @media screen and (max-width: 1300px) {
    .footer {
      flex-direction: column;
      button {
        width: 92%;
        margin-bottom: 3%;
      }
    }
  }
  @media screen and (max-width: 1200px) {
    .footer button{
      font-size: 15px;
    }
  }
  @media screen and (max-width: 1106px) {
    .footer button{
      font-size: 13px;
      padding: 2% 0;
    }
    p{
      font-size: 2.5vw;
    }
  }
  @media screen and (max-width: 637px) {
    .wrapper{
      margin-bottom: 5%;
    }
    .header{
      padding: 2%;
    }
    h3{
      font-size: 3vw;
    }
    p{
      font-size: 3vw;
    }
    .footer {
      flex-direction: column;
    }
    .footer button{
      font-size: 1.5vw;
      border-radius: 5px;
      border-width: 2px;
      padding: 10px 5px;
      width: 92%;
      font-size: 15px;
      margin-bottom: 3%;
      img{
        width: 50% !important;
      }
    }
  }
  @media screen and (max-width: 575px){
    .wrapper{
      padding: 0 10%;
    }
    .header {
      h3 {
        font-size: 6vw;
      }
      p{
        font-size: 5vw;
      }
    }
  }
  @media screen and (max-width: 440px){
    .wrapper{
      padding: 0;
    }
  }
</style>
