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
            <input type="number" id="week" v-model="weekNumber" min="1" max="52" required>
          </section>
          <input type="submit" value="Submit" class="hero-button">
        </form>
      </div>
    </template>
    <template v-if="term && fetched">
      <div class="calendar">
        <!-- Past -->
        <template v-if="weeks.past.length">
          <calendar-tile v-for="week in weeks.past.slice(-2)" :key="week.id" :week="week"></calendar-tile>
        </template>

        <!-- Current -->
        <template v-if="weeks.current">
          <calendar-tile :key="weeks.current.id" :week="weeks.current"></calendar-tile>
        </template>

        <!-- Future -->
        <template v-if="weeks.future.length">
          <calendar-tile
            v-for="week in weeks.future.slice(0, futureCount)"
            :key="week.id"
            :week="week"
          ></calendar-tile>
        </template>
      </div>
    </template>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
import calendarTile from '../elements/Calendar-tile.vue'
export default {
  components: {
    calendarTile,
  },
  data: () => ({
    weekNumber: null,
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
    futureCount() {
      if (!this.term) return 5

      return 3 + (2 - this.weeks.past.length) + (this.weeks.current ? 0 : 1)
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
      this.createTerm(this.weekNumber)
    },
  },
  mounted() {
    this.$store.dispatch('planning/retrieve').then(() => (this.fetched = true))
  },
}
</script>
