<template>
    <b-container fluid class="main">
        <b-row>
            <b-col class="firstRow">
                <div class="imgBlock">
                    <img v-lazy="src1" alt="Business card" class="img-responsive">
                    <img v-lazy="src2" alt="Fresh" class="img-responsive">
                </div>
                <div>
                    <img src="../../assets/homepage/juicy-bottles.png" alt="Juicy" class="img-responsive">
                </div>
                <div>
                    <h2>
                      Diverse designers, ongelofelijke resultaten
                    </h2>
                    <hr>
                    <p>
                      Onze specialisten zijn op de hoogte van de laatste trends op het gebied van grafisch ontwerp
                        en gaan graag creatief voor jou aan de slag. Wat je ook wilt uitstralen, onze on demand
                        specialisten zorgen voor het perfecte design.
                    </p>
                </div>
            </b-col>
        </b-row>
        <b-row>
            <b-col class="secondRow" md="6">
                <h2>Online marketeers</h2>
                <hr>
                <p>Geen enkele vorm van online marketing is onze marketeers vreemd. Of het nu gaat om online
                    zichtbaarheid of vindbaarheid, wij hebben voor elke uitdaging iemand in huis.</p>
            </b-col>
            <b-col md="6">
                <div class="wrapImage">
                    <img v-lazy="src3" alt="development" class="img-responsive">
                </div>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
    export default {
        data(){
            return {
                src1: require(`../../assets/homepage/business-card.png`),
                src2: require(`../../assets/homepage/fresh-packaging.png`),
                src3: require(`../../assets/homepage/development-image.png`),
            }
        },

    }
</script>
<style scoped lang="scss">
    img{
        max-width: 91.5%;
        height: auto;
    }
    .col{
        padding: 0px;
    }
    .imgBlock img{
        max-width: 88.5%;
        display: block;
        &:first-child{
            margin-bottom: 10%;
        }
    }
    .main{
        margin-top: 5%;
    }
    h2{
        word-break: break-word;
        margin-left: 15px;
        letter-spacing: 2px;
        color: #00c8d7;
        font-family: GolanoSemi;
        font-size: 4vw;
        font-weight: 400;
        line-height: 0.9;
        margin-bottom: 30px;
    }
    hr{
        width:8.5%;
        height: 10px;
        margin-left: 20px;
        background-color: #00c8d7;
    }
    p{
        padding: 4% 0 0 6%;
        color: #969696;
        font-family: GolanoRegular;
        font-size: 1.5vw;
        font-weight: 400;
        line-height: 1.7;
    }
    .firstRow{
        display: flex;
        align-items: center;
        justify-content: center;

        div:nth-child(1){
            width: 13%;
        }
        div:nth-child(2){
            width: 25%;
        }
        div:nth-child(3){
            width: 54%;
        }
    }
    .secondRow{
        padding: 6% 0 0 10%;
    }
    .wrapImage{
        img{

        }
    }
    @media screen and (max-width: 1200px){
      p {
        font-size: 1.5rem;
      }
      hr {
        height: 3px;
        width: 14%;
      }
    }
    @media screen and (max-width: 767px){
        .main{
            display: none;
        }
    }
</style>
