<template>
    <b-container fluid class="main">
        <b-row class="backgroundImage gradient-background">
            <b-col md="6">
                <h2>
                    Benieuwd wat Causeffect
                    voor jou kan betekenen?
                    Meld je aan voor een
                    gratis consult!
                </h2>
                <hr>
              <div class="div-form">

                <div class="input-item-wrapp input-class">
                  <input type="text" placeholder="Bedrijfsnaam" class="inputWhite" v-model="regName">
                </div>
                <div class="input-item-wrapp input-class">
                  <input type="email" placeholder="E-mailadres" class="inputWhite" v-model="regEmail">
                  <h3 class="valid-error">{{validRegForm.email}}</h3>
                </div>
                    <button @click="onClick"
                            :disabled="regName==='' || regEmail ===''">
                        AANVRAGEN
                        <img v-lazy="src" alt="arrowWhite">
                    </button>
              </div>
            </b-col>
            <b-col md="4" offset-md="2" class="secondSide">
                <h2>Heb je vragen?
                    Wij hebben het
                    antwoord.</h2>
                <hr>
                <p>085 130 3493</p>
                <p class="base-email">{{base_email}}</p>
                <ul>

                    <!--<li><router-link to="/" @click="onScroll">Vacatures</router-link></li>
                    <li><router-link to="/onsWerk" @click="onScroll">Ons werk</router-link></li>-->
                    <li><router-link to="/onsVerhaal" @click="onScroll">Ons verhaal</router-link></li>
                    <li><router-link to="/contact" @click="onScroll">Contact</router-link></li>
                </ul>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
    import  {base_email} from "../../axios.config";
    import  axios from "../../axios.config";
  export default {
    data() {
      return {
          base_email: base_email,
        regName: '',
        regEmail:'',
        validRegForm: {
          name: '',
          email: '',
        },
          src:require(`../../assets/icons/arrow-long-white.png`),
      }
    },
    methods: {
      onClick(){
        const patternEmail =/.+@.+\..+/i;
        let valid = false;

            if(!patternEmail.test(this.regEmail)) {
            this.validRegForm.email = 'error Email';
            this.regEmail = '';
            valid = false;
          }
          else {
            this.validRegForm.email = '';
            valid = true;
          }

          if (valid) {
              let data = new FormData();
              data.append('footer_form', 1);
              data.append('user_email', this.regEmail);
              data.append('user_name', this.regName);
              axios.post('/public/api/send_email.php', data)
                  .then(response => console.log(response))
                  .then(err => console.log(err));
          }
        },
        onScroll() {
          const bodyEl = document.getElementsByTagName('body')[0];
          bodyEl.scrollTop();
        }
      },

    }
</script>
<style scoped lang="scss">
    .base-email {
      font-size: 35px;

      @media screen and (max-width: 1366px){
        font-size: 20px;
      }

      @media screen and (max-width: 1366px){
        font-size: 14px;
      }
    }

    h2{
        color: #ffffff;
        font-family: GolanoSemi;
        font-size: 2.6vw;
        font-weight: 400;
        line-height: 1.35;
    }
    .valid-error {
      color: #f97e7e;
    }
    .backgroundImage .col-md-6:first-child h2{
        padding-right: 17%;
    }
    hr{
        width: 12%;
        margin-left: 0px;
        margin-top: 4%;
        height: 0.5vw;
        background-color: #ffffff;
    }
    p{
        color: #ffffff;
        font-family: GolanoRegular;
        font-size: 2.55vw;
        font-weight: 500;
        line-height: 1.55;
        margin-top: 19%;
        margin-bottom: 15%;

    }
    ul{
        margin: 0;
        padding: 0;
        color: #ffffff;
        font-family: GolanoRegular;
        font-size: 1.6vw;
        font-weight: 400;
        line-height: 1.95;
        list-style: none;
      li {
        a {
          text-decoration: none;
          color: white;
        }
        a:hover {
          color: #0e0e0e;
        }
      }
    }
    .backgroundImage{
        padding: 6% 5% 6% 9.5%;
        margin-top: 5%;
        background-repeat:no-repeat;
        background-size:cover;
        background-position:center;
    }

    .man-backgroundImage {
      background-image: url("../../assets/homepage/footer-background.png");
    }

    .gradient-background {
      background-image: linear-gradient(to left, #5BEBF2, #00CAD8);
    }

    .div-form{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: start;
        margin-top: 10.5%;

        button{
            cursor: pointer;
            margin-top: 7%;
            padding: 2% 9%;
            background: transparent;
            border-radius: 10px;
            border: 3px solid white;
            color: white;
            font-family: GolanoSemi;
            font-size: 1.55vw;
            font-weight: 400;
            line-height: 1.8;
            text-transform: uppercase;
        }
        button[disabled] {
          cursor: not-allowed;
          background: #f3f3f396;
          border: 3px solid #ffffff70;
        }
    }
    .div-form button:not([disabled]):hover {
        background: #00000052;
    }
    .secondSide{
        padding-left: 4%;
        hr{
            margin-top: 6.5%;
            margin-left: 4px;
            width: 19%;
        }
    }
    .input-item-wrapp {
      width: 95%;
    }
    input{
      width: 100%;
      &::placeholder{
        letter-spacing:-0.5px;
      }
      font-family: GolanoRegular;
      margin-bottom: 6%;
      font-size:2vw;
      padding: 12px 19px;
      outline: none;
      background: transparent;
      border: none;
    }
    .inputWhite{
      width: 80%;
      color: white;
      border-bottom: 4px solid white;
      &::placeholder{
        color: white;
      }
    }
    @media screen and (max-width: 767px){
        h2{
            padding-right: 0px !important;
            font-size: 5vw;
        }
        hr{
            height: 0.8vw;
        }
        .div-form input {
            width: 100%;
            font-size:3.4vw;
            border-width: 2px;
            padding: 5px 10px;
        }
        .div-form button{
            padding: 2% 9%;
            border-radius: 5px;
            border-width: 2.5px;
            font-size: 3vw;
            line-height: 1.8;
            margin-bottom: 7%;
        }
        p{
            margin: 0px;
            margin-top: 10%;
            font-size: 4vw;
            font-weight:900;
        }
        ul{
            display: none;
        }
    }
    @media screen and (max-width: 320px){
      .main {
        margin: 0;
        padding: 0;

      }
      .backgroundImage {
        padding: 0;
        margin: 0;
        margin-top: 5%;
      }
      h2 {
        padding-right: 0px;
        font-size: 2rem;
        text-align: left;
        padding-top: 10%;
      }
      .div-form input {
        font-size: 1.5rem;
      }
      .div-form button{
        width: 80%;
        font-size: 1rem;
        margin: 10% auto;
      }
      p {
        text-align: center;
        font-size: 6vw;
        margin-bottom: 5%;
      }
      hr {
        width: 14%;
        height: 0.5vw;
      }
      .secondSide hr {
        width: 14%;
        height: 0.5vw;
      }
    }
</style>
