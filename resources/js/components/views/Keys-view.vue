<template>
  <div class="keys-view">
    <h2>Authorized Keys</h2>
    <form @submit.prevent="create">
      <input type="text" placeholder="Name..." v-model="name" required>
      <input type="submit" value="Create" class="button-outlined">
    </form>

    <section class="authorized">
      <ul>
        <li class="slide-block tile" v-for="key in keys" :key="key.secret">
          <span class="name">{{ key.name }}</span>
          <span class="expires" title="expires">{{ key.expires_at }}</span>
          <a role="button" @click="destroy(key.id)">Destroy</a>
        </li>
      </ul>
    </section>
  </div>
</template>
<script>
export default {
  data: () => ({
    name: '',
    keys: [],
    token: '',
  }),
  methods: {
    refresh() {
      axios
        .get('/oauth/personal-access-tokens')
        .then(response => (this.keys = response.data))
    },
    create() {
      axios
        .post('/oauth/personal-access-tokens', {
          name: this.name,
          scopes: [],
        })
        .then(response => {
          this.name = ''
          this.token = response.data.accessToken
          this.$store.dispatch('toast', `Your token is: \n ${this.token}`)
          this.refresh()
        })
    },
    destroy(id) {
      axios.delete(`/oauth/clients/${id}`).then(() => this.refresh())
    },
  },
  mounted() {
    this.refresh()
  },
}
</script>


