<template>
  <div>
    <div class="skills-items" v-if="isLargeSize">
      <div class="skills-item" v-if="Number(days.monday)">
        Monday
      </div>
      <div class="skills-item" v-if="Number(days.tuesday)">
        Tuesday
      </div>
      <div class="skills-item" v-if="Number(days.wednesday)">
        Wednesday
      </div>
      <div class="skills-item" v-if="Number(days.thursday)">
        Thursday
      </div>
      <div class="skills-item" v-if="Number(days.friday)">
        Friday
      </div>
      <div class="skills-item" v-if="Number(days.saturday)">
        Saturday
      </div>
      <div class="skills-item" v-if="Number(days.sunday)">
        Sunday
      </div>
    </div>

    <div class="point-items" v-if="isSmallSize">
      <!--Monday-->
      <div class="point" v-if="Number(days.monday)">MA</div>
      <!--Tuesday-->
      <div class="point" v-if="Number(days.tuesday)">DI</div>
      <!--Wednesday-->
      <div class="point" v-if="Number(days.wednesday)">WO</div>
      <!--Thursday-->
      <div class="point" v-if="Number(days.thursday)">DO</div>
      <!--Friday-->
      <div class="point" v-if="Number(days.friday)">VR</div>
      <!--Saturday-->
      <div class="point" v-if="Number(days.saturday)">ZA</div>
      <!--Sunday-->
      <div class="point" v-if="Number(days.sunday)">ZO</div>
    </div>

  </div>

</template>

<script>
  export default {
    name: "AvailabilityDays",
    props: {
      isSmallSize: {
        type:Boolean,
        default: false
      },
      isLargeSize: {
        type: Boolean,
        default: false
      },
      days: {
        type:Object,
        default: ()=>({})
      }
    }
  }
</script>

<style lang="scss" scoped>

  .point-items {
    display: flex;
    @media screen and (max-width: 720px) {
      justify-content: center;
    }
  }

  .point {
    width: 40px;
    height: 35px;
    background-color: #2ad0e1;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    margin-right: 2%;
    font-size: 15px;
  }

  .skills-items {
    width: 97%;
    margin-top: 2%;
    display: flex;
    flex-wrap: wrap;
    @media screen and (max-width: 720px) {
      width: 100%;
    }
  }

  .skills-item {
    width: 19%;
    border-radius: 5px;
    border: 1px solid #c8c8c8;
    margin-right: 1%;
    margin-bottom: 1.5%;
    padding: 1.5% 0;
    text-align: center;
    color: #484755;
    font-family: GolanoRegular;
    font-size: 17px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    @media screen and (max-width: 720px) {
      width: 49%;
    }
  }

</style>
