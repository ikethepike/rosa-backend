<template>
  <div id="lessons-list">
    <nav class="toolkit">
      <a :href="urls.create">
        <h4>Create a lesson</h4>
        <lesson-icon></lesson-icon>
      </a>
    </nav>

    <ul class="lessons">
      <li :key="lesson.id" v-for="lesson in lessons">{{ lesson.title }}</li>
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
    urls: {
      create: `${Rosa.url}/create`,
    },
    lessons: [],
  }),
  methods: {
    refreshLessons() {
      axios.get('/resource/lessons/').then(response => {
        this.lessons = response.data
      })
    },
  },
  mounted() {
    if (this.preload) {
      return (this.lessons = this.preload)
    }

    this.refreshLessons()
  },
}
</script>
