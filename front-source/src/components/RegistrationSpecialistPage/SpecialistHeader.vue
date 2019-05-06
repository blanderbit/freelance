<template>
  <b-container class="wrappHead" fluid>
    <b-row class="menu">
      <b-col>
        <NavigationMenu itemColor="itemMenuDark"
                        borderItem="borderItemWhite"
                        searchItem="searchWhite"
                        logoColor="logo"
                        burgerColor="color-main">

        </NavigationMenu>
      </b-col>
    </b-row>
    <b-row>
      <b-col lg="6" v-show="!closed">
        <leftPart v-on:closed-form="closedForm()"></leftPart>
      </b-col>
      <b-col lg="6" class="carusel-wrapp">
        <Carusel></Carusel>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
  import leftPart from './SpecialistHeaderLeftPart';
  import NavigationMenu from '../common/header/NavigationMenu'
  import Carusel from '../common/Carusel'
  import Button from '../common/Button';
  import LogIn from '../NO/Auth_Components/LogIn';
  import SignUp from '../NO/Auth_Components/SignUp';

  export default {
    data() {
      return {
        closed: false,
        logIn: false,
        createAcc: false,
      }
    },

    methods: {
      closedForm() {
        this.closed = true;
      },
      closedLogForm() {
        this.logIn = false;
      },
      closedSignForm() {
        this.createAcc = false;
      },
      // loggedIn(){
      //   const bodyEl = document.getElementsByTagName('html')[0];
      //   bodyEl.style.overflow= "hidden";
      //   this.logIn = true;
      //
      // },
      // createAccIn(){
      //   const bodyEl = document.getElementsByTagName('html')[0];
      //   bodyEl.style.overflow= "hidden";
      //   this.createAcc = true
      // },
    },

    components: {
      NavigationMenu,
      Button,
      leftPart,
      Carusel,
      LogIn,
      SignUp
    },

  }
</script>
<style scoped lang="scss">

  .log-form {
    width: 100%;
    display: flex;
    justify-content: center;
    height: 100vh;
    position: absolute;
    background: #2ad0e1b0;
    z-index: 20;

    hr {
      width: 95%;
      height: 2px;
      background-color: #d7d7d7;
    }
  }
  /*.wrappHead{*/
    /*padding: 2% 9%;*/
    /*padding-bottom: 0;*/
    /*background: #f5f4f2;*/
  /*}*/
  .wrappHead{
    padding: 2% 9%;
    padding-bottom: 0;
    background: #f5f4f2;
  }
  .log-form-wrap {
    width: 100%;
    display: flex;
    justify-content: center;
  }
  .lineBetween{
    width: 1px;
    font-size: 20px;
    margin: 0px 10px;
    color: white;
  }
  .wrapperLink{
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #2ad0e1;
    margin: 0px -20% 8% 23%;
    border-bottom: 5px solid #1dacbb;
    .divBtn{
      cursor: pointer;
      color: white;
      font-family: GolanoRegular;
      font-size: 18px;
      font-weight: 400;
      line-height: 48.15px;
      padding: 0 10px;
    }
    .divBtn:hover {
      color: #1dacbb;
    }
  }
  @media screen  and (max-width: 1578px){
    .wrapperLink{
      flex-direction: column;
      padding-top: 5px;
      div {
        line-height: 28.15px;
      }
      div:first-child{
        border-bottom: 2px solid white;

      }
      span{
        display: none;
      }
    }
  }
  @media screen  and (max-width: 1150px){
    .wrappHead{
      /*height: 1000px;*/
    }
  }
  @media screen  and (max-width: 1024px){
    .carusel-wrapp {
      /*display: none;*/
    }
  }
  @media screen  and (max-width: 991px){
    .wrapperLink{
      display: none;
    }
    .carusel-wrapp {
      display: none;
    }
  }
  @media screen  and (max-width: 767px){
    .wrappHead {
      /*height: 980px;*/
    }
  }
  @media screen  and (max-width: 570px) {
    .col-lg-6 {
      padding: 0;
    }
    .wrappHead{
      padding: 0;
      height: auto;
    }
    .menu {
      padding: 2% 9%;
    }
  }
  @media screen  and (max-width: 320px) {
    .menu {
      padding: 2%;
    }
  }
</style>
