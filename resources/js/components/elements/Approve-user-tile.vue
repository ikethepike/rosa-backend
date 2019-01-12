<template>
  <div class="approve-user-tile" :class="{ hidden : processed }">
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
  </div>
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
          this.processed = true
        })
    },
    destroy() {
      axios.delete(`/user/delete/${this.user.id}`).then(response => {
        this.processed = true
      })
    },
  },
}
</script>

