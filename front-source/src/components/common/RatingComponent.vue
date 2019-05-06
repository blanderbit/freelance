<template>
  <p class="mobile_left_text_flex_rating">
    <span>Rating</span>
    <span class="mobile_left_text_span_center_position">{{ calcRating(rating_count) || 0 }}/5</span>
  </p>
</template>

<script>
  export default {
    name: "RatingComponent",
    props: {
      rating_count: Number,
    },
    methods: {
      calcRating: num => num > 5 ? (num ? Math.floor(num / 2) : 1) : num,
    }
  }
</script>
<style>
  .mobile_left_text_span_center_position{
    font-family: GolanoRegular!important;
  }
  @media screen and (max-width: 720px) {
    .mobile_left_text_flex_rating{
      display: flex;
      margin-right: 21px!important;
    }
    .mobile_left_text_span_center_position{
      align-self: center;
      /*margin-left: 5px;*/
      margin: auto;
    }
  }
</style>
