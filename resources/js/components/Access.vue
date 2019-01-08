<template>
  <div class="access-wrapper">
    <div class="access">
      <header>
        <logo></logo>
      </header>

      <form @submit.prevent="onSubmit">
        <div>
          <label for="email">Email</label>
          <input required type="email" id="email" v-model="email" @change="emailCheck">
        </div>
        <div>
          <label for="password">Password</label>
          <input required type="password" id="password" v-model="password">
        </div>

        <!-- if new user -->
        <template v-if="!exists">
          <div class="slide-block">
            <label for="repeat">Repeat your password</label>
            <input required type="password" id="repeat" v-model="repeat">
          </div>
          <div class="slide-block">
            <label for="name">Name</label>
            <input required type="text" id="name" v-model="name">
          </div>
        </template>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    email: '',
    repeat: '',
    exists: true,
    password: '',
    lastName: '',
    firstName: '',
  }),
  methods: {
    onSubmit() {},
    emailCheck() {
      axios
        .post(`/user/exists`, {
          email: this.email,
        })
        .then(response => {
          exists = Boolean(response)
        })
    },
  },
}
</script>
