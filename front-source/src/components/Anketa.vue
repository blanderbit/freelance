<template>
  <div class="wrapper">
    <div class="main">

      <div class="header">
        <img v-lazy="getBaseURL() + user_avatar_url" alt="first" class="avatar">
        <h3>{{name || '...'}}</h3>
        <p>{{role || '...'}}</p>
      </div>

      <div class="body">
        <StarComponent :stars_count="Number(stars)"></StarComponent>

        <p v-if="type==='text'">
          {{ textBody || '...' }} <span>{{ date || '...' }}</span>
        </p>
      </div>

      <div class="footer">
        <div class="btn-wrap" @click="onOpenPopUp">
          <Button
            v-if="type == 'stars' || type == 'text'"
            btnText="VRAAG AAN"
            btnClass="btnOrangeNav"
            stylesImg="width:15px">
          </Button>
        </div>

        <div class="btn-wrap" @click="order">
          <Button
            v-if="type == 'stars' || type == 'text'"
            btnText="BEKIJK PROFIEL"
            btnClass="btnWhite"
            stylesImg="width:15px">
          </Button>
        </div>
      </div>

    </div>

  </div>
</template>
<script>
  import Button from './common/Button';
  import StarComponent from './common/StarComponent';
  import {base_url} from "../axios.config";

  export default {
    props: {
      user_avatar_url: String,
      name: String,
      lastName: String,
      role: String,
      type: String,
      textBody: String,
      date: String,
      stars: Number,
      specialistId: [String, Number],
    },
    data() {
      return {
        clickedPopUp: false
      }
    },
    methods: {
      getBaseURL: () => base_url,
      order(){
        // this.$router.push({path: `/orderSpecialist/${this.specialistId}`});
        window.location.href = `${window.location.origin}/orderSpecialist/${this.specialistId}`
      },
      onOpenPopUp() {
        this.$store.dispatch('specialistPopUp/statePopUpAct', true);
        this.$store.dispatch('specialistList/selectedSpecialist', this.specialistId);
        document.getElementsByTagName('body')[0].style.overflow = 'hidden';
      },
    },
    components: {
      Button,
      StarComponent
    },
  }
</script>

<style scoped lang="scss">
  .wrapper {
    padding: 0 7.5px;
  }

  div.main {
    border: 2px solid #d7d7d7;
  }

  img {
    max-width: 100%;
    display: inline-block;
  }

  .header {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 4% 8% 0 8%;
    border-bottom: 2px solid #d7d7d7;

    img {
      width: 55%;
      border-radius: 50%;
    }
  }

  .body {
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

  .footer {
    width: 100%;
    padding: 7% 0px;
    display: flex;
    justify-content: space-around;
  }

  h3 {
    font-size: 2vw;
    color: #646464;
    font-family: GolanoRegular;
    font-weight: 600;
    margin: 0px;
    margin-top: 10px;
  }

  p {
    color: #646464;
    font-family: GolanoRegular;
    font-size: 1.4vw;
    font-weight: 400;
    line-height: 1.5;
  }

  .btn-wrap {
    width: 45%;
  }

  button {
    width: 100%;
    padding: 1% 7%;
    display: flex;
    justify-content: center;
    align-items: center;

  }

  @media screen and (max-width: 1780px) {
    button {
      font-size: 0.8rem;
      padding: 3% 0;
    }
  }

  @media screen and (max-width: 1650px) {
    button {
      font-size: 0.8rem;
    }
  }

  @media screen and (max-width: 1430px) {
    button {
      font-size: 0.7rem;
    }
  }

  @media screen and (max-width: 1300px) {
    .footer {
      flex-direction: column;
      align-items: center;

      .btn-wrap {
        width: 90%;
        margin-bottom: 3%;

      }

      button {
        width: 100%;
        padding: 3% 0;
      }
    }
  }

  @media screen and (max-width: 1320px) {
    button {
      font-size: 0.67rem;
      padding: 3% 0;
    }
  }

  @media screen and (max-width: 1300px) {
    button {
      font-size: 1rem;
    }
  }

  @media screen and (max-width: 1200px) {
    .footer button {
      font-size: 15px;
    }
  }

  @media screen and (max-width: 1106px) {
    .footer button {
      font-size: 13px;
      padding: 2% 0;
    }
    p {
      font-size: 2.5vw;
    }
  }

  @media screen and (max-width: 880px) {
    .footer button {
      font-size: 1.3rem;

      img {
        width: 100%;
      }
    }
  }

  @media screen and (max-width: 780px) {
    .footer button {
      font-size: 1.1rem;
    }
  }

  @media screen and (max-width: 640px) {
    .wrapper {
      margin-bottom: 5%;
    }
    .header {
      padding: 2%;
    }
    h3 {
      font-size: 3vw;
    }
    p {
      font-size: 3vw;
    }

    .footer button {
      font-size: 1rem;
      border-radius: 5px;
      border-width: 2px;
      padding: 10px 5px;

      img {
        width: 50% !important;
      }
    }
  }

  @media screen and (max-width: 575px) {
    .wrapper {
      padding: 0 10%;
      width: 100%;
    }
    .header {
      display: flex;
      flex-direction: column;
      align-items: center;

      h3 {
        font-size: 1.7rem;
      }

      p {
        font-size: 1.3rem;
      }
    }
  }

  @media screen and (max-width: 490px) {
    .header h3 {
      font-size: 1.4rem;
    }
  }

  @media screen and (max-width: 440px) {
    .wrapper {
      padding: 0;
    }
  }

</style>
