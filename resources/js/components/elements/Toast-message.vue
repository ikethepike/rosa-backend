<template>
  <div class="toast-message" v-if="toast">
    <div class="background" @click="close()"></div>

    <div class="message reading-flow slide-block">
      <span class="text">{{ toast }}</span>
      <a role="button" @click="close()" class="hero-button">Close</a>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  computed: {
    ...mapGetters({
      toast: 'toast',
    }),
  },
  methods: {
    ...mapActions({
      close: 'toast',
    }),
  },
}
</script>

