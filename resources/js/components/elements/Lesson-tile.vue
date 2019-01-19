<template>
  <a class="lesson-tile slide-block">
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
  data: () => ({}),
  computed: {
    link() {
      return `${Rosa.url}/#/edit/${this.lesson.id}`
    },
    author() {
      return `${this.lesson.user.first_name} ${this.lesson.user.last_name}`
    },
  },
}
</script>

