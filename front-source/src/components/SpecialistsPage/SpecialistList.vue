<template>
    <div class="wrapp">

        <div class="price-items">
            <div class="price-item" v-for="price in priceList" :key="Math.random()">
                <img @click.self="onClickPrice(price.val)"
                     :src="price.img"
                     :class="{priceActive: price.val === filters.user_hourly_rate}"
                     alt="image">
                <h2>{{ price.title }}</h2>
                <span> &#8364; {{ price.text }}</span>
            </div>
        </div>
      <div class="filters">
          <div class="filter-item">
              <vue-single-select
                v-model="filters.role"
                placeholder="Specialismen"
                :options="rolesList == 'DTP’er' ? 'Fotograaf' : rolesList"
                :required="true"
                class="input-cast"
              ></vue-single-select>
          </div>

          <div class="filter-item">
              <vue-single-select
                v-model="filters.user_place_to_work"
                placeholder="Locatie werkplek"
                :options="placesToWork"
                :required="true"
                class="input-cast"
              ></vue-single-select>
          </div>

          <div class="filter-item">
              <vue-single-select
                v-model="filters.user_region"
                placeholder="Regio"
                :options="regionsList"
                :required="true"
                class="input-cast"
              ></vue-single-select>
          </div>

          <div class="filter-item">
              <vue-single-select
                      :class="{disabled: !citiesList.length }"
                      v-model="filters.user_city"
                      placeholder="Locatie last"
                      :options="citiesList"
                      :required="true"
                      class="input-cast"
              ></vue-single-select>
          </div>
      </div>

        <b-container fluid class="anketa-items">
            <b-row>
                <b-col class="anketa-item" v-for="profile in filteredSpecialistList" xl="4" sm="6"
                       :key="profile.id + Math.random()">
                    <Anketa
                            :user_avatar_url="profile.user_avatar"
                            :name="profile.firstname"
                            :lastName="profile.lastname"
                            :role="profile.role"
                            :specialistId="profile.id"
                            :stars="Number(profile.rating)"
                            :type="'stars'">
                    </Anketa>
                </b-col>
            </b-row>
        </b-container>

    </div>
</template>

<script>
    import {mapGetters, mapMutations} from 'vuex';
    import axios from "../../axios.config";
    import VueSingleSelect from "vue-single-select";
    import Anketa from '../Anketa';
    import AnketaDisabled from './AnketaDisabled';
    import AnketaInConversation from './AnketaInConversation';
    import {swiper, swiperSlide} from 'vue-awesome-swiper'

    export default {
        data() {
            return {
                filters: {
                    user_hourly_rate: "30.00",
                    role: '',
                    user_place_to_work: '',
                    user_region: '',
                    user_city: '',
                },
                priceList: [
                    {
                        img: require(`../../assets/semi.png`),
                        title: "Semi Pro",
                        text: "30 p.u",
                        val: "30.00",
                    },
                    {
                        img: require(`../../assets/pro.png`),
                        title: "Pro",
                        text: "45 p.u",
                        val: "45.00",
                    },
                    {
                        img: require(`../../assets/expert.png`),
                        title: "Expert",
                        text: "55 p.u",
                        val: "55.00",
                    },
                ],
            }

        },
        created(){
            this.filters.role = this.$router.history.current.query.role;
            this.$router.push({ path: 'huurEenSpecialist', query: {
              ...this.filters
            }});
        },
        mounted: function () {
          this.$store.dispatch('other_request/get_data_with_server');
        },
        methods: {
            onClickPrice: function (index) {
                this.filters.user_hourly_rate = index;
            },
            applyFilter: function (arr, key, value) {
                return value ? arr.filter(item => item[key] === value) : arr;
            },
        },
        computed: {
            ...mapGetters({
                specialistList: 'specialistList/getAllUsers',
                rolesList:      'other_request/getRolesListWithStore',
                placesToWork:   'other_request/getPlacesToWorkWithStore',
                regions:        'other_request/getRegionsWithStore',
                regionsList:    'other_request/getRegionsListWithStore',
                cities:         'other_request/getCitiesWithStore',
                // citiesList:     'other_request/getCitiesListListWithStore',
            }),
            citiesList:{
                get() {
                  return this.$store.state.other_request.citiesList
                },
                set(value){
                    this.$store.commit('other_request/cityDataMut', {data:[]})
                },
            },
            filteredSpecialistList() {
                this.$router.push({ path: 'huurEenSpecialist', query: {
                  ...this.filters
                }});

                let result = this.specialistList;

                let regionId = this.filters.user_region
                    ? this.regions.filter(item => item.title_en === this.filters.user_region)[0].region_id
                    : this.filters.user_region;

                let cityId = this.filters.user_city
                    ? this.cities.filter(item => item.title_en === this.filters.user_city)[0].city_id
                    : this.filters.user_city;


                regionId ? this.$store.dispatch('other_request/getCityWithServer', regionId) : this.citiesList = [];

                let filtersCopy = {...this.filters, user_region: regionId, user_city: cityId};

                Object.keys(this.filters).forEach(key => {
                    result = this.applyFilter(result, key, filtersCopy[key]);
                });

                return result
            }
        },
        components: {
            VueSingleSelect,
            Anketa,
            AnketaDisabled,
            AnketaInConversation,
        },
    }
</script>

<style lang="css">
   .input-cast.disabled input {
        background-color: #CBCBCB !important;
   }
</style>

<style scoped lang="scss">
    .disabled {
        pointer-events:none;
        color: #bfcbd9;
        cursor: not-allowed;
    }

    .priceActive {
        opacity: 1 !important;
    }

    .slider-wrap-main {
        width: 100%;
        position: relative;
    }

    .slider-swiper-main {
        width: 90%;
    }

    .anketa-item {
        margin-right: 0;
    }

    .swiper-button-prev {
        width: 45px;
        height: 85px;
        left: -35px;
        top: 25%;
        background: url("../../assets/icons/arrow-carousel-left.png") no-repeat;

    }

    .swiper-button-next {
        width: 45px;
        height: 85px;
        right: -35px;
        top: 25%;
        background: url("../../assets/icons/arrow-carousel-right.png") no-repeat;
    }

    .slider-form {
        display: none;
    }

    p {
        margin: 0;
        color: #646464;
        font-family: GolanoRegular;
        font-size: 25px;
        font-weight: 400;
        line-height: 30.54px;
    }

    .price-items {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-left: 4%;
        img {
            opacity: 0.2;
        }
    }

    .price-item {
        width: 160px;
        text-align: center;
        padding-top: 2%;
        margin-right: 2%;
        cursor: pointer;

        img {
            width: 90%;
            margin-bottom: 12%;
        }
        h2 {
            color: #646464;
            font-family: GolanoSemi;
            font-size: 29px;
            margin: 0;
        }
        span {
            color: #646464;
            font-family: GolanoRegular;
            font-size: 29px;
        }
    }

    .filters, .filter-item {
        display: flex;
    }

    .filters {
        width: 100%;
        margin-top: 4%;
        margin-left: 2.5%;
        justify-content: space-around;
    }

    .filter-item {
        width: 32%;
        div {
            width: 100%;
        }
    }

    .input-cast {
        font-family: GolanoRegular;
        font-size: 20px;
        font-weight: 400;
        line-height: 30.54px;

    }

    .anketa-items {
        margin-top: 4%;
        margin-left: 1%;
        width: 84vw;
    }

    .anketa-item {
        margin-bottom: 4%;
    }

    @media screen and (max-width: 1780px) {
        button {
            font-size: 0.8rem;
            padding: 3% 0 !important;
        }
    }

    @media screen and (max-width: 1440px) {
        button {
            font-size: 0.7rem;
        }
    }

    @media screen and (max-width: 1090px) {
        .input-cast {
            font-size: 1rem;
        }
        .anketa-item {
            padding: 0;
        }
    }

    @media screen and (max-width: 900px) {
        .filters {
            flex-direction: column;
        }
        .filter-item {
            width: 100%;
        }

    }

    @media screen and (max-width: 575px) {
        .anketa-items {
          padding: 25px;
        }
        .slider-form {
            display: block;
        }
    }

    @media screen and (max-width: 500px) {
        .price-item {
            img {
                width: 70%;
            }
            h2 {
                font-size: 1.5rem;
            }
            span {
                font-size: 1.2rem;
            }
        }
    }

    @media screen and (max-width: 440px) {
        .anketa-item {
            padding: 0;
        }
    }

    @media screen and (max-width: 425px) {
        .filters {
            margin-left: 0;
            padding: 3%;
        }
        .anketa-items {
            margin-left: 0;
            width: 100%;
        }
        .slider-swiper-main {
            width: 100%;
        }
        .anketa-item {
            margin-right: 0;
        }
        .swiper-button-prev {
            background-size: contain;
            width: 35px;
            top: 43%;
            height: 65px;
            left: 10px;
        }
        .swiper-button-next {
            background-size: contain;
            width: 35px;
            height: 65px;
            top: 43%;
            right: 10px;
        }
    }

    @media screen and (max-width: 410px) {
        .price-item {
            img {
                width: 60%;
            }
            h2 {
                font-size: 1.3rem;
            }
            span {
                font-size: 1rem;
            }
        }
    }

    @media screen and (max-width: 320px) {
        .price-items {
            margin-left: 0;
            margin-bottom: 10%;
        }
        .filter-item div {
            width: 100%;
        }
        .anketa-items {
            margin-left: 0;
            padding: 0;
            .anketa-item {
                padding: 0;
            }
        }
    }
</style>

