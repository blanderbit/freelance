<template>
  <div class="wrapper">
    <div class="main">
      <div class="header">
        <!--<img-->
          <!--:src="require(`../../assets/profile/${img}`)"-->
          <!--alt="first">-->
        <h3>{{name}}</h3>
        <p>{{text}}</p>
      </div>

      <div class="footer">
        <p>{{ mainText }}</p>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props:['name', 'text', 'img', 'mainText'],
  }
</script>
<style scoped lang="scss">
  .wrapper{
    padding: 0 7.5px;
  }
  div.main{
    border: 2px solid #d7d7d7;
  }
  img{
    max-width: 100%;
    display: inline-block;
  }
  .header{
    padding: 4% 8% 0 8%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    border-bottom: 2px solid #d7d7d7;
  }
  .footer{
    p {
      margin: 10%;
      text-align: justify;
      color: #969696;
      font-family: GolanoRegular;
      font-size: 1.4vw;
      font-weight: 400;
      line-height: 6.2vh;
      word-wrap: break-word;
    }
  }
  h3{
    font-size: 2vw;
    color: #646464;
    font-family: GolanoRegular;
    font-weight: 600;
    margin: 0px;
    margin-top: 10px;
  }
  p{
    color: #646464;
    font-family: GolanoRegular;
    font-size: 1.4vw;
    font-weight: 400;
    line-height: 1.5;
  }
  button{

    &:first-child{
      margin-right: 6px;
    }
    &:last-child{
      margin-left: 6px;
    }
    align-items: center;
    display: flex;
  }
  @media screen and (max-width: 1200px) {
    h3{
      font-size: 1.7rem;
    }
    p{
      font-size: 1.7rem;
    }
    .footer p{
      font-size: 1.4rem;
    }
  }
  @media screen  and (max-width: 985px){
    p {
      font-size: 1.3rem;
    }
  }
  @media screen and (max-width: 760px) {
    /*p {*/
      /*font-size: 1.5rem;*/
    /*}*/
  }
  @media screen and (max-width: 670px) {
    .wrapper{
      margin-bottom: 5%;
    }
    .header{
      padding: 5% 0;
    }
    p {
      font-size: 1.2rem;
    }
    .footer button{
      font-size: 1.5rem;
      border-radius: 5px;
      border-width: 2px;
      padding: 5px 5px;
      img{
        width: 50% !important;
      }
    }
    .footer p {
      font-size: 1.4rem;
    }

  }
  @media screen and (max-width: 575px) {
    .wrapper {
      width: 100%;
      padding: 0;
    }
  }
  @media screen and (max-width: 320px) {
    .wrapper {
      width: 100%;
    }
  }
</style>
