<template>
    <div class="benefits-main">
      <div class="benefits-item">
        <img v-lazy="mysrc1" alt="image">
        <h2>Werken wanneer het jou uitkomt</h2>
        <p>
          Je kunt zelf aangeven wanneer je wel en niet kunt werken. Zo blijf je de baas over je eigen agenda en behoud je je flexibiliteit.
        </p>
      </div>
      <div class="benefits-item">
        <img v-lazy="mysrc2" alt="image" class="img-money">
        <h2>Verdien tot 75.000 euro per jaar</h2>
        <p>
          Causeffect doet alle onderhandelingen met de opdrachtgever. Zo weet jij altijd waar je aan toe bent en hoef je je niet druk te maken over salarisonderhandelingen en dergelijke. Wij houden het transparant.
        </p>
      </div>
      <div class="benefits-item">
        <img v-lazy="mysrc3" alt="image" class="img-bag">
        <h2>Geen gedoe met papierwerk</h2>
        <p>
          Nooit meer stress van zoeken naar een nieuwe job. Je volgende opdracht staat al klaar!
        </p>
      </div>

    </div>
</template>

<script>

    export default {
        data(){
            return {
                mysrc1:require(`../../assets/registrationSpecialist/obj_1.png`),
                mysrc2:require(`../../assets/registrationSpecialist/obj_2.png`),
                mysrc3:require(`../../assets/registrationSpecialist/obj_3.png`),
            }
        },
    }
</script>

<style scoped lang="scss">
  .benefits-main {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-top: 15%;

  }
  .benefits-item {
    width: 20%;
    text-align: center;
    height: auto;
    margin-right: 3%;
    img {
      margin-bottom: 15%;
    }
    .img-money {
      margin-top: 4%;
      margin-bottom: 16%;
    }
    .img-bag {
      margin-top: 2%;
    }
    h2 {
      margin: 0 11%;
      margin-bottom: 11%;
      color: #646464;
      font-family: GolanoSemi;
      font-size: 30px;
      font-weight: 400;
      line-height: 36px;
    }
    p {
      color: #969696;
      font-family: GolanoRegular;
      font-size: 24px;
      font-weight: 400;
      line-height: 44px;
    }
  }
  @media screen and (max-width: 1690px){
    .benefits-item{
      h2 {
        margin: 0 3%;
      }
      p {
        font-size: 18px;
        line-height: 30px;
      }
      .img-bag {
        margin-top: 1%;
      }


    }
  }
  @media screen and (max-width: 1690px){
    .benefits-item{
      h2 {
        font-size: 2rem;
      }
      p {
        font-size: 1.5rem;
        line-height: 30px;
      }
      .img-bag {
        margin-top: 0;
      }

    }
  }
  @media screen and (max-width: 1170px){
    .benefits-main {
      flex-direction: column;
      margin-left: 0;
      align-items: center;
    }
    .benefits-item {    width: 60%;
      margin: 0 0 5% 0;
      img {
        margin-bottom: 5%;
      }
      .img-money {
        margin-top: 0;
        margin-bottom: 6%;
      }
      .img-bag {
        margin-top: 0;
      }
    }
  }
  @media screen and (max-width: 991px){
    .benefits-main {
      margin-top: 20%;
    }
  }
  @media screen and (max-width: 770px){
    .benefits-main {
      margin-top: 10%;
    }
  }
  @media screen and (max-width: 450px){
    .benefits-item {
      width: 80%;
    }
  }
  @media screen and (max-width: 320px){
    .benefits-item {
      width: 100%;
      img {
        width: 40%;
      }
    }
  }
</style>
