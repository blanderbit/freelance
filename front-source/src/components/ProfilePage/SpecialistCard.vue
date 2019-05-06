<template>
    <div>
        <div class="wrapp">

            <div class="left-part">
                <div class="up">
                    <div class="up-left">
                        <img v-lazy="getBaseURL() + selectedSpecialist.user_avatar" alt="photo">
                    </div>
                    <div class="up-right">
                        <div class="wrap-item">
                            <div class="name-first">
                                <p>{{ selectedSpecialist.firstname }}</p>
                                <span>{{ selectedSpecialist.user_place_to_work }}</span>
                            </div>
                            <div class="name-last">
                                <p><span>€ {{selectedSpecialist.wage}} ,- </span> per uur</p>
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
                                <p class="mobile_left_text_flex">
                                    <span>Beschikbaar</span>
                                    <span class="mobile_left_text_span_center_position">
                                        {{selectedSpecialist.count_user_weekday_availability_hours || 0}}  uur p/w
                                    </span>
                                </p>

                                <div class="point-items">
                                    <AvailabilityDays
                                      :isSmallSize="true"
                                      :days="selectedSpecialist.weekday_availability">
                                    </AvailabilityDays>
                                </div>
                            </div>

                            <div class="availability-last">
                                <RatingComponent :rating_count="Number(selectedSpecialist.rating)"></RatingComponent>
                            </div>
                        </div>

                        <div class="btnCustom" @click="onOpenPopUp">
                            <Button btnText="VRAAG DEZE SPECIALIST AAN"
                                    btnClass="btnOrangeNav">
                            </Button>
                        </div>

                    </div>
                </div>
                <hr>

                <div class="skills" >
                    <h2 class="mobile_left_text">Skills</h2>
                    <div class="skills-items">
                        <div class="skills-item" v-for="skill in selectedSpecialist.skills"
                             v-if="skill.name!== ''"
                             v-bind:key="skill + Math.random()">
                            {{skill.name}}
                        </div>
                    </div>
                    <hr>

                    <!--<h2 class="mobile_left_text">Availability</h2>-->
                    <!--<AvailabilityDays-->
                      <!--:isLargeSize="true"-->
                      <!--:days="selectedSpecialist.weekday_availability">-->
                    <!--</AvailabilityDays>-->

                    <h2 class="mobile_left_text">Over mij</h2>
                    <div class="about_me">
                        {{selectedSpecialist.about_me}}
                    </div>
                </div>

            </div>
            <div class="right-part" >
                <div class="rij_title" >
                    <div class="rij_left">In bezit van auto</div>
                    <div class="rij_right">
                        {{selectedSpecialist.driver_license === "1" ? "Ja" : "Nee"}}
                    </div>
                </div>
                <div class="rij_content">
                    <div class="rij_block">
                        <div class="rij_left">Leeftijd:</div>
                        <div class="rij_right">{{selectedSpecialist.age}}</div>
                    </div>
                    <div class="rij_block">
                        <div class="rij_left">Woonplaats:</div>
                        <div class="rij_right">{{selectedSpecialist.location}}</div>
                    </div>
                    <div class="rij_block">
                        <div class="rij_left">Jaren ervaring:</div>
                        <div class="rij_right">{{selectedSpecialist.years_experience}}</div>
                    </div>
                    <div class="rij_block">
                        <div class="rij_left">Relevante cursus/training:</div>
                        <div class="rij_right">{{selectedSpecialist.relevant_training}}</div>
                    </div>
                    <div class="rij_block">
                        <div class="rij_left">Taal:</div>
                        <div class="rij_right">
                            <div v-for="lang in selectedSpecialist.user_languages">{{lang}}</div>
                        </div>
                    </div>
                </div>
                <hr class="hr-down">
                <h2 class="mobile_left_text">Interne opleidingen</h2>
                <div class="mbo-items">
                    <div class="mbo-item"
                         v-for="certificate in selectedSpecialist.user_education_certificats"
                         v-if="certificate.type === 'certificate'"
                         v-bind:key="certificate + Math.random()">
                        <div
                           :href="getBaseURL() + certificate.file_name">
                            {{certificate.title || 'default name'}}
                        </div>
                    </div>
                </div>

                <hr class="hr-down">
                <h2 class="mobile_left_text">Opleidingen</h2>
                <div class="mbo-items">
                    <div class="mbo-item"
                         v-for="diplom in selectedSpecialist.user_education_certificats"
                         v-if="diplom.type === 'diploma'"
                         v-bind:key="diplom + Math.random()">
                        <div
                           :href="diplom.file_name == '' ? '#' : getBaseURL() + diplom.file_name">
                            {{diplom.title || 'default name'}}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <Experience :previousWorkArr="selectedSpecialist.previous_work_experience"
                    :videos="selectedSpecialist.user_video">
        </Experience>

        <Carousel :portfolio="selectedSpecialist.portfolio"></Carousel>
    </div>

</template>

<script>
    import axios from "../../axios.config";
    import {mapGetters} from 'vuex';
    import { base_url } from "../../axios.config";
    import StarComponent from '../common/StarComponent';
    import RatingComponent from '../common/RatingComponent';
    import AvailabilityDays from '../common/AvailabilityDays';
    import Button from '../common/Button';
    import Experience from './Experience';
    import Carousel from './Carousel';

    export default {
        components: {
            Button,
            Experience,
            Carousel,
            StarComponent,
            RatingComponent,
            AvailabilityDays
        },
        computed:{
          ...mapGetters({
            selectedSpecialist: 'specialistList/getSelectedSpecialist'
          }),
        },
        methods: {
            getBaseURL: () => base_url,
            onOpenPopUp() {
                this.$store.dispatch('specialistPopUp/statePopUpAct', true);
                this.$store.dispatch('specialistList/selectedSpecialist', this.selectedSpecialist.id);
                document.getElementsByTagName('body')[0].style.overflow = 'hidden';
            },
        },
        mounted: function () {
          this.$store.dispatch('specialistList/selectedSpecialist', this.$route.params.id);
        },
    }
</script>

<style scoped lang="scss">
    .mobile_left_text_span_center_position{
        font-family: GolanoRegular!important;
    }
    p {
        font-family: GolanoRegular;
    }

    .point-items {
        display: flex;
    }
    .rij_title{
        display: flex;
        width: 500px;
        justify-content: space-between;
        font-family: GolanoRegular;
        font-size: 25px;
        font-weight: 400;
        line-height: 35px;
        color: #646464
    }
    .rij_left{
        width:250px;font-family: GolanoSemi;
    }
    .rij_right{
         width:250px
    }
     .rij_content{
         padding-top: 2%;font-family: GolanoRegular;font-size: 25px;font-weight: 400;
         line-height: 35px;color: #646464
     }
     .rij_block{
         display: flex; width: 500px; justify-content: space-between
     }
    .wrapp {
        padding-left: 9%;
        display: flex;
        width: 95%;
        justify-content: space-between;
        margin-top: 5%;
    }

    .left-part {
        width: 64%;
        border: 2px solid #d7d7d7;
        background-color: #ffffff;
        display: flex;
        flex-direction: column;
        padding-bottom: 2%;
    }
    .about_me{
        width: 100%;
        word-break: break-word;
        padding-right: 20px;
        font-family: GolanoRegular;
    }

    .right-part {
        width: 34%;
        border: 2px solid #d7d7d7;
        background-color: #ffffff;
    }

    .up {
        width: 100%;
        display: flex;
    }

    .up-left {
        width: 29%;
        text-align: center;
        padding-top: 3%;
        img {
            width: 85%;
            border-radius: 50%;
        }
    }

    .up-right {
        width: 70%;
        hr {
            border: 1px solid #d7d7d7;
            background-color: #ffffff;
            width: 97%;
            margin-top: 4%;
            margin-left: -1%;
        }
    }

    .wrap-item {
        display: flex;
        justify-content: space-between;
    }

    .name-first {
        display: flex;
        align-items: flex-start;
        width: 68%;
        margin-top: 10%;
        p {
            font-family: GolanoSemi;
            font-size: 2.2vw;
            font-weight: 600;
            margin-bottom: 0;
            width: 50%;
            line-height: 35px;
        }
        span {
            border-radius: 4px;
            background-color: #ff8400;
            margin-left: 3%;
            color: white;
            font-size: 20px;
            padding: 2px 10px 0 2%;
            width: 62%;
        }
    }

    .name-last {
        width: 30%;
        p {
            font-size: 25px;
            font-weight: 400;
            line-height: 35px;
            color: #646464;
            margin-top: 37%;
            margin-left: 17%;
            margin-bottom: 0;
            span {
                color: #00c7d6;
                font-family: GolanoSemi;
                font-weight: 600;
            }
        }
    }

    .specialty {
        display: flex;
        justify-content: space-between;
        width: 100%;
        p {
            font-size: 27px;
            font-weight: 400;
            line-height: 20px;
            color: #646464;
            margin-top: 1px;
            margin-bottom: 0;
        }
    }

    .rating-stars {
        width: 30%;
    }

    .availability {
        margin-top: 6%;
    }

    .availability-first {
        display: flex;
        width: 70%;
        p {
            font-size: 24px;
            font-weight: 400;
            line-height: 35px;
            color: #646464;
            margin-top: 1px;
            margin-bottom: 0;
            margin-right: 10%;
        }
        span {
            font-family: GolanoSemi;
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

    .availability-last {
        width: 30%;
        margin-top: 35px;
        padding-left: 5%;
        p {
            font-size: 24px;
            font-weight: 400;
            line-height: 35px;
            color: #646464;
            margin-top: 1px;
            margin-bottom: 0;
            margin-right: 10%;
        }
        span {
            font-family: GolanoSemi;
        }
    }

    .btnCustom {
        margin: 4% 0;
        button {
            width: 451px;
            font-size: 1.24vw;
            padding: 1.5% 0;
        }
    }

    hr {
        height: 2px;
        background-color: #d7d7d7;
        width: 93%;
        margin-top: 3%;
    }

    .skills {
        margin-top: 2%;
        margin-left: 3%;
        h2 {
            color: #646464;
            font-family: GolanoSemi;
            font-size: 25px;
            font-weight: 400;
            line-height: 35px;
        }
    }

    .skills-items {
        width: 97%;
        margin-top: 2%;
        display: flex;
        flex-wrap: wrap;
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
    }

    .right-part {
        padding: 2%;
        h2 {
            color: #646464;
            font-family: GolanoSemi;
            font-size: 25px;
            font-weight: 400;
            line-height: 35px;
        }
        p {
            font-size: 25px;
            font-weight: 400;
            line-height: 35px;
            color: #646464;
            margin-top: 9%;
            margin-left: -1%;
            margin-bottom: 0;
            padding-left: 1%;
        }
        span {
            font-family: GolanoSemi;
            margin-right: 10%;
        }
    }

    .mbo-items {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        margin-top: 4%;
        margin-bottom: 35%;
    }

    .hr-down {
        margin-top: 27%;
    }

    .mbo-item {
        margin-right: 2%;
        margin-top: 1%;
        padding: 2%;
        border-radius: 5px;
        border: 1px solid #d7d7d7;
        color: #484755;
        font-family: GolanoRegular;
        font-size: 25px;
        font-weight: 400;
        line-height: 25px;
        text-transform: uppercase;
        text-align: center;
    }

    @media screen and (max-width: 1698px) {
        .name-last p {
            margin-left: 7%;
        }
        .rij_left,.rij_right{
            width:50%;
        }

        .rij_content, .rij_title{
         font-size: 20px;
        }
        .rij_title, .rij_block{
            width: 100%;
        }

    }

    @media screen and (max-width: 1520px) {
        .availability-last {
          margin-top: 35px !important;
        }
        .name-last p {
            margin-left: 1%;
        }
        .btnCustom button {
            width: 80%;
            font-size: 1.1rem;
        }
    }

    @media screen and (max-width: 1425px) {
        .availability-last {
          margin-top: 35px !important;
        }
        .up * {
            font-size: 1.2rem;
        }
        .up-left {
            img {
                width: 80%;
            }
        }
        .rij_content, .rij_title{
            font-size: 17px;
        }
        .name-last p {
            font-size: 1.4rem;
        }
        .name-first{
            width: 70%;
            align-items: baseline;
        }
        .name-first p {
            font-size: 1.6rem;
            width: 46%;
        }
        .name-first span {
            font-size: 1.0rem;
            width: 48%;
        }
        .availability-first p {
            margin-right: 1%;
        }
        .availability-last {
            padding: 0;
        }
        .up-right hr {
            margin-left: 0;
            width: 80%;
        }
        .availability-first p {
            font-size: 1.3rem;
        }
    }

    @media screen and (max-width: 1200px) {
        .up * {
            font-size: 1.5rem;
        }
        .about_me{
            padding: 0;
        }
        .name-first p {
            width: 100%;
            text-align: left;
        }
        .point {
            width: 45px;
            height: 45px;
        }

        .rij_title, .rij_block{
            width: 500px;
            font-size: 25px;
        }
        .rij_left, .rij_right{
            width:250px;font-size: 25px;
        }

        .wrapp {
            flex-direction: column;
        }
        .left-part {
            width: 100%;
            border: none;
            border-bottom: 2px solid #d7d7d7;
        }
        .right-part {
            width: 100%;
            border: none;
            padding: 0;
            margin-top: 4%;
            margin-bottom: 5%;
        }
        .mbo-items {
            margin-bottom: 5%;
        }
        .hr-down {
            margin-top: 15%;
        }
        hr {
            width: 100%;
            height: 1px;
        }
        .mbo-item {
            width: 18%;
            padding: 9% 0;
        }
        .name-first{
            width: 65%;
        }
        .name-first span {
            /*display: none;*/
            width: 100%;
        }
        .btnCustom {
            /*display: none;*/
        }
        .up-right hr {
            width: 96%;
        }
        .specialty {
            width: 100%;
            display: flex;
            align-items: center;
            p {
                width: 60%;
            }
            .rating-stars {
                width: 30%;
            }
        }
        .skills {
            margin-top: 0;
            margin-left: 0;
        }
    }
    @media screen and (max-width: 820px) {
        .name-first{
            width: 69%;
            font-size: 1.2rem;
        }
    }

    @media screen and (max-width: 720px) {
        .availability-last {
          margin-top: 0 !important;
        }
        hr {
            width: 100%;
        }
        .up {
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
            hr {
                width: 100%;
            }
        }
        .btnCustom{
            display: flex;
            justify-content: center;
        }
        .wrap-item {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .availability-first {
            width: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
        }
        .point-items {
            justify-content: center;
        }
        .availability-last {
            width: 100%;
            text-align: center;
        }
        .skills-items {
            width: 100%;
        }
        .skills-item {
            width: 49%;
        }
        .name-first {
            width: 100%;
            text-align: center;
        }
        .specialty p {
            width: 50%;
        }
        .specialty .rating-stars {
            width: 45%;
        }
        .rating-stars {
            text-align: right;
            img {
                width: 11%;
            }
            img.empty {
              transform: translateY(-0.5px);
              width: 10%;
            }
        }
        .mbo-item {
            font-size: 20px;
        }
        .rjb {
            display: none;
        }
        h2 {
            text-align: center;
        }
        .mobile_left_text{
            text-align: left;
        }
        .mobile_left_text_flex{
            display: flex;
        }
        .mobile_left_text_span_center_position{
            align-self: center;
            /*margin-left: 5px;*/
            margin: auto;

        }
        .name-last {
           width: 100%;
        }
        .name-last p {
            margin: 0;
            text-align: right;
        }
        .mbo-item {
            width: 26%;
            padding: 9% 0;
        }
    }

    @media screen and (max-width: 550px) {
        .rij_left,.rij_right{
            width:50%;
        }
        .rij_block, .rij_title{
            width:100%;
        }
        h2, .rij_title{
            font-size:15px!important;
        }
        .rij_left, .rij_right, .rij_block, .about_me,.rij_content{
            font-size:13px!important;
        }
    }
    @media screen and (max-width: 450px) {
        .availability-last {
          margin-top: 0 !important;
        }
        .mbo-items {
            justify-content: center;
            flex-wrap: wrap;
        }
        .mbo-item {
            width: 36%;
            font-size: 17px;
        }
        .specialty {
            flex-direction: column;
            p {
                width: 100%;
                text-align: center;
            }
            .rating-stars {
                width: 100%;
                text-align: center;
            }
        }
        .name-last {
           width: 100%;
        }
        .name-last p {
            margin: 0;
            text-align: center;
        }
        .name-first{
            align-items: center;
        }
        .name-first span{
            font-size: 15px;
        }
        .mbo-item {
            width: 26%;
            padding: 9% 0;
        }
    }

    @media screen and (max-width: 320px) {
        .availability-last {
          margin-top: 0 !important;
        }

        .wrapp {
            padding-left: 9%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 95%;
            /*width: 100%;*/
        }
        .specialty {
            display: flex;
            flex-direction: column;
            text-align: center;
            p {
                width: 100%;
            }
            .rating-stars {
                width: 100%;
            }
        }
        .name-first {
            width: 100%;
            justify-content: center;
        }.name-first span{
                     font-size: 10px;
                 }
        .availability-first p {
            margin: 2% 0;
        }
        .skills {
            margin-left: 0;
        }
    }
</style>
