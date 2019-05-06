<template>
    <div class="cellScill" @click="toFilters(name)">
        <img :src="img_url" :alt="name">
        <hr>
        <p>{{name}}</p>
    </div>
</template>
<script>
    export default {
        props:{
            img_url:{
                type:String
            },
            name:{
                type:String
            }
        },
        methods:{
            toFilters(value){
                 this.$router.push({ path: 'huurEenSpecialist', query: { role: value}})
            }
        }
    }
</script>
<style scoped lang="scss">
    .cellScill{
        img{
            max-width: 100%;
            filter: invert(.8);
        }
      width: 33.3%;
      padding-top: 2%;
      border: 1px solid #cacaca;
      text-align: center;
        &:hover{
            hr{
                border-color: white;
            }
            p{
                color: white;
            }
            background-color: #2ad0e1;
            border-color: #2ad0e1;
            color: white;
        }
    }
    .cellScill:hover {
        img {
            filter:none;
        }
    }
    hr{
        border: 1px solid #cacaca;
        width: 20%;
        margin-bottom: 4%;
    }
    p{
        color: #969696;
        font-family:GolanoRegular;
        font-size:1.3vw;
        font-weight: 400;
        line-height: 1.5;
        margin-bottom: 6%;
    }
    @media screen  and (max-width: 1200px){
      p {
        font-size: 1.4rem;
      }
    }
    @media screen and (max-width: 790px){
      p{
        font-size: 1.2rem;
      }
    }
    @media screen and (max-width: 767px){
      .cellScill img{
          max-width: 40%;
      }
    }
    @media screen and (max-width: 575px){
      .cellScill {
        width: 70%;
        padding: 5% 0;
      }
    }
    @media screen  and (max-width: 450px) {
      h2 {
        font-size: 2.5rem;
      }
      p{
        font-size: 1.2rem;
      }
    }
    @media screen and (max-width: 414px){
      .cellScill {
        width: 100%;
      }
    }
    @media screen  and (max-width: 360px) {
      h2 {
        font-size: 2rem;
      }
      p{
        font-size: 1.5rem;
      }
    }

</style>
