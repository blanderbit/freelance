<template>
  <b-container fluid class="footer-wrapp">
    <HomeFastRegistrate></HomeFastRegistrate>
    <b-row>
      <b-col md="3" cols="6" class="no-padding" v-for="sotial in sotial_network" :key="sotial.classes">
        <a :href="sotial.url" class="social-item">
          <i class="fab" :class="sotial.classes"></i>
        </a>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
  import HomeFastRegistrate from '../HomePage/HomeFastRegistrate';
  export default {
    data(){
      return{
        sotial_network:[
          {
            url:     'https://www.facebook.com/CauseffectNL/',
            classes: 'fa-facebook-square'
          },{
            url:     'https://www.instagram.com/causeffectnl/?hl=nl',
            classes: 'fa-instagram'
          },{
            url:     'https://twitter.com/CauseffectNL',
            classes: 'fa-twitter'
          },{
            url:     'https://www.linkedin.com/company/causeffect-nl/',
            classes: 'fa-linkedin-in'
          },
        ]
      }
    },
    components:{
      HomeFastRegistrate
    }
  }
</script>
<style scoped>
  .no-padding {
    padding: 0;
  }
  .social-item {
    text-decoration: none;
    color: #00c7d6;
    text-align: center;
    font-size: 4vw;
    padding-top: 3.3%;
    padding-left: 2%;
    padding-bottom: 3.3%;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 160px;

  }
  .footer-wrapp {
    padding: 0;
  }
  .social-item:hover {
    color: white;
    background: black;
  }
  @media screen  and (max-width: 767px){
    .social-item {
      font-size: 10vw;
      padding-top: 4.3%;
      padding-bottom: 4.3%;
    }

  }
  @media screen  and (max-width: 440px){
    .social-item {
      height: 80px;
    }

  }
  @media screen  and (max-width: 320px){
    .footer-wrapp {
      padding: 0;
    }
    .social-item {
      height: 60px;
    }
    .row {
      margin: 0;
    }
  }

</style>
