<template>
  <a class="lesson-tile slide-block" @click="edit">
    <file-icon></file-icon>
    <div>
      <span class="title">{{ lesson.title }}</span>
      <span class="author">{{ author }}</span>
    </div>
  </a>
</template>
<script>
export default {
  props: {
    lesson: {
      type: Object,
      required: true,
    },
  },
  computed: {
    darkMode() {
      return this.$store.getters.editor.darkMode
    },
    link() {
      return `${Rosa.url}/#/edit/${this.lesson.id}`
    },
    author() {
      return `${this.lesson.user.first_name} ${this.lesson.user.last_name}`
    },
  },
  methods: {
    edit() {
      this.$store.dispatch('editLesson', this.lesson.id)
    },
  },
}
</script>

