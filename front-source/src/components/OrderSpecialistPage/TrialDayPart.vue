<template>
  <div class="direct-main">
    <!--<div class="calendar-part">-->
      <!--<h2>Voor hoeveel dagen wilt u een specialist inhuren?</h2>-->
    <!--</div>-->
    <!--<hr>-->
    <!--<div class="time-items">-->
      <!--<div class="time-group">-->
        <!--<div class="time-group-text">-->
          <!--<p class="time-text" @click="getStartTime('start')">Begintijd</p>-->
        <!--</div>-->
        <!--<div class="time-selected">-->
          <!--<TimePicker class="time-item" v-model="timeStart" :show-meridian="false"></TimePicker>-->
        <!--</div>-->
      <!--</div>-->
      <!--<div class="time-group">-->
        <!--<div class="time-group-text">-->
          <!--<p class="time-text" @click="getStartTime('end')">Eindtijd</p>-->
        <!--</div>-->
        <!--<div class="time-selected">-->
          <!--<TimePicker class="time-item" v-model="timeEnd" :show-meridian="false"></TimePicker>-->
        <!--</div>-->
      <!--</div>-->


    <!--</div>-->
    <!--<hr>-->
    <div class="footer">
      <div class="btn-wrap" @click="onNextPopUp">
        <Button
          btnText="BEVESTIG"
          btnClass="btnOrangeNav"
          stylesImg="width:25px">
        </Button>
      </div>
      <div class="btn-wrap">
        <Button
          btnText="BEKIJK PROFIEL"
          btnClass="btnWhite"
          stylesImg="width:25px">
        </Button>
      </div>
    </div>
  </div>
</template>

<script>
  import Button from '../common/Button';

  export default {
    components: {
      Button
    },

    data() {
      return {
        timeStart: new Date(),
        timeEnd: new Date(),

      }
    },
    methods: {

      getStartTime(pos){
        if(pos === 'start'){
          let mi = this.timeStart.getHours();
          let se = this.timeStart.getMinutes();
          let tt = String(mi) +':' + String(se) ;
          console.log('---------------start------------', tt)
        }
        else {
          let mi = this.timeEnd.getHours();
          let se = this.timeEnd.getMinutes();
          let tt = String(mi) +':' + String(se) ;
          console.log('---------------end------------', tt)
        }
      },
      onNextPopUp(){
        this.$store.dispatch('specialistPopUp/partPopUpAct', 2);
      }
    }
  }
</script>

<style scoped lang="scss">
  .btn-wrap {
    width: 40%;
    margin: 0 5%;
  }
  h2 {
    color: #646464;
    font-family: GolanoSemi;
    font-size: 34px;
    font-weight: 400;
  }
  .direct-main {
    width: 100%;
    margin-top: 7%;
  }

  p {
    color: #646464;
    font-family: GolanoRegular;
    font-size: 1.5rem;
    font-weight: 400;
  }

  hr {
    height: 2px;
    background-color: #d7d7d7;
    width: 93%;
    margin-top: 3%;
  }
  .calendar-part {
    margin-top: 7%;
    padding-left: 5%;
    margin-bottom: 62%;
  }

  .popover-container {
    width: 100%;
    display: flex;
    margin-top: 5%;
  }

  .time-group {
    width: 50%;
    display: flex;
    align-items: center;
  }
  .time-items {
    display: flex;
    margin: 7% 0;
    padding: 0 4%;
    width: 100%;
  }
  .time-item {
    border-radius: 10px;
    border: 2px solid #d7d7d7;
    padding: 4px 20px;
  }
  .time-selected {
    margin-right: 10%;
  }
  .time-text {
    margin-right: 2%;
  }
  .footer {
    width: 100%;
    margin-top: 4%;
    display: flex;
    justify-content: center;
    button{
      font-size: 1.2rem;
      width: 100%;
      padding: 5% 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  }
  @media screen  and (max-width: 1630px){
    .time-items {
      justify-content: center;
    }
    .time-group {
      width: 50%;
    }
  }
  @media screen  and (max-width: 1550px){
    .time-items {
      flex-direction: column;
      align-items: center;
    }
    .time-group {
      margin-bottom: 5%;
      width: 70%;
    }
    .time-group-text {
      width: 50%;
    }
  }
  @media screen  and (max-width: 1500px){
    .time-items {
      padding: 0;
      justify-content: space-around;
    }
  }
  @media screen  and (max-width: 1320px){
    .footer {
      justify-content: space-around;
    }
    .btn-wrap {
      margin: 0;
    }
    .footer button {
      font-size: 1rem;
    }
  }

  @media screen  and (max-width: 1260px){
    h2 {
      font-size: 2rem;
    }
    p {
      font-size: 1.5rem;
    }
    .btn-wrap {
      width: 40%;
      margin: 0 1%;
    }
  }

  @media screen  and (max-width: 1100px){
    .time-item {
      padding: 0;
    }
  }
  @media screen  and (max-width: 1030px){
    .btn-wrap {
      width: 47%;
    }
  }

  @media screen  and (max-width: 600px){
    .footer button {
      font-size: 1rem;
    }

    h2 {
      font-size: 1.5rem;
    }
    p {
      font-size: 1.2rem;
    }
    .footer {
      flex-direction: column;
      align-items: center;
    }
    .btn-wrap {
      width: 80%;
      margin-bottom: 5%;
    }
  }

  @media screen  and (max-width: 540px){
    .time-group {
      width: 90%;
    }
  }
  @media screen  and (max-width: 510px){
    p {
      font-size: 1rem;
    }
    .time-text {
      font-size: 1.3rem;
    }
  }
  @media screen  and (max-width: 460px){
    .active-hour p {
      font-size: 1.2rem;
    }
    .direct-items {
      padding: 0 2%;
    }

    .time-group-text {
      display: flex;
      align-items: center;
    }
  }
  @media screen  and (max-width: 380px){
    .hour-items {
      flex-wrap: wrap;
    }
    p {
      font-size: 1.3rem;
    }
    .time-text {
      font-size: 1.2rem;
    }
    .active-hour p {
      font-size: 1.3rem;
    }
  }

  @media screen  and (max-width: 325px){
    .btn-wrap {
      width: 85%;
    }
  }

</style>
