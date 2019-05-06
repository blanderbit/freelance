<template>
    <div class="reviews-wrapp">
        <h2 v-if="reviews.length !== 0">Reviews</h2>

        <div class="reviews-main" v-for="(review, index) in reviews" :key="index + Math.random()">
            <div class="reviews-items">
                <div class="reviews-item-content">
                    <span class="user-name">{{review.author}}</span>
                    <div class="reviews-title">
                        <p>{{review.company_name}}</p>
                        <div class="rating-stars">
                            <StarComponent :stars_count="Number(review.rating)"></StarComponent>
                        </div>
                    </div>
                    <hr>
                    <p class="reviews-content">{{review.review}}</p>
                </div>
            </div>
            <div class="btn-item">
                <div class="btnCustom" @click="onOpenPopUp">
                    <Button btnText="VRAAG DEZE SPECIALIST AAN"
                            btnClass="btnOrangeNav">
                    </Button>
                </div>
            </div>
        </div>


      <!-- mobile screen swiper -->
        <div class="reviews-slider">
            <div class="slider-wrap-main">
                <swiper :options="swiperOption" class="slider-swiper-main">
                    <swiper-slide v-for="(item, index) in reviews" :key="index + Math.random()">
                        <div class="reviews-item-content" style="width:80%">
                            <span class="user-name">{{ item.author }}</span>
                            <div class="reviews-title">
                                <p>{{ item.company_name }}</p>
                                <div class="rating-stars">
                                  <StarComponent :stars_count="Number(item.rating)"></StarComponent>
                                </div>
                            </div>
                            <hr>
                            <p class="reviews-content">{{ item.review }}</p>
                        </div>
                    </swiper-slide>
                </swiper>
                <div class="swiper-button-prev left" slot="button-prev"></div>
                <div class="swiper-button-next right" slot="button-next"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "../../axios.config";
    import { mapGetters } from "vuex"
    // import {mapActions} from "vuex"
    import Button from '../common/Button';
    import StarComponent from '../common/StarComponent';
    import {swiper, swiperSlide} from 'vue-awesome-swiper';

    export default {
        components: {
            Button,
            StarComponent
        },
        data() {
            return {
                swiperOption: {
                    slidesPerView: 1,
                    loop: true,
                    setWrapperSize: true,
                    spaceBetween: 40,
                    navigation: {
                        nextEl: '.left',
                        prevEl: '.right'
                    }
                },

            }
        },
        methods: {
            onOpenPopUp() {
              this.$store.dispatch('specialistPopUp/statePopUpAct', true);
              this.$store.dispatch('specialistList/selectedSpecialist', this.$route.params.id);
              document.getElementsByTagName('body')[0].style.overflow = 'hidden';
            },
        },
        mounted: function () {
            this.$store.dispatch('specialistList/getReviewsWithServer', this.$route.params.id);
        },
        computed: {
            ...mapGetters({
                 reviews: 'specialistList/getReviewsWithStore'
            }),
        },
        beforeDestroy(){
            // this.$store.dispatch('specialistList/getReviewsWithServerDestroy', this.$route.params.id);
        }
    }
</script>

<style scoped lang="scss">
    .slider-wrap-main {
        width: 100%;
        position: relative;
    }

    .slider-swiper-main {
        width: 90%;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
    }

    .swiper-button-prev {
        width: 45px;
        height: 85px;
        top: 85%;
        left: 30%;
        @media screen and (max-width: 720px) {
          top: 50%;
          left: 0%;
        }
        background: url("../../assets/icons/arrow-carousel-left.png") no-repeat;

    }

    .swiper-button-next {
        width: 45px;
        height: 85px;
        top: 85%;
        right: 30%;
        @media screen and (max-width: 720px) {
          top: 50%;
          right: 0%;
        }
        background: url("../../assets/icons/arrow-carousel-right.png") no-repeat;

    }

    .reviews-wrapp {
        padding-left: 9%;
    }

    .reviews-main {
        display: flex;
        padding-bottom: 5%;
        width: 100%;
    }

    .reviews-items {
        margin-top: 3%;
        margin-left: 2%;
        width: 60%
    }

    h2 {
        margin-top: 10%;
        padding-left: 2%;
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

    .user-name {
        font-family: GolanoSemi;
        font-size: 30px;
        font-weight: 600;
        line-height: 40px;
        color: #646464;
    }

    .reviews-item-content {
        border: 2px solid #d7d7d7;
        background-color: #ffffff;
        padding: 3%;
        margin-top: 4%;

    }

    .reviews-title {
        display: flex;
        justify-content: space-between;
        span {
            color: #646464;
            font-family: GolanoSemi;
            font-size: 30px;
            font-weight: 400;
            line-height: 40px;
        }
        p {
            font-size: 30px;
            line-height: 30px;

        }
    }

    .reviews-content {
        margin-top: 2.5%;
        margin-bottom: 20%;
    }

    .btn-item {
        margin-top: 6.4%;
        margin-left: 2%;
        width: 29%;
    }

    .btnCustom {
        margin: 4% 0;
        button {
            width: 100%;
            font-size: 1.24vw;
            padding: 2.5% 0;
        }
    }

    .reviews-slider {
        display: none;
    }

    @media screen and (max-width: 767px) {
        h2 {
            font-size: 2rem;
        }
        p {
            font-size: 1.5rem;
        }
        .user-name, .reviews-title p {
            font-size: 1.8rem;
        }
        .rating-stars {
            width: 40%;
            display: flex;
            img {
                width: 25%;
            }
        }
        .btn-item {
            width: 30%;
        }
    }

    @media screen and (max-width: 720px) {
        h2 {
            padding-left: 9%;
        }
        .reviews-slider {
            display: block;
        }
        .reviews-items {
            display: none;
        }
        .reviews-wrapp {
            padding: 0;
        }
        .reviews-main {
            margin-top: 5%;
            width: 95%;
        }
        .reviews-items {
            width: 92%;
        }
        .btn-item {
            display: none;
        }
    }

    @media screen and (max-width: 520px) {
        .reviews-title {
            width: 100%;
            p {
                width: 50%;
            }
        }
        .rating-stars {
            width: 50%;
        }
        p {
            line-height: 1.2;
        }
    }

    @media screen and (max-width: 414px) {
        .slider-swiper-main {
            width: 100%;
        }
        .swiper-slide {
            margin-left: 0;
        }
        .reviews-content {
            margin-bottom: 30%;
        }
    }

    @media screen and (max-width: 400px) {
        .reviews-main {
            width: 100%;
            padding: 0;
        }
        .reviews-wrapp {
            padding: 0;
        }
        .reviews-items {
            width: 100%;
            margin: 0;
        }
        .rating-stars {
            img {
                width: 10%;
            }
        }
        .reviews-title {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .reviews-title {
            p {
                width: 100%;
            }
        }
        .rating-stars {
            width: 100%;
        }
        .reviews-item-content {
            text-align: center;
        }
    }

    @media screen and (max-width: 320px) {
        .reviews-wrapp {
            padding: 0;
        }
    }
</style>
