<template>
    <div class="experience-main" v-if="previousWorkArr.length">
      <div class="experience-items">
        <h2>Werkervaring</h2>

        <div class="shout-out-items">

          <div class="shout-item">
            <div class="shout-item-img"
                 :class="{active: index === selectedIndex}"
                 v-for="(item, index) in previousWorkArr">
              <img  @click.self="selectWork(index)" :src="`${getBaseURL()}${item.file_name}`">
            </div>
          </div>

          <div class="shout-item-content">
            <div class="content-title">
              <p>{{ previousWorkArr[selectedIndex].title }}</p>
              <div>
                <h4>{{dateFormatter(previousWorkArr[selectedIndex].start_to_work)}} -
               {{Number(previousWorkArr[selectedIndex].contract_end_current_time) === 0 ?
                  dateFormatter(previousWorkArr[selectedIndex].stop_to_work): 'Heden'}}</h4>
              </div>
            </div>
            <hr>
            <p class="content">{{ previousWorkArr[selectedIndex].description }}</p>
            <!--<h4>{{dateFormatter(previousWorkArr[selectedIndex].start_to_work)}}</h4>-->
            <!--<h4>{{dateFormatter(previousWorkArr[selectedIndex].stop_to_work)}}</h4>-->
            <!--begon te werken: klaar met werken: -->
          </div>

        </div>

      </div>

      <div class="experience-video" style="margin-bottom: 40px">
        <h2>Video</h2>
        <div class="video-item" v-for="video in videos" v-if="videos && videos.length > 0">

          <video controls v-if="video.source === 'local'"
                 width="100%"
                 height="100%">
            <source :src="getBaseURL() + video.filename_or_link" >
            Your browser does not support the video tag.
          </video>

          <iframe v-if="video.source === 'www.youtube.com'"
                  title="YouTube video player"
                  class="youtube-player"
                  type="text/html"
                  width="100%"
                  height="100%"
                  :src="'//www.youtube.com/embed/' + video.filename_or_link.match(/(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=|\/sandalsResorts#\w\/\w\/.*\/))([^\/&]{10,12})/).filter(item=>item)[1]"
                  frameborder="0"
                  allowFullScreen>
          </iframe>

          <iframe v-if="video.source === 'vimeo.com'"
                  title="Vimeo video player"
                  type="text/html"
                  width="100%"
                  height="100%"
                  :src="'https://player.vimeo.com/video/' + video.filename_or_link.match(/https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/).filter(item=>item)[1]"
                  frameborder="0"
                  allowFullScreen>
          </iframe>

        </div>
      </div>

    </div>
</template>

<script>
    import { base_url } from "../../axios.config";
    export default {
      data() {
        return {
          selectedIndex: 0
        }
      },
      methods: {
          selectWork: function(index){
            this.selectedIndex = index;
          },
          getBaseURL: () => base_url,
          dateFormatter: data => {
            let date = new Date (data);
            const monthNames = [
              "Januari",
              "Februari",
              "Maart",
              "April",
              "Mei",
              "Juni",
              "Juli",
              "Augustus",
              "September",
              "Oktober",
              "November",
              "December",
            ];
            return `${monthNames[date.getMonth()]} ${date.getFullYear()}`;
          }
      },
      props: {
          previousWorkArr: {
              type: Array,
              default: ()=>[]
          },
          videos: {
              type: Array,
              default: ()=>[]
          }
      },
    }
</script>

<style scoped lang="scss">
  .experience-main {
    display: flex;
    justify-content: space-between;
    /*padding-left: 9%;*/
    /*padding-right: 5%;*/
    width: 95%;
    padding-left: 9%;
  }
  h2 {
    color: #00c8d7;
    font-family: GolanoSemi;
    font-size: 50px;
    font-weight: 400;
    line-height: 35px;
  }
  p {
    color: #646464;
    font-family: GolanoRegular;
    font-size: 25px;
    font-weight: 400;
    line-height: 40px;
  }
  .experience-items {
    margin-top: 4%;
    /*margin-left: 2%;*/
    width: 64%;

  }
  .experience-video {
    margin-top: 4%;
    width: 34%;
    /*display: flex;*/
    /*margin-left: 2%;*/
  }
  .video-item {
      display: flex;
      justify-content: center;
      align-items: center;
    width: 100%;
    height: 100%;
    background-color: #ebebeb;
    margin-top: 9.5%;
    video {
      width: auto;
      height: 90%;
    }
  }
  .shout-out-items {
    margin-top: 4%;
  }
  .shout-item {
    display: flex;
    img {
      margin-right: 1rem;
    }
  }
  .shout-item-img {
    position: relative;
    width: 104px;
    height: 95px;
    img {
      width: auto;
      max-width: 90px;
      height: 90px;
      border-radius: 50%;
    }
  }
  .shout-item-img:after {
    display: inline-block;
    position: absolute;
    top: 4.7rem;
    left: 2.1rem;
    font-size: 35px;
    transform: scale(2, -1);
    color: #d7d7d7;
  }
  .active:after {
    content: "^";
  }
  .shout-item-content {
    border: 2px solid #d7d7d7;
    background-color: #ffffff;
    padding: 3%;
    padding-bottom: 1%;
    margin-top: 5%;

  }
  .content-title {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    h4 {
      font-family: GolanoRegular;
      color: #646464;
    }
    span {
      color: #646464;
      font-family: GolanoSemi;
      font-size: 30px;
      font-weight: 400;
      line-height: 40px;
    }
    p {
      font-size: 30px;

    }
  }
  hr {
    height: 2px;
    background-color: #d7d7d7;
    margin-top: 1%;
  }
  .content {
    margin-top: 2.5%;
  }
  @media screen and (max-width: 1200px){
    .experience-main {
      flex-direction: column;
      padding-right: 5%;
    }
    .experience-items {
      width: 90%;
    }
    .video-item {
      width: 92%;
      margin-top: 5%;
    }
    .experience-items {
      margin-top: 4%;
      /*margin-left: 2%;*/
      width: 100%
    }
    .experience-video {
      margin-top: 4%;
      width: 100%;
      height: 430px;
      /*margin-bottom: 9%;*/
      margin-bottom: 110px;
    }
    .video-item {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
      background-color: #ebebeb;
      margin-top: 9.5%;
      video {
        width: auto;
        height: 90%;
      }
    }
  }
  @media screen and (max-width: 767px){
    .experience-main {
      flex-direction: column;
      padding-right: 4%;
    }
    h2 {
      font-size: 2rem;
    }
    p {
      font-size: 1.5rem;
    }
    .content-title {
      span {
        font-size: 1.8rem;
      }
      p {
        font-size: 1.8rem;
      }
    }
    .experience-video {
      /*padding: 15px;*/
      margin-bottom: 60px;
    }
  }
  @media screen and (max-width: 720px){
    .experience-items {
      margin: 0;
    }
    .shout-item {
      display: flex;
      justify-content: space-around;
      margin-bottom: 10%;
    }
    .content-title {
      p {
        font-size: 1.5rem;
      }
      span {
        font-size: 1.5rem;
      }
    }
    .content {
      font-size: 1.5rem;
      line-height: 30px;
    }
  }
  @media screen and (max-width: 620px){
    .shout-item-img {
      width: 18%;
      height: 75px;
      background-position: center;
      background-size: contain;
    }
    .shout-item-img:after {
      top: 4.7rem;
      left: 2.1rem;
    }
    .experience-video {
      margin: 0;
      margin-top: 10%;
    }
    .video-item {
      /*width: 90%;*/
      /*margin-right: 0;*/
    }
    .shout-item{
      margin-bottom: 12%;
    }
    .shout-item-content {

      margin-top: 30px;
    }
  }
  @media screen and (max-width: 520px){
    .experience-main {
      padding: 0;
      width: 100%;
    }
    .experience-items {
      width: 100%;
    }
    .shout-item-content {
      border: 0;
    }
    .shout-item-img{
      width: 17%;
      height: 62px;
    }
    .shout-item-img:after {
      top: 3.7rem;
      left: 2.1rem;
      font-size: 20px;
    }
    .content-title {
      display: flex;
      /*flex-direction: column;*/
      align-items: baseline;
    }
    .video-item {
      width: 100%;
    }
    h2 {
      padding-left: 9%;
    }
    .experience-items {
      padding-left: 9%;
    }
  }
  @media screen and (max-width: 440px){
    .shout-item-img:after {
      left: 41%;
    }
    .experience-items {
      padding-left: 9%;
    }
  }
  @media screen and (max-width: 320px){
    .content {
      text-align: center;
    }
    .experience-items h2{
      padding: 0;
    }
    .content-title h4{
      font-size: 1.1rem;
    }
    .shout-item{
      padding-right: 20px;margin-left: -18px;
    }
  }

</style>

