<template>
  <div class="main">
    <div class="first">
      <h2>Hoe werkt het?</h2>
      <hr>
    </div>
    <div class="content">

      <div class="content-item">
        <div class="item-img">
          <img v-lazy="src1" alt="image">
        </div>
        <div class="item-content">
            <h2 @click="onClick('clicked1')">Krijg uitdagende opdrachten <span class="content-title-arrow"><img v-lazy="src5" alt="down"></span></h2>
          <ul :class="{'clicked-item': clicked1}">
            <li><span class="dot"></span><p>Causeffect is een online platform waar freelance specialisten zich kunnen aanmelden.</p></li>
            <li><span class="dot"></span><p>Je hoeft niet langer op zoek naar opdrachtgevers. Zij vinden jou!</p></li>
            <li><span class="dot"></span><p>Door een profiel aan te maken ben je zichtbaar voor verschillende opdrachtgevers.</p></li>
            <li><span class="dot"></span><p>Binnen jouw profiel geef je aan wat jouw specialiteiten zijn.</p></li>
          </ul>
        </div>
      </div>

      <div class="content-item">
        <div class="item-content left">
          <h2 @click="onClick('clicked2')">Krijg uitdagende opdrachten <span class="content-title-arrow"><img v-lazy="src5" alt="down"></span></h2>
          <ul :class="{'clicked-item': clicked2}">
            <li><span class="dot"></span><p>Causeffect On Demand maakt het gemakkelijk voor freelancers om te connecten
              met opdrachtgevers om zo geweldige opdrachten te krijgen.</p></li>
            <li><span class="dot"></span><p>Doordat je bij het aanmelden direct aangeeft wat jouw specialiteiten zijn zal je altijd
              benaderd worden door opdrachtgevers die direct weten wat ze aan je hebben.</p></li>
            <li><span class="dot"></span><p>Causeffect On Demand sluit zelf de overeenkomst met de opdrachtgever. Zo heb jij
              geen administratieve rompslomp en weet je direct wanneer je jouw vergoeding kan
              ontvangen.</p></li>
          </ul>
        </div>
        <div class="item-img">
          <img v-lazy="src2" alt="image">
        </div>
      </div>

      <div class="content-item">
        <div class="item-img">
          <img v-lazy="src3" alt="image">
        </div>
        <div class="item-content right">
          <h2 @click="onClick('clicked3')">Krijg uitdagende opdrachten <span class="content-title-arrow"><img v-lazy="src5" alt="down"></span></h2>
          <ul :class="{'clicked-item': clicked3}">
            <li><span class="dot"></span><p>De opdrachtgevers hebben van tevoren al gekeken wat jouw specialiteiten zijn, dus
              je zal altijd een uitdagende opdracht krijgen binnen jouw expertise.</p></li>
            <li><span class="dot"></span><p>Causeffect On Demand doet de onderhandelingen zodat jij altijd precies weet wat
              je bij de opdrachtgever moet uitvoeren.</p></li>
            <li><span class="dot"></span><p>
              Om zo efficiënt mogelijk te werken biedt Causeffect verschillende trainingen aan.
              Naarmate je meer werkzaamheden namens Causeffect On Demand hebt verricht,
              des te meer trainingen en cursussen je kan volgen.</p></li>
            <li><span class="dot"></span><p>Je kan zelf via het platform aangeven wanneer je wel en niet beschikbaar bent om
              te werken. Zo houd je controle over je eigen agenda en blijf je flexibel!</p>
            </li>
          </ul>
        </div>
      </div>

      <div class="content-item">
        <div class="item-content left">
          <h2 @click="onClick('clicked4')">Krijg uitdagende opdrachten <span class="content-title-arrow"><img v-lazy="src5" alt="down"></span></h2>
          <ul :class="{'clicked-item': clicked4}">
            <li><span class="dot"></span><p>Bij Causeffect On Demand is altijd duidelijk wat je voor vergoeding krijgt.
              Causeffect hanteert een vast uurtarief dat stijgt naarmate je meer verschillende
              werkzaamheden voor ons kan verrichten. </p></li>
            <li><span class="dot"></span><p>Je hoeft geen factuur op te stellen en na te sturen. Causeffect On Demand zorgt
              ervoor dat jij op tijd je vergoeding ontvangt. </p></li>
            <li><span class="dot"></span><p>Van tevoren is duidelijk opgesteld hoeveel uur er voor een opdracht gerekend wordt.
              Zo weet jij precies wat je gaat ontvangen voor een opdracht, maar dus ook hoelang
              je er mee bezig zal zijn. </p></li>
          </ul>
        </div>
        <div class="item-img">
          <img v-lazy="src4" alt="image">
        </div>
      </div>

    </div>

  </div>
</template>

<script>
    export default {
      data() {
        return {
          clicked1: false,
          clicked2: false,
          clicked3: false,
          clicked4: false,
          src1:require(`../../assets/registrationSpecialist/work_img_1.png`),
          src2:require(`../../assets/registrationSpecialist/work_img_2.png`),
          src3:require(`../../assets/registrationSpecialist/work_img_3.png`),
          src4:require(`../../assets/registrationSpecialist/work_img_4.png`),
          src5:require(`../../assets/icons/arrow_down.png`),

        }
      },
      methods: {
        onClick(name){
          this[name] = !this[name];
        },
      }
    }
</script>

<style scoped lang="scss">
  .content-title-arrow {
    display: none;
  }
  ul {
    list-style: none;
    padding: 0;
    margin-top: 3%;
  }
  li {
    color: #969696;
    font-family: GolanoRegular;
    font-size: 24px;
    font-weight: 400;
    line-height: 34px;
    margin-bottom: 3%;
    display: flex;
    position: relative;
  }
  .dot {
    width: 8px;
    height: 8px;
    display: inline-block;
    background: #969696;
    border-radius: 45%;
    margin-right: 2%;
    position: absolute;
    top: 11px;
    left: -2px;

  }
  p {
    margin-left: 3%;
    margin-bottom: 0;
  }
  .first {
    margin-top: 7%;
    margin-left: 10.8%;
    h2{
      word-break: break-word  ;
      color: #00c8d7;
      font-family: GolanoSemi;
      font-size: 3.82vw;
      font-weight: 400;
      width: 50%;
      letter-spacing: -2px;
    }
    hr{
      margin:29px 0 29px 0;
      width: 5.5%;
      height: 0.5vw;
      background-color: #00c8d7;
    }
  }
  .content {
    margin-left: 11%;
    margin-top: 5.5%;
  }
  .content-item {
    display: flex;
    margin-bottom: 7%;
  }
  .item-img {
    width: 21%;
    img {
      width: 100%;
    }
  }

  .item-content {
    width: 64%;
    margin-left: 6%;
    h2 {
      color: #646464;
      font-family: GolanoSemi;
      font-size: 40px;
      font-weight: 400;
      line-height: 48px;
    }
  }
  .left {
    margin-left: 0;
    margin-right: 7%;
    ul {
      li {
        line-height: 44px;
        margin-bottom: 2%;
      }
    }
  }
  .right {
      ul {
        li {
          line-height: 44px;
          margin-bottom: 2%;
        }
      }
    }
  @media screen and (max-width: 1200px) {
    li {
      font-size: 1.5rem;
    }
    .left ul li {
      font-size: 1.5rem;
    }
    .item-content h2 {
      font-size: 2rem;
    }
  }
  @media screen and (max-width: 991px) {
    .first hr {
      width: 10%;
      height: 0.5vw;
    }
  }
  @media screen and (max-width: 767px) {
    li {
      margin-left: 10%;
      line-height: 1.6;
    }
    .dot {
      top: 16px;
    }
    .first h2 {
      font-size: 2rem;
    }
    .item-content h2 {
      font-size: 1.7rem;
    }
  }

  @media screen and (max-width: 720px) {
    .clicked-item {
      margin-bottom: 10%;
    }
    .content-title-arrow{
      display: inline-block;
      margin-left: 14%;
    }
    ul {
      display: none;
    }
    .clicked-item {
      display: block;
    }
    .left ul li {
      line-height: 1.5;
    }
    .right ul li {
      line-height: 1.5;
    }
    .first h2 {
      width: 100%;
    }
    .dot {
      top: 11px;
    }
  }

  @media screen and (max-width: 530px) {
    .first {
      margin-left: 0;
      h2 {
        padding-left: 10%;
      }
      hr {
        margin-left: 11%;
      }
    }
    li {
      line-height: 1.5;
    }
    .content {
      margin-left: 0;
    }
    .content-item {
      display: flex;
      flex-direction: column;
      text-align: center;
    }
    .item-img {
      width: 100%;
      order: 0;
      img {
        width: 30%;
      }
    }
    .item-content {
      width: 100%;
      margin-left: 0;
      order: 1;
    }
    .clicked-item {
      padding: 1% 0 0 5%;
      text-align: left;
    }
    .content-title-arrow {
      margin-left: 2%;
      line-height: 1.5;
    }
  }

</style>
