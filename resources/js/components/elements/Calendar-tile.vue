<template>
  <div class="calendar-tile slide-block-right" :class="week.date">
    <header class="calendar-header">
      <span class="fancy-heading">
        Tu
        <sup class="week">{{ week.number }}</sup>
      </span>
      
      <a class="plus-button" @click="picker = true"></a>
    </header>

    <lesson-picker v-if="picker" @close="picker = false" @pick="onPick"></lesson-picker>

    <div class="lessons">
      <div
        :key="`${week.number}:lesson:${lesson.id}:${index}`"
        v-for="(lesson, index) in week.lessons"
      >
        <span class="title">{{ lesson.title }}</span>
        <span class="name">{{ lesson.user.name }}</span>
        <a @click="detach(lesson.id)">Detach</a>
      </div>
    </div>

    <nav class="bottom-nav"></nav>
  </div>
</template>
<script>
import { mapActions } from 'vuex'
import lessonPicker from './Lesson-picker.vue'
export default {
  components: {
    lessonPicker,
  },
  props: {
    week: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    picker: false,
  }),
  methods: {
    ...mapActions({
      refresh: 'planning/retrieve',
      detachLesson: 'planning/detachLesson',
      attachLesson: 'planning/attachLesson',
    }),
    onPick(id) {
      this.picker = false

      this.$store
        .dispatch('planning/attachLesson', {
          week: this.week.id,
          lesson: id,
        })
        .then(this.refresh)
    },
    detach(id) {
      this.$store
        .dispatch('planning/detachLesson', {
          week: this.week.id,
          lesson: id,
        })
        .then(this.refresh)
    },
  },
}
</script>

