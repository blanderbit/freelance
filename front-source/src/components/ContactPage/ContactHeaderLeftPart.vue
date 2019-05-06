<template>
    <div>
      <b-card  class="card-wrapp">
        <!--<span @click="closeForm" class="form-close"><img v-lazy="mysrc1" alt="close"></span>-->
        <p class="card-text item-title">Neem contact met ons op!</p>
        <hr>
        <div class="div-form">
          <div class="input-item-wrapp input-class">
            <input type="text" placeholder="Voor- en achternaam*" class="inputDark" v-model="contactName">
            <span class="valid-error">{{validMess.contactName}}</span>
          </div>
          <div class="input-item-wrapp input-class">
            <input type="email" placeholder="E-mailadres" class="inputDark" v-model="contactEmail">
            <span class="valid-error">{{validMess.contactEmail}}</span>
          </div>
          <div class="input-item-wrapp input-class">
            <input type="text" placeholder="Telefoonnummer" class="inputDark" v-model="contactPhone">
            <span class="valid-error">{{validMess.contactPhone}}</span>
          </div>
          <div class="input-item-wrapp input-class">
            <input type="text" placeholder="Uw vraag" class="inputDark" v-model="contactQuestion">
            <span class="valid-error">{{validMess.contactQuestion}}</span>
          </div>
        </div>
        <div class="btnCustom">
          <Button btnText="VERSTUUR"
              btnClass="btnOrangeNav"
              v-on:click-login="activContactForm()"
              :disabled="(contactName && contactEmail && contactPhone && contactQuestion) ===''">
          </Button>
        </div>
      </b-card>

</div>
</template>

<script>
  import Button from '../common/Button';
  export default {
      data(){
          return {
              src1:require(`../../assets/icons/close.png`),
              contactName: '',
              contactEmail: '',
              contactPhone: '',
              contactQuestion:'',
              valid: {},
              validMess: {
                name:'',
                email:'',
                phone:'',
                question:'',
              },
              messages:{
                  contactName: 'enter your name (3+)',
                  contactEmail: 'error Email',
                  contactPhone: 'must be only number(6+)',
                  contactQuestion: 'enter your question(6+)',
              }
          }
      },
      components:{
        Button
      },
      methods: {
          activContactForm(){
              const patternEmail =/.+@.+\..+/i;
              const patternPhone = /^\d+$/;
              const patterns = {
                  contactName: value => value.length > 5,
                  contactEmail: value => patternEmail.test(value),
                  contactPhone: value => patternPhone.test(value) && value.length > 5,
                  contactQuestion: value => value.length > 4
              };
              Object.keys(patterns).forEach(fieldName => {
                  const pattern = patterns[fieldName];
                  const value = this[fieldName];
                  if(!pattern(value)) {
                      this.validMess[fieldName] = this.messages[fieldName];
                      this[fieldName] = '';
                  } else {
                      this.valid[fieldName] = true;
                      this.validMess[fieldName] = '';
                  }
              });
              if (Object.keys(this.valid).length === 4) {
                  const data = new FormData();
                  data.append('name_and_surname', this.contactName);
                  data.append('email', this.contactEmail);
                  data.append('phone_number', this.contactPhone);
                  data.append('question', this.contactQuestion);
                  this.$store.dispatch('contact/contactForm', data);
                  this.contactName = '';
                  this.contactEmail = '';
                  this.contactPhone = '';
                  this.contactQuestion ='';
                  // messages = {};
              }

          }
      }
  }

</script>

<style scoped lang="scss">
  .valid-error {
    color: #f97e7e;
  }
  .input-item-wrapp {
    width: 95%;
  }
  .input-class {
    margin-bottom: 8%;
  }
  .inputDark{
    color: #646464;
    border-bottom: 2px solid #b7b7b7;
    font-size: 1.6rem;
    padding: 0px 0 0 10px;
    margin-bottom: 20px;
    &::placeholder{
      color: #646464;
    }
  }
  .div-form {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: start;
    margin-top: 6.5%;
    padding-left: 6%;
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
  hr {
    border-top: 2px solid #d7d7d7;
    width: 96%;
    margin-left: 20px;
    margin-bottom: 10%;
  }
  .card-wrapp{
    position: relative;
    border: 2px solid #d7d7d7;
  }
  .form-close{
    position: absolute;
    right: 20px;
    img {
      cursor: pointer;
    }
    hr {
      border-top: 2px solid #d7d7d7;
      width: 96%;
      margin-left: 20px;
      margin-bottom: 10%;
    }
  }
  .item-title{
    color: #00c8d7;
    font-family: GolanoSemi;
    font-size: 60px;
    font-weight: 400;
    line-height: 70px;
    padding: 8% 8% 7% 8%;
  }
  .input-class{
    margin-bottom: 25px;
  }
  .btnCustom{
    margin: 4% 0;
    margin-top: -5px;
    text-align: center;
    button{
      cursor: pointer;
      width: 280px;
      font-size: 1.24vw;
      padding: 3% 5%;
    }
  }
  @media screen  and (max-width: 1200px){
    .item-title{
      font-size: 4rem;
    }
  }
  @media screen  and (max-width: 991px){
    .inputDark{
      font-size: 1.6rem;
    }
    .btnCustom{
      button{
        font-size: 3vw;
      }
    }
  }
  @media screen  and (max-width: 767px){
    .card-wrapp {
      margin-top: 10%;
    }
    .item-title {
      font-size: 3rem;
    }
  }
  @media screen  and (max-width: 540px){
    .item-title{
      font-size: 2.5rem;
      line-height: 45px;
      text-align: center;
    }
    .input-class {
      margin-bottom: 40px;
    }
    .btnCustom{
      button{
        font-size: 4vw;
      }
    }
    .card-wrapp {
      margin-top: 3%;
    }
  }
  @media screen  and (max-width: 360px){
    .item-title {
      font-size: 2rem;
    }
    .input-class {
      margin-bottom: 7%;
    }
    .inputDark {
      font-size: 1.4rem;
    }
  }
  @media screen  and (max-width: 320px){
    .card-body {
      padding: 0;
    }
    .item-title{
      font-size: 2rem;
      line-height: 45px;
    }
    .form-close {
      display: none;
    }
    hr {
      margin-bottom: 15%;
      margin-left: 5px;
    }
    .inputDark{
      font-size: 1.4rem;
    }
    .input-class {
      margin-bottom: 15px;
    }
    .btnCustom{
      margin: 7% 0;
      button{
        font-size: 5vw;
        width: 220px;
      }
    }
  }
</style>
