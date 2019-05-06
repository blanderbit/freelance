<template>
    <div class='carousel-view'>
        <transition-group
                class='carousel'
                tag="div">
            <div v-for="slide in slides"
                 class='slide'
                 :key="slide.id">
                <img :src="slide.img" alt="slieImg" :custom="slide.id">
            </div>
        </transition-group>
        <div class='carousel-controls'>
            <button class='carousel-controls__button carousel_right' @click="previous">
                <img :src="src2" alt="left">
            </button>
            <button class='carousel-controls__button carousel_left' @click="next">
                <img :src="src3" alt="left">
            </button>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                src1:require(`./../../assets/header-illustration.png`),
                src2:require(`./../../assets/icons/arrow_left.png`),
                src3:require(`./../../assets/icons/arrow_right.png`),
                slides: [
                    {
                        img: require(`../../../../assets/CauseffectSl1.png`),
                        id: 1
                    },
                    {
                        img: require(`./../../assets/CauseffectSl2.png`),
                        id: 2
                    },
                    {
                        img: require(`../../../../assets/CauseffectSl1.png`),
                        id: 3
                    },
                ]
            }
        },
        methods: {
            next () {
                const first = this.slides.shift();
                this.slides = this.slides.concat(first)
            },
            previous () {
                const last = this.slides.pop();
                this.slides = [last].concat(this.slides)
            }
        },
      props: ['portfolio'],
    }
</script>
<style scoped lang="scss">
    img{
        width: 100%;
        height:100%;
      @media screen and (max-width: 1366px) {
        width: 70%;
      }
      @media screen and (max-width: 1200px) {
        width: 80%;
      }
      @media screen and (max-width: 1100px) {
        width: 90%;
      }
      @media screen and (max-width: 998px) {
        width: 103%;
      }
    }
    .carousel-view {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .carousel {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        width: 100%;
        min-height: 25em;
    }
    .slide {
        flex: 0 0 100%;
        margin: 1em 1em 0 1em;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        transition: transform 0.3s ease-in-out;
    }
    .slide:first-of-type {
        opacity: 0;
    }
    .slide:last-of-type {
        opacity: 0;
    }
    .carousel-controls{
        width: 100%;
        position: absolute;
        bottom: 6%;
    }
    .carousel-controls__button{
        margin-right: 17px;
        border: none;
        background-color: transparent;
    }
    .carousel_left {
      float: left;
    }
    .carousel_left {
      float: right;
    }
    @media screen and (max-width: 767px){
        .carousel-controls{
            left: 43%;
        }
    }
</style>
