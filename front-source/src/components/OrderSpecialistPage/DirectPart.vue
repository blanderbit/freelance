<template>
    <div class="direct-main">

      <!--first hidden section-->
      <!--<div class="direct-items" v-if="false">-->
        <!--<h2>Voor hoeveel uur per dag wilt u een specialist inhuren?</h2>-->
        <!--<div class="hour-items">-->
          <!--<div class="hour-item"-->
               <!--v-for="(item, index) in hoursList"-->
               <!--@click="getVal(index)"-->
               <!--:class="{'active-hour': count===index}"-->
               <!--&gt;-->
            <!--<p class="hour-item-text">{{item.val}} uur</p>-->
          <!--</div>-->
        <!--</div>-->
        <!--<hr>-->
      <!--</div>-->


      <!--&lt;!&ndash;second hidden section&ndash;&gt;-->
      <!--<div class="calendar-part" v-if="false">-->
        <!--<h2>Voor hoeveel dagen wilt u een specialist inhuren?</h2>-->
        <!--<hr>-->
      <!--</div>-->

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
        <div class="btn-wrap"  @click="backToProfilePage">
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
  import { mapGetters } from 'vuex';
  export default {
      components: {
        Button
      },
      computed: {
        ...mapGetters({
          selectedSpecialist: 'specialistList/getSelectedSpecialist',
        }),
      },
      data() {
        return {
          timeStart: new Date(),
          timeEnd: new Date(),
          hoursList: [
            {val: 2},
            {val: 4},
            {val: 6},
            {val: 8},
          ],
          count: 0,
        }
      },
      methods: {
        getVal(index) {
          console.log(this.hoursList[index].val);
          this.count = index;
        },
        getStartTime(pos){
            if(pos === 'start'){
            let h = this.timeStart.getHours();
            let m = this.timeStart.getMinutes();
            let tt = String(h) +':' + String(m) ;
            console.log('---------------start------------', tt)
          }
          else {
              let h = this.timeEnd.getHours();
              let m = this.timeEnd.getMinutes();
              let tt = String(h) +':' + String(m) ;
              console.log('---------------end------------', tt)
            }
        },
        onNextPopUp(){
          this.$store.dispatch('specialistPopUp/partPopUpAct', 2);
        },
        backToProfilePage(){
          this.$router.push({ path: '/orderSpecialist/' + this.selectedSpecialist.id });
          const elBody = document.getElementsByTagName('body')[0];
          this.$store.dispatch('specialistPopUp/statePopUpAct', false);
          elBody.style.overflowY= 'scroll';
        },
      }
    }
</script>

<style scoped lang="scss">

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
  .direct-items {
    padding: 0 5%;
  }
  .hour-items {
    display: flex;
    justify-content: center;
    margin-top: 5%;
    margin-bottom: 8%;
  }
  .hour-item {
    width: 17%;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 3px solid transparent;
    margin-right: 5%;
    cursor: pointer;
  }
  p {
    color: #646464;
    font-family: GolanoRegular;
    font-size: 1.5rem;
    font-weight: 400;
    margin: 0;
    padding: 2% 0;
  }
  .active-hour {
    border-radius: 10px;
    border: 3px solid #ff8400;
    p {
      font-family: GolanoSemi;
    }

  }
  hr {
    height: 2px;
    background-color: #d7d7d7;
    width: 93%;
    margin-top: 3%;
  }
  .calendar-part {
    margin-top: 7%;
    padding: 0 5%;
  }

  .popover-container {
    width: 100%;
    display: flex;
    margin-top: 5%;
  }
  .time-items {
    display: flex;
    margin: 7% 0;
    padding: 0 4%;
    width: 100%;
  }
  .time-group {
    width: 50%;
    display: flex;
    align-items: center;
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
  .btn-wrap {
    width: 40%;
    margin: 0 5%;
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
    .hour-item {
      padding: 2% 0;
    }
    h2 {
      font-size: 2rem;
    }
    p{
      font-size: 1.5rem;
    }
    .hour-item-text {
      font-size: 1.3rem;
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
  @media screen  and (max-width: 815px){
    .hour-item {
      width: 20%;
    }
  }
  @media screen  and (max-width: 600px){
    .footer button {
      font-size: 1rem;
    }
    .hour-item {
      width: 22%;
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
  @media screen  and (max-width: 815px){
    .hour-item {
      width: 25%;
      margin-right: 2%;
    }
  }
  @media screen  and (max-width: 540px){
    .form-control {
      font-size: 1.3rem;
    }
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
    .hour-item-text {
      font-size: 1.2rem;
    }
  }
  @media screen  and (max-width: 460px){
    .hour-item {
      text-align: center;
      padding: 1% 0;
    }
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
    .hour-item {
      width: 40%;
      margin-bottom: 5%;
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
