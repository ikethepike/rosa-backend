<template>
  <div class="lesson-picker">
    <header>
      <span>Lessons</span>
      <a class="close-button" @click="close"></a>
    </header>
    <div class="lesson-list">
      <a
        class="lesson slide-block"
        v-for="lesson in lessons"
        :key="lesson.id"
        @click="pick(lesson.id)"
      >
        <div class="title">{{ lesson.title }}</div>
        <div class="author">{{ lesson.user.name }}</div>
      </a>
    </div>
  </div>
</template>
<script>
export default {
  computed: {
    lessons() {
      return this.$store.getters.lessons
    },
  },
  methods: {
    pick(id) {
      this.$emit('pick', id)
    },
    close() {
      this.$emit('close')
    },
  },
}
</script>
