<template>
    <div class="calendar-main">
      <div class="btn-items">
        <div :class="{active: activeFirst}" @click="btnClickFirst">Kennismaking inplannen</div>
        <div :class="{active: activeLast}" @click="btnClickLast">Proefdag aanvragen</div>
      </div>
      <hr>
      <div v-if="activeFirst" class="direct">
        <Direct></Direct>
      </div>
      <div v-if="activeLast" class="trial-day">
        <TrialDay></TrialDay>
      </div>

    </div>
</template>

<script>
  import Direct from './DirectPart';
  import TrialDay from './TrialDayPart';
    export default {
      data() {
        return {
          activeFirst: true,
          activeLast: false,
        }
      },
      methods: {
        btnClickFirst(){
          this.activeFirst = true;
          this.activeLast = false;
        },
        btnClickLast(){
          this.activeLast = true;
          this.activeFirst = false;
        }
      },
      components: {
        Direct,
        TrialDay
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
  .btn-items {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-bottom: 8%;
    margin-top: 5%;
    div {
      width: 45%;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 10px;
      border: 3px solid transparent;
      color: #646464;
      font-family: GolanoRegular;
      font-size: 1.5rem;
      font-weight: 400;
      line-height: 1;
      cursor: pointer;
      &:hover {
        color: black;
      }
    }
    .active {
      border: 3px solid #ff8400;
      font-family: GolanoSemi;
    }
    :first-child {
      margin-right: 5%;
      padding: 2% 4%;
    }

  }
  hr {
    height: 2px;
    background-color: #d7d7d7;
    width: 93%;
    margin-top: 3%;
  }
  @media screen  and (max-width: 1540px){
    .btn-items div {
      font-size: 1.2rem;
    }
  }
  @media screen  and (max-width: 1235px){
    .btn-items div {
      font-size: 1.1rem;
    }
  }
  @media screen  and (max-width: 1030px){
    .btn-items {
      flex-direction: column;
      align-items: center;
      div, :first-child  {
        font-size: 1.3rem;
        width: 75%;
        padding: 4% 0%;
        margin-bottom: 3%;
        margin-right: 0;
      }
    }
  }

  @media screen  and (max-width: 500px){
    .btn-items div {
      font-size: 1.2rem;
    }
  }

  @media screen  and (max-width: 380px){
    .btn-items {
      div,:first-child {
        width: 90%;
        font-size: 1.2rem;
        padding: 5% 0;
      }
    }
  }

</style>
