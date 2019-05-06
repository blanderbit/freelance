<template>
  <div class="wrapper">
    <b-card>
      <span @click="closeCreateAccCard" class="form-close"><img src="../../../assets/icons/close.png" alt="close"></span>
      <p class="card-text item-title">Maak hier uw account aan.</p>
      <hr>
      <div class="div-form">
        <div class="input-item-wrapp input-class">
          <input type="email" placeholder="johndoe@gmail.com" class="inputDark" v-model="signUpEmail">
          <span class="valid-error">{{validSignUpForm.email}}</span>
        </div>
        <div class="input-item-wrapp input-class">
          <input type="password" placeholder="Wachtwoord" class="inputDark" v-model="signUpPass">
          <span class="valid-error">{{validSignUpForm.pass}}</span>
        </div>
        <div class="input-item-wrapp input-class">
          <input type="password" placeholder="Bevestig wachtwoord" class="inputDark" v-model="signUpPassRec">
          <span class="valid-error">{{validSignUpForm.passRec}}</span>
        </div>
      </div>

      <div class="btnCustom">
        <Button btnText="BEVESTIG"
                btnClass="btnOrangeNav"
                v-on:click-login="actingSignIn()"
                :disabled="signUpEmail==='' || (signUpPass && signUpPassRec) ===''" ></Button>
      </div>
    </b-card>
  </div>
</template>

<script>
  import Button from '../../common/Button';
    export default {
      components: {
        Button,
      },
      data() {
        return {
          signUpEmail: '',
          signUpPass: '',
          signUpPassRec: '',
          validSignUpForm: {
            email: '',
            pass: '',
            passRec: '',
          }
        }
      },
      methods: {
        closeCreateAccCard(){
          const bodyEl = document.getElementsByTagName('html')[0];
          bodyEl.style.overflowY= "scroll";
          this.$emit('closed-form');
        },
        actingSignIn(){
          const patternEmail =/.+@.+\..+/i;
          let valid = false;
          if(!patternEmail.test(this.signUpEmail)) {
            this.validSignUpForm.email = 'error Email';
            this.signUpEmail = '';
            valid = false;
          }
          else {
            this.validSignUpForm.email = '';
            valid = true;
          }

          if(this.signUpPass.length <= 6) {
            this.validSignUpForm.pass = 'pass > 6';
            this.signUpPass = '';
            valid = false;
          }
          else {
            this.validSignUpForm.pass = '';
            valid = true;
          };
          if( this.signUpPass !== this.signUpPassRec) {
            this.validSignUpForm.passRec = 'wrong pass';
            this.signUpPassRec = '';
            valid = false;
          }
          else{
            this.validSignUpForm.passRec = '';
            valid = true;
          };
          if (valid) {
            this.signUpEmail = '';
            this.signUpPass = '';
            this.signUpPassRec = '';
            this.$emit('closed-form');
            this.closeCreateAccCard();

          }

        }
      }

    }
</script>
<style scoped lang="scss">
  .wrapper {
    position: absolute;
    z-index: 3000;
    width: 55%;
  }
  .form-close {
    position: absolute;
    right: 25px;
    top: 25px;
    img {
      cursor: pointer;
    }
  }
  .item-title{
    color: #646464;
    font-family: GolanoRegular;
    font-size: 40px;
    font-weight: 400;
    line-height: 50px;
    margin-top: 7%;
    text-align: center;
  }
  .div-form {
    margin: 8% 1% 10% 6%;
  }
  .valid-error {
    color: #f97e7e;
  }
  .input-item-wrapp {
    width: 95%;
  }
  input{
    width: 100%;
    font-family: GolanoRegular;
    margin-bottom: 6%;
    font-size:2vw;
    padding: 12px 19px;
    outline: none;
    background: transparent;
    border: none;
    &::placeholder{
      letter-spacing:-0.5px;
    }
  }
  .input-class {
    margin-bottom: 8%;
  }
  .inputDark{
    color: #646464;
    border-bottom: 2px solid #b7b7b7;
    font-size: 1.7vw;
    padding: 0px 0 0 10px;
    margin-bottom: 20px;
    &::placeholder{
      color: #646464;
    }
  }
  .btnCustom{
    margin: 4% 0;
    margin-top: -5px;
    text-align: center;
    width:  100%;

    button{
      cursor: pointer;
      width: 280px;
      font-size: 1.24vw;
      padding: 2% 5%;
      width: 50%;
    }
  }
  @media screen and (max-width: 1200px){
    .item-title {
      font-size: 2rem;
    }
    .inputDark {
      font-size: 2rem;
    }
    .btnCustom button {
      font-size: 1.7rem;
    }
  }
  @media screen and (max-width: 900px){
    .item-title {
      padding: 0;
      margin-top: 10%;
      text-align: center;
      line-height: 40px;
    }
    .inputDark {
      font-size: 1.7rem;
    }
    .btnCustom button {
      font-size: 1.4rem;
      width: 60%;
    }
    .wrapper {
      width: 80%;
    }
  }
  @media screen and (max-width: 450px){
    .wrapper {
      width: 100%;
    }
    .item-title {
      font-size: 1.6rem;
    }
    .inputDark {
      font-size: 1.4rem;
    }
    .btnCustom button {
      font-size: 1.2rem;
    }
  }
</style>
