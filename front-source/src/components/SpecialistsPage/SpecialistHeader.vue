<template>
  <b-container class="wrappHead" fluid>
    <b-row>
      <b-col class="specialist-menu">
        <NavigationMenu itemColor="itemMenuDark" borderItem="borderItemDark"
                        searchItem="searchDark" logoColor="logo" burgerColor="color-main">

        </NavigationMenu>
      </b-col>
    </b-row>
    <div class="title">
      <h2>Ontmoet onze specialisten</h2>
      <hr>
    </div>
    <div class="specialist-list">
      <SpecialistList></SpecialistList>
    </div>
  </b-container>
</template>

<script>
  import NavigationMenu from '../common/header/NavigationMenu'
  import HomeLeft from '../common/header/HeaderLeftPart'
  import Carusel from '../common/Carusel'
  import Button from '../common/Button';
  import LogIn from '../NO/Auth_Components/LogIn';
  import SignUp from '../NO/Auth_Components/SignUp';
  import SpecialistList from './SpecialistList';

  export default {
    data() {
      return {
        logIn: false,
        createAcc: false,
      }
    },

    methods: {
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
      HomeLeft,
      Carusel,
      Button,
      LogIn,
      SignUp,
      SpecialistList
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

  .log-form-wrap {
    width: 100%;
    display: flex;
    justify-content: center;
  }


  .input-class {
    margin-bottom: 8%;
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

  .wrappHead {
    padding: 0 9%;
    margin-top: 2%;
  }
  .lineBetween {
    width: 1px;
    font-size: 20px;
    margin: 0px 10px;
    color: white;
  }
  .wrapperLink {
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #2ad0e1;
    margin: 0px -20% 8% 23%;
    border-bottom: 5px solid #1dacbb;
    .divBtn {
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
    .title {
      margin-top: 5%;
      margin-left: 2%;
      display: inline-block;
      width: 60%;
      h2 {
        color: #00c8d7;
        font-family: GolanoSemi;
        font-size: 70px;
        font-weight: 400;
        line-height: 90px;
      }
      hr {
        margin-left: 1%;
        margin-top: 4%;
        width: 10%;
        height: 0.5vw;
        max-height: 100%;
        background-color: #00c8d7;
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
  @media screen  and (max-width: 991px){
    .wrapperLink{
      display: none;
    }
    .title {
      margin-top: 10%;
      h2 {
        font-size: 45px;
        line-height: 55px;
      }
    }
  }
  @media screen  and (max-width: 767px){
    .title {
      width: 100%;
      margin-left: 0;
      h2 {
        font-size: 2rem;
      }
      hr {
        width: 13.6%;
        margin-bottom: 2rem;
      }
    }
  }
  @media screen  and (max-width: 670px){
    .title h2 {
      font-size: 3rem;
    }
  }
  @media screen  and (max-width: 450px){
    .title h2 {
      font-size: 2.5rem;
      line-height: 50px;
    }
  }

  @media screen  and (max-width: 425px){
    .title {
      width: 100%;
      margin-left: 0;
      padding: 0 9%;
    }
    .wrappHead {
      padding: 0;
    }
    .specialist-menu {
      padding: 0 11.5%;
    }

  }
  @media screen  and (max-width: 380px){
    .title {
      h2 {
        font-size: 35px;
      }
    }
  }
  @media screen and (max-width: 320px){
    .wrappHead{
      padding: 0 2%;
    }
    .specialist-menu {
      padding: 0;
      padding-left: 15px;
      padding-right: 15px;
    }
  }
</style>
