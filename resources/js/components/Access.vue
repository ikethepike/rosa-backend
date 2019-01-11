<template>
  <div class="access-wrapper">
    <div class="access">
      <header :class="{ processing }">
        <logo></logo>
      </header>

      <form @submit.prevent="onSubmit">
        <div>
          <label for="email">Email</label>
          <input
            required
            type="email"
            id="email"
            :class="{ error : errors.email}"
            v-model="email"
            @change="emailCheck"
          >
          <span class="error">{{ errors.responses.email }}</span>
        </div>

        <div>
          <label for="password">Password</label>
          <input
            required
            type="password"
            id="password"
            :class="[passwordState, { error : errors.password}]"
            v-model="password"
          >
          <span class="error">{{ errors.responses.repeat }}</span>
        </div>

        <!-- if new user -->
        <template v-if="!exists">
          <div class="slide-block">
            <label for="repeat">Repeat your password</label>
            <input
              required
              type="password"
              id="repeat"
              :class="[passwordState, { error : errors.repeat}]"
              v-model="repeat"
            >
          </div>

          <div class="slide-block">
            <label for="name">First Name</label>
            <input
              required
              type="text"
              id="name"
              :class="{ error : errors.firstName}"
              v-model="firstName"
            >
            <span class="error">{{ errors.responses.firstName }}</span>
          </div>

          <div class="slide-block">
            <label for="name">Last Name</label>
            <input
              required
              type="text"
              id="name"
              :class="{ error : errors.lastName}"
              v-model="lastName"
            >
            <span class="error">{{ errors.responses.lastName }}</span>
          </div>
        </template>

        <input type="submit" class="hero-button" :value="exists ? 'Login' : 'Register'">
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
    processing: false,
    errors: {
      email: false,
      repeat: false,
      password: false,
      lastName: false,
      firstName: false,
      responses: {},
    },
  }),
  methods: {
    onSubmit: async function() {
      if (this.processing) return

      this.clearErrors()
      this.processing = true

      if (this.exists) {
        await this.login()
      } else {
        await this.register()
      }

      this.processing = false
    },
    emailCheck() {
      axios.post(`/user/exists/`, { email: this.email }).then(response => {
        this.exists = Boolean(response.data)
      })
    },
    register() {
      return axios
        .post(`/user/register`, {
          email: this.email,
          password: this.password,
          firstName: this.firstName,
          lastName: this.lastName,
        })
        .then(response => {
          return (window.location = `${Rosa.url}/home`)
        })
        .catch(error => {
          console.error(error.response)
          console.error(error.response.data)
          console.error(error.response.status)
          if (!error.response) {
            console.error('Error registering', error)
          }
          Object.keys(error.response.data.errors).forEach(
            errorKey => (this.errors[errorKey] = true)
          )
        })
    },
    login() {
      axios
        .post(`/user/login`, {
          email: this.email,
          password: this.password,
        })
        .then(response => {
          return (window.location = `${Rosa.url}/home`)
        })
        .catch(error =>
          Object.keys(error.errors).forEach(
            errorKey => (this.errors[errorKey] = true)
          )
        )
    },
    clearErrors() {
      for (const key in this.errors) {
        this.errors[key] = false
      }
    },
  },
  computed: {
    passwordState() {
      if (!this.repeat.length) return null

      if (this.password === this.repeat) {
        return 'success'
      }

      return 'error'
    },
  },
  mounted() {
    if (this.email.length) this.emailCheck()
  },
}
</script>
