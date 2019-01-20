<template>
  <div class="planner-view">
    <span v-if="!fetched">Loading...</span>

    <template v-if="!term && fetched">
      <div class="no-term-view">
        <form class="prompt reading-flow slide-block" @submit.prevent="termSubmit">
          <section>
            <h4>What week does term end?</h4>
            <p>There is currently no term, to create one we need to know when term ends.</p>
            <label for="week">Week</label>
            <input type="number" id="week" v-model="week" min="1" max="52" required>
          </section>
          <input type="submit" value="Submit" class="hero-button">
        </form>
      </div>
    </template>
    <template v-if="term && fetched">
      <div class="calendar">
        <calendar-tile v-for="week in weeks.past.slice(-2)" :key="week.id" :week="week"></calendar-tile>
        <calendar-tile v-for="week in weeks.current" :key="week.id" :week="week"></calendar-tile>
        <calendar-tile v-for="week in weeks.future.slice(4)" :key="week.id" :week="week"></calendar-tile>
      </div>
    </template>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  data: () => ({
    week: null,
    fetched: false,
    processing: false,
  }),
  computed: {
    ...mapGetters({
      term: 'planning/term',
    }),
    weeks() {
      const output = {
        past: [],
        future: [],
        current: null,
      }

      if (!this.term) return output

      this.term.weeks.forEach(week => {
        if (week.date === 'current') {
          return (output.current = week)
        }

        output[week.date].push(week)
      })

      return output
    },
  },
  methods: {
    ...mapActions({
      getPlanning: 'planning/retrieve',
      createTerm: 'planning/createTerm',
    }),
    termSubmit() {
      if (this.processing) return

      this.processing = true
      this.createTerm(this.week)
    },
  },
  mounted() {
    this.$store.dispatch('planning/retrieve').then(() => (this.fetched = true))
  },
}
</script>
