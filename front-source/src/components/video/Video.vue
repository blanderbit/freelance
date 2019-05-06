<template>
  <vimeo-player
    ref="player"
    class="iframe"
    :video-id="videoID"
    @ready="onReady"
    :progress="0"
    :loop="true"
    >
  </vimeo-player>
</template>
<script>
  export default {
    data() {
      return {
        autoplays: true,
        videoID: '261350725',
        options: {},
        playerReady: false
      }
    },
    methods: {
      onReady() {
        this.playerReady = true;
      },
      play () {
        this.$refs.player.play()
      },
      pause () {
        this.$refs.player.pause()
      }
    }
  }
</script>
<style lang="scss">
  .iframe {
    iframe {
      width: 100vw;
      height: 55vw;
      @media screen and (min-width: 1366px) and (max-width: 1920px) {
        width: 81.5vw;
        height: 45vw;
      }
      @media screen and (min-width: 768px)  {
        width: 70vw;
        height: 41vw;
      }
    }
  }
</style>

