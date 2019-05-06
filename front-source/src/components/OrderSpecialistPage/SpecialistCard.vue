<template>
  <div>
    <!--modal profile-->
    <div class="order-left">
      <div class="left-up">
        <div class="up-left">
          <img :src="getBaseURL() + selectedSpecialist.user_avatar" alt="photo">
        </div>
        <div class="up-right">
          <div class="wrap-item">
            <div class="name-first">
              <p>{{ selectedSpecialist.firstname }}</p>
              <span>{{ selectedSpecialist.user_place_to_work }}</span>
            </div>

            <div class="name-last">
              <p><span>€ {{selectedSpecialist.user_hourly_rate}} ,- </span> per uur</p>
            </div>
          </div>
          <div class="specialty">
            <p> {{ selectedSpecialist.role }}</p>
            <div class="rating-stars">
              <StarComponent :stars_count="Number(selectedSpecialist.rating)"></StarComponent>
            </div>
          </div>
          <hr>

          <div class="wrap-item availability">
            <div class="availability-first">
              <p>
                <span>Beschikbaar</span>
                {{selectedSpecialist.count_user_weekday_availability_hours || 0}} uur p/w
              </p>
            </div>

            <div class="availability-last">
              <RatingComponent :rating_count="Number(selectedSpecialist.rating)"></RatingComponent>
            </div>
          </div>

          <div class="point-items">
            <AvailabilityDays
                    :isSmallSize="true"
                    :days="selectedSpecialist.weekday_availability">
            </AvailabilityDays>
          </div>

        </div>
      </div>
      <hr>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex';
  import { base_url } from "../../axios.config";
  import StarComponent from '../common/StarComponent';
  import RatingComponent from '../common/RatingComponent';
  import AvailabilityDays from '../common/AvailabilityDays';

  export default {
    methods: {
      getBaseURL: () => base_url,
    },
    computed: {
      ...mapGetters({
        selectedSpecialist: 'specialistList/getSelectedSpecialist',
      }),
    },
    components: {
      StarComponent,
      RatingComponent,
      AvailabilityDays
    },
  }
</script>

<style scoped lang="scss">
  .order-left {
    width: 100%;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    padding-bottom: 2%;
    position: relative;
  }
  .left-up {
    width: 100%;
    display: flex;
  }
  .up-left {
    width: 30%;
    padding-top: 3%;
    text-align: center;
    img {
      width: 85%;
      border-radius: 50%;
    }
  }
  .up-right {
    width: 67%;
    hr {
      height: 2px;
      background-color: #d7d7d7;
      width: 97%;
      margin-top: 4%;
      margin-left: -1%;
    }
  }
  .wrap-item {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
  }
  .name-first {
    display: flex;
    align-items: center;
    width: 50%;
    margin-top: 10%;
    p {
      font-family: GolanoSemi;
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 0;
      line-height: 35px;
    }
    span {
      border-radius: 4px;
      background-color: #ff8400;
      color: white;
      font-size: 10px;
      padding: 2px 10px 0 2%;
      width: 47%;
      margin-left: 10px;
    }
  }
  .name-last {
    width: 45%;
    display: flex;
    justify-content: flex-end;
    p{
      font-size: 1.5rem;
      line-height: 35px;
      color: #646464;
      margin-bottom: 0;
      span {
        color: #00c7d6;
        font-family: GolanoSemi;
        font-weight: 600;
      }
    }
  }
  .specialty{
    display: flex;
    justify-content: space-between;
    width: 100%;
    p{
      font-size: 1.5rem;
      line-height: 20px;
      color: #646464;
      margin-top: 1px;
      margin-bottom: 0;
    }
  }

  .availability {
    margin-top: 5%;
  }

  .availability-first {
    display: flex;
    width: 70%;
    p {
      font-size: 1.5rem;
      line-height: 35px;
      color: #646464;
      margin-top: 1px;
      margin-bottom: 0;
      width: 100%;
    }
    span {
      font-family: GolanoSemi;
      margin-right: 5%;

    }
  }
  .point {
    width: 60px;
    height: 60px;
    background-color: #2ad0e1;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    margin-right: 2%;
    font-size: 21px;
    line-height: 41.85px;
    text-transform: uppercase;
  }
  .availability-last {
    width: 30%;
    padding-left: 5%;

    p {
      font-size: 24px;
      line-height: 35px;
      color: #646464;
      margin-top: 1px;
      margin-bottom: 0;
      margin-left: 10%;
    }
    span {
      font-family: GolanoSemi;
    }
  }
  .point-items {
    display: flex;
    justify-content: center;
    width: 83%;
    margin-top: 2%;
  }
  hr {
    height: 2px;
    background-color: #d7d7d7;
    width: 93%;
    margin-top: 3%;
  }

  @media screen  and (max-width: 1410px){
    .name-first {
      display: flex;
      align-items: center;
      width: 70%;
      margin-top: 10%;
      p {
        font-family: GolanoSemi;
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 0;
        line-height: 35px;
      }
      span {
        border-radius: 4px;
        background-color: #ff8400;
        color: white;
        font-size: 10px;
        padding: 2px 10px 0 2%;
        width: 47%;
        margin-left: 10px;
      }
    }
    .left-up {
      flex-direction: column;
      justify-content: center;
    }
    .up-left {
      width: 100%;
      img {
        width: 40%;
      }
    }
    .up-right {
      width: 100%;
      padding: 2% 5%;
      hr {
        width: 100%;
        margin-left: 0;
      }
    }
    .point-items {
      width: 100%;
    }
  }
  @media screen  and (max-width: 800px){
    .name-first p {
      font-size: 2rem;
    }
    .availability-first {
      width: 60%;
    }
    .availability-last {
      width: 35%;
      padding: 0;
      display: flex;
      justify-content: flex-end;
    }
  }
  @media screen  and (max-width: 680px){
    .wrap-item, .specialty {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 5%;
    }
    .name-first, .name-last {
      justify-content: center;
      width: 100%;
    }
    .availability-first {
      width: 100%;
      text-align: center;
    }
    .availability-last {
      width: 100%;
      justify-content: center;
      p {
        margin-left: 0;
      }
    }
  }
  @media screen  and (max-width: 530px){
    .name-last {
      display: none;
    }
    .name-first {
      width: 100%;
      justify-content: center;
    }
    .specialty {
      flex-direction: column;
      text-align: center;
    }
    .rating-stars {
      width: 100%;
      img {
        width: 10%;
      }
    }
    .availability {
      flex-direction: column;
      text-align: center;
    }
    .availability-first {
      width: 100%;
      p {
        font-size: 1.3rem;
      }
    }
    .availability-last {
      width: 100%;
      justify-content: center;
      p {
        margin: 0;
        font-size: 1.3rem;
      }
    }
    .up-left img {
      width: 50%;
    }
    .name-first{
      align-item: inherit
    }
  }
  @media screen  and (max-width: 390px){
    .availability-first {
      p {
        font-size: 1.1rem;
      }
      span {
        margin-right: 1%;
      }
    }
    .availability-last {
      p {
        font-size: 1.1rem;
      }
    }
    .point-items {
      justify-content: space-around;
    }
    .point {
      width: 45px;
      height: 45px;
      font-size: 1rem;
    }
    .rating-stars img {
      width: 12%;
    }
    .name-first{
      align-item: inherit
    }
  }
</style>
