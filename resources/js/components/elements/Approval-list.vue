<template>
  <div class="approval-list">
    <header>
      <h3>{{ users.length ? `There are ${users.length} users to approve` : `There are no users to approve` }}</h3>
    </header>
    <ul>
      <approve-user-tile :user="user" :key="user.id" v-for="user in users" @refresh="refresh"></approve-user-tile>
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    preload: {
      type: Array,
    },
  },
  data: () => ({
    users: [],
  }),
  methods: {
    refresh() {
      axios
        .get('/users/to-approve')
        .then(response => (this.users = response.data))
    },
  },
  mounted() {
    if (this.preload.length) {
      this.users = this.preload
    } else {
      this.refresh()
    }
  },
}
</script>
<style lang="scss" scoped>
.approval-list {
  header {
    top: 0;
    width: 100%;
    padding: 1rem 0;
    position: sticky;
    background: #ececec;
  }
}
</style>

