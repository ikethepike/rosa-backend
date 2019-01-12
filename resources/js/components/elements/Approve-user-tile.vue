<template>
  <li class="approve-user-tile slide-block" :class="{ hidden : processed }">
    <user-icon></user-icon>
    <section class="bio">
      <h4>
        <span class="first">{{ user.firstName }}</span>
        <span class="last">{{ user.lastName }}</span>
      </h4>
      <p>{{ user.email }}</p>
    </section>

    <nav>
      <a class="button approve" @click="approve">Approve</a>
      <a class="button delete" @click="destroy">Delete</a>
    </nav>
  </li>
</template>
<script>
export default {
  props: {
    user: {
      required: true,
      type: Object,
    },
  },
  data: () => ({
    processed: false,
  }),
  methods: {
    approve() {
      axios
        .put(`/user/approve`, {
          id: this.user.id,
        })
        .then(response => {
          this.$emit('refresh')
        })
    },
    destroy() {
      axios.delete(`/user/destroy/${this.user.id}`).then(response => {
        this.$emit('refresh')
      })
    },
  },
}
</script>
<style lang="scss" scoped>
.approve-user-tile {
  width: 100%;
  display: flex;
  padding: 1rem 0;
  svg {
    max-height: 4rem;
  }
  nav {
    margin-left: auto;
    align-self: center;
  }
}
</style>

