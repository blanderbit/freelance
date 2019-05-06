<template>
  <div class="wrappHead">
    <div class="fon-filter">
      <b-container fluid>

        <b-row class="mav-menu">
          <b-col>
            <NavigationMenu itemColor="itemMenuWhite"
              borderItem="borderItemWhite"
              searchItem="searchWhite"
              logoColor="logoWhite"
              burgerColor="color-white">
            </NavigationMenu>
          </b-col>
        </b-row>

        <b-row class="contact-left-items">
          <b-col lg="7" sm="12" class="part-wrapp" v-show="!closed">
            <ContactLeft v-on:closed-form="closedForm()"></ContactLeft>
          </b-col>
          <b-col lg="5" sm="12">
            <ContactRight></ContactRight>
          </b-col>
        </b-row>
      </b-container>

    </div>
  </div>
</template>
<script>
  import NavigationMenu from '../common/header/NavigationMenu'
  import ContactLeft from './ContactHeaderLeftPart'
  import ContactRight from './ContactHeaderRightPart';


  export default {
    data() {
      return {
        closed: false,
      }
    },
    components: {
      NavigationMenu,
      ContactLeft,
      ContactRight,
    },
    methods: {
      closedForm() {
        this.closed = true;
      }
    }
  }
</script>
<style scoped lang="scss">
  .container-fluid {
    padding: 0;
  }
  .wrappHead{
    height: 1216px;
    background: url("./../../assets/contact_up_bg.png");
    background-size: cover;
    background-repeat: no-repeat;
    /*background-attachment: fixed;*/
  }
  .fon-filter {
    height: 1216px;
    padding: 2% 9%;
    background: #19cddac4;
  }
  .part-wrapp {
    padding: 8% 6% 0 3%;
  }
  @media screen  and (max-width: 991px){
    .fon-filter{
      padding: 2% 9%;
    }
  }

  @media screen  and (max-width: 540px){
    .wrappHead {
      height: 1080px;
    }
    .fon-filter{
      height: 1080px;
      padding: 0;
    }
    .mav-menu {
      padding: 2% 9%;
      margin-bottom: 8%;
    }
    .part-wrapp{
      padding: 0;
    }
    .contact-left-items {
       margin-left: 0;
      width: 100%;
    }

  }
  @media screen  and (max-width: 360px) {
    .fon-filter, .wrappHead {
      height: 825px;
    }
  }

  @media screen  and (max-width: 320px){
    .mav-menu {
      padding: 2%;
    }
    .fon-filter, .wrappHead{
      height: 790px;
    }
  }

</style>
