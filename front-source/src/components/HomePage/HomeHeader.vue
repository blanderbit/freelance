<template>
  <b-container class="wrappHead" fluid>
    <b-row>
        <b-col>
            <NavigationMenu
              itemColor="itemMenuDark"
              borderItem="borderItemDark"
              searchItem="searchDark"
              logoColor="logo"
              burgerColor="color-main"></NavigationMenu>
        </b-col>
    </b-row>

    <b-row>
        <b-col>
            <HomeLeft></HomeLeft>
        </b-col>

        <b-col md="7">
            <Carusel></Carusel>
        </b-col>
    </b-row>
  </b-container>
</template>
<script>
    import NavigationMenu from '../common/header/NavigationMenu'
    import HomeLeft from '../common/header/HeaderLeftPart'
    import Carusel from '../common/Carusel'
    // import LogIn from '../NO/Auth_Components/LogIn';
    // import SignUp from '../NO/Auth_Components/SignUp';

    export default {
      data() {
        return {
          logIn: false,
          createAcc: false,
        }
      },
        components: {
            NavigationMenu,
            HomeLeft,
            Carusel,
            // LogIn,
            // SignUp,
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
  .wrappHead{
    padding: 2% 9%;
    padding-bottom: 0;
    background: #f5f4f2;
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
    .title {
      h2 {
        color: #00c8d7;
        font-family: GolanoSemi;
        font-size: 70px;
        font-weight: 400;
        line-height: 90px;
      }
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
  }
  @media screen and (max-width: 320px){
    .wrappHead{
      padding: 2%;
    }
  }
</style>
