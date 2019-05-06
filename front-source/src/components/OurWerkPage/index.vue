<template>
  <div>
    <div class="wrappHead">
      <div class="fon-filter">
        <b-container fluid>

          <b-row>
            <b-col>
              <NavigationMenu itemColor="itemMenuWhite"  borderItem="borderItemWhite" searchItem="searchWhite" logoColor="logoWhite" ></NavigationMenu>
            </b-col>
          </b-row>
        </b-container>
      </div>
    </div>
  </div>
</template>

<script>
  import NavigationMenu from '../common/header/NavigationMenu';

  export default {
    components: {
      NavigationMenu,
    },
    methods: {
      scrollToTop() {
        window.scrollTo(0, 0);
      }
    },
    mounted() {
      this.scrollToTop();
    },
  }
</script>

<style scoped lang="scss">
  .wrappHead{
    height: 1216px;
    background: url("../../assets/contact_up_bg.png");
  }
  .container-fluid {
    padding: 0;
  }
  .fon-filter {
    height: 1216px;
    padding: 81px 9%;
    background: #19cddac4;
  }
  @media screen  and (max-width: 991px){
    .fon-filter{
      padding-top: 0;
    }
  }
</style>
