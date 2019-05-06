<template>
  <div>
      <span v-for="star in 5">
          <img  :key="Math.random()"
                :class="star > calcRating(stars_count) ? 'empty' : ''"
                :src="star > calcRating(stars_count) ? empty_star_img_url : star_img_url"
                alt="star">
      </span>
  </div>
</template>

<script>
  export default {
    name: "StarComponent",
    props: {
      stars_count: Number,
    },
    data() {
      return {
        star_img_url: require(`../../../../assets/icons/star-active.png`),
        empty_star_img_url: require(`../../../../assets/icons/empty-star-active.png`),
      }
    },
    methods: {
      calcRating: num => num > 5 ? (num ? Math.floor(num / 2) : 1) : num,
    }
  }
</script>

<style scope lang="scss">
  .empty {
    transform: translateY(0.5px);
  }
</style>
