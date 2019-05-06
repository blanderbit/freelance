<template>
  <div class="wrapp">
    <div class="img">
      <img v-lazy="base_url + selectedSpecialist.user_avatar" alt="photo">
    </div>

    <div class="confirmation">
      <h2>U heeft interesse in <span>{{ selectedSpecialist.firstname }}</span>.</h2>
      <p>Vul uw gegevens in om de afspraak te bevestigen.</p>
    </div>
    <hr>
    <div class="form-wrapp">
      <div class="input-item-wrapp input-class">
        <input type="text" placeholder="Bedrijfsnaam" class="inputDark" v-model="companyName">
        <span class="valid-error">{{validMess.companyName}}</span>
      </div>

      <div class="input-item-wrapp input-class">
        <input type="text" placeholder="Contactpersoon" class="inputDark" v-model="contactName">
        <span class="valid-error">{{validMess.contactName}}</span>
      </div>

      <div class="input-item-wrapp input-class">
        <input type="text" placeholder="E-mailadres" class="inputDark" v-model="contactEmail">
        <span class="valid-error">{{validMess.contactEmail}}</span>
      </div>
      <div class="input-item-wrapp input-class">
        <input type="text" placeholder="Telefoonnummer*" class="inputDark" v-model="contactPhone">
        <span class="valid-error">{{validMess.contactPhone}}</span>
      </div>
      <div class="input-item-wrapp input-class">
        <input type="text" placeholder="Adres + huisnummer" class="inputDark" v-model="contactAddress">
        <span class="valid-error">{{validMess.contactAddress}}</span>
      </div>

      <div class="input-item-wrapp input-class">
        <input type="text" placeholder="Postcode + plaats" class="inputDark" v-model="contactPostcode">
        <span class="valid-error">{{validMess.contactPostcode}}</span>
      </div>

      <div class="input-item-wrapp input-class">
        <input type="text" placeholder="KVK nummer" class="inputDark" v-model="contactKvkAddress">
        <span class="valid-error">{{validMess.contactKvkAddress}}</span>
      </div>

      <div class="checkbox-item">
        <label class="container"><p>Ik ga akkoord met de algemene voorwaarden</p>
          <input type="checkbox" v-model="checked">
          <span class="checkmark"></span>
        </label>
      </div>
      <div class="btnCustom">
        <Button btnText="BEVESTIG"
                btnClass="btnOrangeNav"
                @click-login="activContactForm()"
                :disabled="((companyName && contactName && contactEmail && contactPhone && contactAddress && contactPostcode
              && contactKvkAddress) === '') || !checked">
        </Button>
      </div>

    </div>
  </div>

</template>
<script>
  import {base_url} from '../../axios.config';
  import Button from './Button';
  import {mapGetters} from 'vuex';

  export default {
    data() {
      return {
        base_url: base_url,
        mysrc1: require(`./../../assets/icons/close.png`),
        companyName: '',
        contactName: '',
        contactEmail: '',
        contactPhone: '',
        contactAddress: '',
        contactPostcode: '',
        contactKvkAddress: '',
        checked: false,
        valid: {},
        validMess: {
          name: '',
          company: '',
          email: '',
          phone: '',
          web: '',
          address: '',
          postcode: '',
          kvkAddress: '',
        },
      }
    },
    components: {
      Button,
    },
    methods: {
      scrollToTop() {
        window.scrollTo(0, 0);
      },
      activContactForm(){
        const patternEmail =/.+@.+\..+/i;
        const patternPhone = /^\d+$/;
        const patterns = {
          companyName: value => value.length > 3,
          contactName: value => value.length > 3,
          contactEmail: value => patternEmail.test(value),
          contactPhone: value => patternPhone.test(value) && value.length > 4,
          contactAddress: value => value.length > 4,
          contactPostcode: value => value.length > 4,
          contactKvkAddress: value => value.length > 4,
        };
        let messages = {
          companyName: 'enter your company name (4+)',
          contactName: 'enter your name (4+)',
          contactEmail: 'error Email',
          contactPhone: 'must be only number(6+)',
          contactAddress: 'enter your address(6+)',
          contactPostcode: 'enter your postcode(5+)',
          contactKvkAddress: 'enter your KVK address(5+)',
        };
        Object.keys(patterns).forEach(fieldName => {
          const pattern = patterns[fieldName];
          const value = this[fieldName];
          if (!pattern(value)) {
            this.validMess[fieldName] = messages[fieldName];
            this[fieldName] = '';
          } else {
            this.valid[fieldName] = true;
            this.validMess[fieldName] = '';
          }
        });
        if (Object.keys(this.valid).length === 7) {
          const data = new FormData();
          data.append('profile_form', 1);
          data.append('company_name', this.contactName);
          data.append('contact', this.companyName);
          data.append('email', this.contactEmail);
          data.append('phone_number', this.contactPhone);
          data.append('address_and_house_number', this.contactAddress);
          data.append('city_and_postcode', this.contactPostcode);
          data.append('kvk_number', this.contactKvkAddress);
          this.$store.dispatch('specialistPopUp/specialistFormSend', data);
          this.$store.dispatch('specialistPopUp/partPopUpAct', 3);
          this.contactName = '';
          this.contactEmail = '';
          this.contactPhone = '';
          this.contactAddress = '';
          this.companyName = '';
          this.checked = false;
          this.contactPostcode = '';
          this.contactKvkAddress = '';
        }
      }

    },
    mounted() {
      this.scrollToTop();
    },
    computed: {
      ...mapGetters({
        selectedSpecialist: 'specialistList/getSelectedSpecialist',
      }),
    },
  }
</script>
<style scoped lang="scss">
  .wrapp {
    background: white;
    width: 100%;
    text-align: center;
    padding-top: 2%;
    position: relative;
    padding-bottom: 5%;
  }

  .img img {
    width: 35%;
    border-radius: 50%;
  }

  .confirmation {
    margin-top: 3%;
    margin-bottom: 3%;
    color: #646464;

    h2 {
      font-size: 1.7rem;
      font-weight: 400;
      line-height: 50px;
      font-family: GolanoRegular;
      margin: 0;
    }

    span {
      font-family: GolanoSemi;
      font-size: 2rem;
      font-weight: 600;
      line-height: 50px;
    }

    p {
      font-family: GolanoRegular;
      font-size: 25px;
      font-weight: 400;
    }
  }

  hr {
    width: 90%;
    height: 2px;
    background-color: #d7d7d7;
  }

  .form-close {
    position: absolute;
    right: 25px;
    top: 25px;;

    img {
      cursor: pointer;
    }
  }

  .form-wrapp {
    width: 100%;
    margin-left: 8%;
    margin-top: 8%;
    padding-right: 11%;;

  }

  /*input type="checkbox" */
  .container {
    display: block;
    position: relative;
    padding-left: 11%;
    margin-top: -13px;
    margin-bottom: -3%;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    color: #646464;
    font-family: GolanoRegular;
    font-size: 1.5rem;
    font-weight: 400;
  }

  /* Hide the browser's default checkbox */
  .container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }

  /* Create a custom checkbox */
  .checkmark {
    position: absolute;
    top: 10px;
    left: 16px;
    height: 36px;
    width: 36px;
    border-radius: 5px;
    border: 2px solid #b7b7b7;
  }

  /* On mouse-over, add a grey background color */
  .container:hover input ~ .checkmark {
    background-color: #dedede;
  }

  /* When the checkbox is checked, add a blue background */
  .container input:checked ~ .checkmark {
    background-color: #ff8400;
  }

  /* Create the checkmark/indicator (hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }

  /* Show the checkmark when checked */
  .container input:checked ~ .checkmark:after {
    display: block;
  }

  /* Style the checkmark/indicator */
  .container .checkmark:after {
    left: 9px;
    top: 3px;
    width: 13px;
    height: 18px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);

  }

  .container p {
    margin-left: 0;
  }

  .input-item-wrapp {
    width: 95%;
  }

  .input-class {
    margin-bottom: 1%;
    text-align: left;
  }

  .inputDark {
    color: #646464;
    border-bottom: 2px solid #b7b7b7;
    font-size: 1.7vw;
    padding: 0px 0 3% 11px;
    margin-bottom: -6px;

    &::placeholder {
      color: #646464;
    }
  }

  .checkbox-item {
    display: flex;
    width: 100%;
    margin-left: -2%;
    margin-top: 8%;
    margin-bottom: 7%;
  }

  .btnCustom {
    button {
      cursor: pointer;
      width: 280px;
      font-size: 1.24vw;
      margin-left: -5%;
      padding: 2.2%;
    }
  }

  input {
    width: 100%;

    &::placeholder {
      letter-spacing: -0.5px;
    }

    font-family: GolanoRegular;
    margin-bottom: 6%;
    font-size: 2vw;
    padding: 12px 19px;
    outline: none;
    background: transparent;
    border: none;
  }

  input[type="checkbox"] {
    width: 10px;
  }

  .valid-error {
    color: #f97e7e;
    display: inline-block;
    padding-left: 1%;
    padding-top: 1%;
  }

  @media screen and (max-width: 1735px) {
    .container p {
      margin-left: -10%;
    }
  }

  @media screen and (max-width: 1530px) {
    .container p {
      margin-left: 1%;
      font-size: 1.3rem;
    }
  }

  @media screen and (max-width: 1355px) {
    .container p {
      margin-left: 0;
    }
  }

  @media screen and (max-width: 1355px) {
    .container p {
      line-height: 1;
      padding-top: 3%;
    }
  }

  @media screen and (max-width: 880px) {
    .confirmation h2 {
      font-size: 1.5rem;
    }
    .confirmation span {
      font-size: 1.6rem;
    }
    .confirmation p {
      font-size: 1.5rem;
    }
    .inputDark {
      font-size: 1.5rem;
    }
    .btnCustom button {
      font-size: 1.3rem;
    }
    .container p {
      font-size: 1.2rem;
      margin-left: 7%;
    }
    .img img {
      width: 50%;
    }
  }

  @media screen and (max-width: 620px) {
    .wrapp {
      width: 100%;
    }
    .form-wrapp {
      margin: 0;
      padding: 7% 0 0 6%;
    }
  }

  @media screen and (max-width: 535px) {
    .container p {
      font-size: 1.1rem;
      margin-left: 10%;
    }
  }

  @media screen and (max-width: 415px) {
    .container p {
      font-size: 1rem;
      margin-left: 15%;
    }
    .btnCustom button {
      width: 90%;
    }
  }

  @media screen and (max-width: 340px) {
    .container p {
      margin-left: 16%;
    }
    .confirmation h2 {
      font-size: 1.5rem;
    }
    .confirmation p {
      font-size: 1.5rem;
    }
  }


</style>
