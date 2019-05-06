<template>
    <div class="leftHome">
        <h2>
          Onze specialisten
          bij jou op locatie!

        </h2>
        <hr>
        <p>Wat kunnen onze communicatie specialisten voor jou
          betekenen? Behaal jouw communicatie-
          doelstellingen met de on demand specialisten
          van Causeffect.
        </p>
        <div class="btnCustom">
          <router-link to="/huurEenSpecialist?user_hourly_rate=30.00&user_place_to_work=&user_region=&user_city=">
            <Button btnText="VRAAG EEN SPECIALIST AAN"
                    btnClass="btnOrangeNav">
            </Button>
          </router-link>
        </div>
        <div class="btnCustom">
          <router-link to="/specialist">
            <Button btnText="MELD JE AAN ALS SPECIALIST"
                    btnClass="btnWhite">
            </Button>
          </router-link>
        </div>
    </div>
</template>
<script>
    import Button from '../Button';
    export default {
        components:{
            Button
        }
    }
</script>
<style scoped lang="scss">
    .leftHome{
        margin-top: 23%;
    }
    h2{
        word-break: break-word;
        font-size: 3.5vw;
        font-weight: 400;
        letter-spacing: 2px;
        line-height: 1;
        color: #00c8d7;
        margin-bottom: 8%;
        font-family:GolanoSemi ;
    }
    hr{
        margin-left: 1%;
        width: 14%;
        height: 0.5vw;
        max-height: 100%;
        background-color: #00c8d7;
    }
    p{
        padding: 7% 0 0 8%;
        color: #969696;
        font-size: 1.5vw;
        font-weight: 400;
        line-height: 1.69;
        font-family:GolanoRegular ;
        margin-bottom: 9%;
        letter-spacing: -0.5px;
    }
    .btnCustom{
        margin: 4% 0;
        button{
            width: 75%;
            font-size: 1.24vw;
            padding: 3% 0;
        }
    }

    @media screen and (max-width: 1405px){
      .leftHome {
        margin-top: 10%;
        width: 100%;
      }
      h2 {
        margin: 0;
      }
      p {
        padding: 0;
        margin: 0;
        margin-bottom: 8%;
      }
      .btnCustom {
        margin: 2%;
        width: 100%;
      }
      .btnCustom {
        button{
          width: 80%;
        }
      }
    }
    @media screen  and (max-width: 1200px){
      p {
        font-size: 1.4rem;
      }
    }
    @media screen and (max-width: 950px){
      p {
        font-size: 1.2rem;
      }
      .btnCustom {
        button{
          width: 100%;
          font-size: 1rem;
        }
      }
    }
    @media screen and (max-width: 910px){
      .btnCustom {
        button{
          width: 100%;
          font-size: 0.9rem;
        }
      }
    }
    @media screen and (max-width: 850px){
      .btnCustom {
        button{
          width: 100%;
          font-size: 0.8rem;
        }
      }
    }
    @media screen and (max-width: 767px){
      .leftHome {
        text-align: center;
      }
      h2{
        text-align: left;
        font-size: 2rem;
      }
      p{
        font-size: 1.5rem;
        text-align: left;
        margin-bottom: 10%;
      }
      .btnCustom button{
        width: 80%;
        font-size: 1.3rem;
      }
    }
    @media screen  and (max-width: 630px){
      .btnCustom button{
        width: 90%;
      }
    }
    @media screen  and (max-width: 670px){
      h2 {
        font-size: 3rem;
      }
      p{
        font-size: 1.5rem;
        margin-bottom: 10%;
      }
      hr {
        margin: 2rem 0;
      }
    }
    @media screen and (max-width: 555px){
        .btnCustom button{
            font-size: 1.1rem;
        }
    }
    @media screen and (max-width: 485px){
        .btnCustom button{
            width: 90%;
            font-size: 1.1rem;
        }
    }
    @media screen  and (max-width: 450px) {
      h2 {
        font-size: 2.5rem;
      }
      p{
        font-size: 1.2rem;
      }
    }
    @media screen and (max-width: 414px){
      .btnCustom {
        margin-top: 20px;
      }
      .btnCustom button {
        width: 100%;
        font-size: 1rem;
      }
    }
    @media screen  and (max-width: 360px) {
      h2 {
        font-size: 2rem;
      }
      p{
        font-size: 1.4rem;
      }
    }

    @media screen and (max-width: 350px){
        .btnCustom button{
            width: 100%;
            font-size: 0.8rem;
        }
    }

    @media screen and (max-width: 320px){

      h2{
        font-size: 2rem;
        text-align: left;
      }
      p{
        font-size: 1.5rem;
        text-align: left;
        margin-bottom: 10%;
      }
      .btnCustom button{
          padding: 5% 0;
          margin-bottom: 3%;
          font-size: 0.9rem;
      }
    }
</style>
