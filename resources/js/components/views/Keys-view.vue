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
          <span class="secret">{{ key.secret }}</span>
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
  }),
  methods: {
    refresh() {
      axios.get('/oauth/clients').then(response => (this.keys = response.data))
    },
    create() {
      axios
        .post('/oauth/clients', {
          name: this.name,
          errors: [],
          redirect: 'http://test.com',
        })
        .then(this.refresh)
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


