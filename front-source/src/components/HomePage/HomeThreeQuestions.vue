<template>
    <b-container fluid class="mBottmMainBlock">
      <div :class="['video-pop-up-wrap', clickedVideo?'video-on':'video-off']" @click="onClickVideo()">
        <div class="video-part" >
          <div class="close-block" @click.stop="onClickVideo()">
            <i class="fas fa-times close-video"></i>
          </div>

          <Video ref="playerMain"></Video>
        </div>
      </div>
        <b-row class="wrapper">

            <b-col md="6" class="blueBackground" @click="onClickVideo()">
              <div class="video-wrap">
                <i class="fas fa-play video-play"></i>
              </div>
              <img v-lazy="src4" alt="play" class="">

            </b-col>
            <b-col class="qItems" md="6">
                <div @click="onClick('clicked1')" class="qItem">
                    <img v-lazy="src2" alt="plus"  class="backgroundPLus white">
                  <img v-lazy="src3" alt="plus"  class="backgroundPLus color">
                    <p class="m-0">Wie zijn wij?</p>

                </div>
              <p :class="[clicked1?'clicked-item':'no-clicked-item']">Causeffect On Demand ondersteunt ondernemers
                  door verschillende specialisten aan te bieden die jou helpen met je communicatiedoelstellingen.</p>
                <div @click="onClick('clicked2')" class="qItem">
                    <img v-lazy="src2" alt="plus"  class="backgroundPLus white">
                  <img v-lazy="src3" alt="plus"  class="backgroundPLus color">
                    <p class="m-0">Hoe werken wij?</p>

                </div>
              <p :class="[clicked2?'clicked-item':'no-clicked-item']">De opdrachtgever vraagt een specialist aan.
                  Wij plaatsen de specialist in house bij de opdrachtgever. De specialist voert jouw opdracht uit.
                  Wij factureren de jou, de opdrachtgever. Simpeler kan niet.</p>
                <div @click="onClick('clicked3')" class="qItem">
                    <img v-lazy="src2" alt="plus" class="backgroundPLus white">
                  <img v-lazy="src3" alt="plus"  class="backgroundPLus color">

                    <p class="m-0">Wat kunnen wij?</p>

                </div>
              <p :class="[clicked3?'clicked-item':'no-clicked-item']">Wij bieden ondernemers de kans om op een simpele
                  en efficiënte manier specialisten in te huren voor een bepaalde of onbepaalde periode.
                  Geen administratieve rompslomp of lastige contracten. Wij leveren On Demand!</p>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
  import Video from '../video/Video';
    export default {
        data(){
            return {
              clickedVideo: false,
              clicked1: true,
              clicked2: false,
              clicked3: false,
                src1:require(`../../assets/video-background.png`),
                src2:require(`../../assets/icons/plus.png`),
                src3:require(`../../assets/icons/plusColor.png`),
                src4:require(`../../assets/videobg.png`),
            }
        },
      methods: {
        onClick(name){
          this[name] = !this[name];
        },
        onClickVideo(){
          this.clickedVideo = !this.clickedVideo;
          if (!this.clickedVideo) {
            let childMain = this.$refs.playerMain;
            let child = childMain.$refs.player;
            child.pause();
          }
        },
      },
      components: {
        Video,
      },

    }
</script>
<style scoped lang="scss">
  .video-part {
    position: relative;
  }
  .close-block {
    position: absolute;
    right: -20px;
    top: -20px;
    color: #8a8a8a;

  }
  .close-video {
    color: #777777;
    font-size: 1.5rem;
    transition: all 0.5s;
  }
  .close-video:hover {
    color: #ffffff;
    transform: rotate(90deg);
    transition: all 0.5s;
  }
  .video-off {
    display: none;
  }
  .video-on {
    display: flex;
  }
  .video-wrap {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 10;
    width: 70px;
    height: 70px;
    margin-top: -35px;
    margin-left: -35px;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #00c8d7;
    border-radius: 200px;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
  }
  .video-pop-up-wrap {

    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    background: #000000d6;
    z-index: 10000;
    /*display: flex;*/
    justify-content: center;
    align-items: center;
    /*display: none;*/
  }
  .video-play {
    font-size: 1.2rem;
    color: white;
    margin-left: 5px
  }
  .no-clicked-item {
    display: none;
  }
   .clicked-item{
      display: block;
      font-family:GolanoRegular ;
      font-size: 1.2rem;
      color: #969696;
      margin-left: 24%;
  }
    .backgroundPLus{
        cursor:pointer;
        margin-right: 15%;
        max-width: 8%;
    }
    .blueBackground{
      width: 100%;
      overflow: hidden;
      position: relative;
      padding: 0;
      img {
        width: 105%;
        transition: all 0.5s;
      }
      img:hover {
        transform: scale(1.1);
        transition: all 0.5s;
      }
    }
    .wrapper{
        margin-top: 11.5%;
        padding: 0 4%;
    }
    .qItems{
        padding-left: 0px;
        position: relative;
        left: -10%;
        margin-top: 2%;
    }
    .qItem{
      margin-top: 3%;
      margin-bottom: -2%;
        display: flex;
        align-items: center;
      cursor: pointer;
    }
    p{
        color: #646464;
        font-family: GolanoSemi;
        font-size: 2.6vw;
        font-weight: 400;
      line-height: 1.7;
    }
    .mBottmMainBlock{
        margin-bottom: 6%;
    }
    .color {
      display: none;
    }
  @media screen and(max-width: 1500px) {
    .qItems {
      margin-top: 3%;
    }
  }
  @media screen and(max-width: 1470px) {
    .qItems {
      margin-top: 0;
    }
  }

  @media screen and(max-width: 1230px) {
    iframe {
      height: 300px;
    }
    .qItems {
      margin-top: 3%;
      left: -9%;
    }
  }
  @media screen  and (max-width: 1200px){
    p {
      font-size: 1.4rem;
    }
    .qItems {
      left: -8%;
    }
  }
  @media screen and(max-width: 1020px) {
    .qItems {
      margin-top: 5%;
    }
  }
  @media screen and(max-width: 840px) {
    .qItems {
      margin-top: 9%;
      left: -13%;
    }
    .backgroundPLus {
      margin-right: 20%;
    }
  }
    @media screen and(max-width: 767px) {
      .color {
        display: block;
      }
      .white {
        display: none;
      }
        .wrapper .col-md-6:first-child{
            text-align: center;
        }
        .qItems{
            left: 0px;
        }
        .qItem{
          margin-top: 1%;
          margin-bottom: 3%;
          margin-left: 10%;
            &:last-child{
                border-bottom: 1px solid #ababab;
            }
        }
        p{
            font-size: 2rem;
        }
      .clicked-item {
        font-size: 1.5rem;
      }
        .close-block{
            right: 18px;
            top: -28px;
        }
    }
  @media screen and(max-width: 720px) {
    .clicked-item {
      margin-left: 11%;
    }
  }
  @media screen and(max-width: 450px) {
    .backgroundPLus {
      margin-left: 0;
    }
    .backgroundPLus {
      margin-right: 5%;
    }
    .clicked-item {
      font-size: 1.2rem;
    }
  }
  @media screen and(max-width: 370px) {
    p {
      font-size: 1.7rem;
    }
  }
  @media screen and(max-width: 320px) {

    .qItems {
      padding: 0;
    }
    .qItem{
      margin-left: 0;
    }
    .backgroundPLus {
      margin-right: 12%;
    }
    .clicked-item {
      margin-left: 0;
      font-size: 1.2rem;
    }
    p {
      font-size: 1.5rem;
    }
  }
</style>
