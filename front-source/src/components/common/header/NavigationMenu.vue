<template>
  <nav class="navbar navbar-expand-lg navbar-light">
      <div class="logoItem">
          <router-link to="/" class="navbar-brand">
              <img :src="getImgUrlLogo" alt="logo">
          </router-link>
          <div class="burgerMenu">
            <span class="navbar-toggler-icon" @click.prevent="burgerShow = !burgerShow">
              <i class="lines-button">
                <i :class="[lines, burgerColor]"></i>
              </i>
              <i class="lines-button">
                <i :class="[lines, burgerColor]"></i>
              </i>
              <i class="lines-button">
                <i :class="[lines,linesLast, burgerColor]"></i>
              </i>
            </span>
            <transition name="slide">
              <div class="toggle-menu" v-show="burgerShow" >
                <span @click.prevent="burgerShow = !burgerShow" class="close-menu">
                  <img v-lazy="imageCl" alt="imageCl">
                </span>
                <router-link to="/">Home</router-link>
                <router-link to="/huurEenSpecialist">Huur Een Specialist</router-link>
                <router-link to="/onsVerhaal">Ons verhaal</router-link>
                <!--<router-link to="/onsWerk">Ons werk</router-link>-->
                <router-link to="/contact">Contact</router-link>
              </div>
            </transition>
          </div>

      </div>
      <div class="collapse navbar-collapse navItem" id="navbarSupportedContent">
          <div class="itemMenuDark">
              <router-link to="/huurEenSpecialist">
                  <Button btnText="HUUR EEN SPECIALIST" btnClass="btnOrangeNav" arrow="short">
                  </Button>
              </router-link>
          </div>
          <div :class="itemColor">
              <router-link to="/" active-class>Home</router-link>
          </div>
          <div :class="itemColor">
              <router-link to="/onsVerhaal">Ons verhaal</router-link>
          </div>
          <!--<div :class="itemColor">-->
              <!--<router-link to="/onsWerk">Ons werk</router-link>-->
          <!--</div>-->
          <div :class="itemColor">
              <router-link to="/contact">Contact</router-link>
          </div>

      </div>
  </nav>

</template>
<script>
    import Button from '../Button'
    export default {
        components:{
            Button
        },
        data: function () {
            return {
              burgerShow:false,
              showSearch: false,
              imageCl: require(`../../../assets/icons/close.png`),
              lines: 'lines',
              linesLast: 'lines-last'
            }
        },
        props: {
          itemColor: {
            type: String,
          },
          borderItem: {
            type: String,
          },
          searchItem: {
            type: String,
          },
          logoColor: {
            type: String,
          },
          burgerColor: {
            type: String,
          },
          menuColor: {
            type: String,
          }
        },
        computed: {
          getImgUrlLogo() {
            return require('../../../assets/icons/'+ this.logoColor + '.png');
          }
        }
    }
</script>
<style scoped lang="scss">
  .toggle-menu {
    position: absolute;
    width: 300px;
    height: 100vh;
    right: -9vw;
    top: -7vh;
    z-index: 10;
    display: flex;
    flex-direction: column;
    text-align: center;
    background: #00C7D4;
    padding-top: 10%;
    a {
      padding: 10px 5px;
      color: #ffffff;
      text-decoration: none;
      font-size: 1.2rem;
      margin-bottom: 5%;
    }
    a:hover {
      background: #a96721;
    }
    a::after {
      transition: transform .3s ease-out,border-color .3s ease-out;
      position: absolute;
      display: block;
      bottom: -6px;
      left: 0;
      width: 100%;
      -ms-transform: scaleX(0);
      -webkit-transform: scaleX(0);
      transform: scaleX(0);
      border-top: 2px solid #000;
      content: '';
      padding-bottom: inherit;
    }
  }
  .close-menu {
    position: absolute;
    top: 20px;
    right: 10px;
    display: inline-flex;
    border: 1px solid wheat;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    background: #ff8400;
    justify-content: center;
    align-items: center;

  }
  .close-menu img {
    width: 20px !important;
    height: 20px;
  }





  .navbar-toggler-icon {
    position: relative;
    overflow: hidden;
    width: 32px;
    height: 30px;
    background: transparent;
  }
  .lines-button {
    transition: .3s;
    cursor: pointer;
    line-height: 0px!important;
    top: 9px;
    position: relative;
    font-size: 0px!important;
    user-select: none;
    display: block;
    margin-bottom: 5px;
  }
  .lines {
    display: block;
    width: 100%;
    height: 3px;
    transition: 0.3s;
    position: relative;
  }
  .color-main {
    background-color: #00c8d7 !important;
  }
  .color-white {
    background-color: white !important;
  }
  .lines-last {
    width: 1.4rem;;
  }
  /*.line {*/
    /*height: 43px;*/
    /*width: 2px;*/
    /*border-right: 1px solid black;*/
    /*margin-right: 10%;*/
  /*}*/
    .slide-enter-active {
        transition: all .3s ease;
    }
    .slide-leave-active {
        transition: all .8s ease;
    }
    .slide-enter, .slide-leave-to {
        transform: translateX(100%);
        opacity: 0;
    }
    .burgerMenu{
      display: none;
      width: 20%;
      justify-content: flex-end;


    }
    .listBurger{
        position: relative;
        ul{
            list-style-type: none;
            padding-left: 0px;
            position: absolute;
        }
    }
    .navbar{
        padding: 0;
        background: transparent;
        width: 100%;
    }
    .logoItem{
        width: 43%;

        img{
            max-width: 100%;
        }
    }
    .navItem{
        width:62.5%;
    }
    .borderItemDef {
      width: 20px;
      height: 30px;
    }
    .borderItemDark {
      border-left: 1px solid black;
    }
    .borderItemWhite {
      border-left: 1px solid white;
    }
    .searchDark{

    }
    .col{
        padding: 0px;
    }
    .itemMenuDark{
        margin-right: 4%;
        font-family: GolanoRegular;
        a{
            font-size: 1.2vw;
            text-decoration: none;
            color: #646464;
        }

    }
    .itemMenuWhite{
      margin-right: 4%;
      font-family: GolanoRegular;
      a{
        font-size: 1.2vw;
        text-decoration: none;
        color: white;
      }

    }
    .form-inline{
        position: relative;
      padding: 0;
    }
    img[alt="search"]{
      width: 90%;
      z-index: 10;
      cursor: pointer;
    }
    input[type="search"]{
        border-color:#ff8400;
        width: 10vw;
        margin-left: -4px;
        z-index: 9;
        padding-left: 90%;
        position: absolute;
    }
    .fade-enter-active,.fade-leave-active {
        transition: all .8s;
    }
    .fade-enter,.fade-leave-to{
        transform: translateX(50%);
        opacity: 0;
    }
    .itemMenu button{
        font-size: 0.9vw;
    }
    .router-link-exact-active {
        color: black !important;
    }

    @media screen  and (max-width: 1662px){
      .logoItem{
        width: 35%;
        img {
          width: 81%;
        }
      }
    }
    @media screen  and (max-width: 1400px){
      .logoItem{
        img {
          width: 80%;
        }
      }
      .itemMenuDark{
        a{
          font-size: 17px;
        }

      }
      .itemMenuWhite{
        a{
          font-size: 17px;
        }
      }
    }
    @media screen  and (max-width: 1345px){
      .logoItem {
        width: 33%;
        .itemMenuDark {
          margin-right: 2.5%;
        }
      }
      .itemMenuDark, .itemMenuWhite {
        margin-right: 3.5%;
      }
    }
    @media screen  and (max-width: 1260px){
      .logoItem {
        width: 33%;
        img {
          width: 80%;
        }
      }
      .itemMenuDark, .itemMenuWhite {
        margin-right: 3.5%;
      }
    }
    @media screen  and (max-width: 1200px){
      .logoItem {
        width: 30%;
        img {
          width: 75%;
        }
      }
    }
    @media screen  and (max-width: 1145px){
      .navItem {
        margin-right: -8%;
      }
    }
    @media screen  and (max-width: 1039px){
      .logoItem {
        width: 27%;
      }
      .itemMenuDark {
        margin-right: 2.5%;
      }
    }
    @media screen  and (max-width: 991px){
      .form-inline input {
        width: 15vw;
      }
      .logoItem{
          position: relative;
          margin-top: 2%;
          width: 100%;
          display: flex;
          justify-content: space-between;
      }
      .burgerMenu {
        display: flex;
      }
      .listBurger {
        z-index: 1000;
        margin-top: 20px;
      }
    }
  @media screen  and (max-width: 650px){

    .toggle-menu{
      top: -2rem;
      padding-top: 20%;
    }
  }

  @media screen  and (max-width: 420px){
    .toggle-menu{
      top: -1rem;
    }
  }
  @media screen  and (max-width: 320px){
    body {
      overflow-x: hidden;
    }
    .line {
      display: none;
    }
    .form-inline {
      display: none;
    }
    .toggle-menu{
      right: -21px;
    }

  }
</style>
