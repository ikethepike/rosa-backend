<template>
  <div id="editor-view" :class="{ 'dark-mode' : editor.darkMode }">
    <header
      class="masthead"
      :class="{ 'has-image' : masthead }"
      :style="{ backgroundImage: `url(${masthead})`}"
    >
      <nav id="editor-toolbar">
        <section class="left">
          <a role="button" @click="toggleDarkMode()">
            <bulb-icon></bulb-icon>
          </a>
          <label>
            <image-icon></image-icon>
            <input type="file" class="hidden-element" @change="upload">
          </label>
        </section>
        <section class="right">
          <a @click="options.active = true">
            <settings-icon></settings-icon>
          </a>
          <a role="save" @click="save">
            <save-icon></save-icon>
          </a>
        </section>
      </nav>
    </header>

    <div id="editor-body">
      <header id="main-header">
        <input type="text" placeholder="Lesson title..." v-model="title" id="title">
        <span class="author">{{ lesson ? lesson.user.name : user.name }}</span>
      </header>
      <textarea ref="body" id="lesson-body"/>
    </div>

    <div class="options" v-if="options.active">
      <div class="background" @click="options.active = false"></div>
      <form class="options-pane reading-flow" @submit.prevent="options.active = false">
        <section class="options-content">
          <div class="slide-block">
            <h4>Options</h4>
            <p>You can enable or disable the embedded editor options from here, setting up a default editor for the class to use.</p>
          </div>

          <div class="slide-block">
            <input type="checkbox" id="disable-editor" v-model="options.editorDisabled">
            <label for="disable-editor">Disable editor?</label>
          </div>

          <div class="slide-block" v-if="!options.editorDisabled">
            <label for="boilerplate">Glitch Boilerplate</label>
            <input type="url" v-model="options.boilerplate">
            <span
              class="hint"
              v-if="options.boilerplate && !options.boilerplate.includes('remix')"
            >Hmm, that does't look like a remix url.</span>
          </div>
        </section>
        <input type="submit" class="hero-button" value="Save">
      </form>
    </div>

    <div
      class="message-box"
      :class="message.status"
      v-if="message.status"
      @click="clearMessage"
    >{{ message.text }}</div>
  </div>
</template>
<script>
import SimpleMDE from 'simplemde'
import { mapGetters, mapActions } from 'vuex'

// Components
import bulbIcon from '../icons/Bulb-icon.vue'
import saveIcon from '../icons/Save-icon.vue'
import imageIcon from '../icons/Image-icon.vue'
import previewIcon from '../icons/Preview-icon.vue'
import settingsIcon from '../icons/Settings-icon.vue'

export default {
  components: {
    bulbIcon,
    saveIcon,
    imageIcon,
    previewIcon,
    settingsIcon,
  },
  props: {
    user: {
      required: true,
      type: Object,
    },
  },
  data: () => ({
    body: null,
    title: '',
    message: {
      text: '',
      status: '',
    },
    options: {
      active: false,
      editorDisabled: false,
      editorBoilerplate: '',
    },
    masthead: null,
    uploading: false,
  }),
  computed: {
    ...mapGetters({
      editor: 'editor',
      lesson: 'editorEditing',
    }),
  },
  methods: {
    ...mapActions({
      toggleDarkMode: 'editorDarkMode',
    }),
    save() {
      const data = {
        snippets: [],
        title: this.title,
        text: this.body.value(),
        id: this.editor.editing,
        masthead: this.masthead,
        boilerplate: this.options.boilerplate,
        disable_editor: this.options.editorDisabled,
      }

      data.id ? this.update(data) : this.create(data)
    },
    create: async function(data) {
      axios
        .post('/resource/lessons', data)
        .then(response => {
          const lesson = response.data
          this.$store.dispatch('editLesson', lesson.id)
          this.$store.dispatch('getLessons')

          this.message = {
            status: 'success',
            text: `Lesson saved`,
          }
        })
        .catch(error => {
          this.message = {
            status: 'error',
            text: 'Error saving lesson',
          }
        })
    },
    update: async function(data) {
      const response = await axios.put(`/resource/lessons/${data.id}`, data)

      this.message = {
        status: 'success',
        text: 'Lesson updated',
      }
    },
    preview() {},
    clearMessage() {
      this.message = {
        text: '',
        status: null,
      }
    },
    upload(e) {
      this.uploading = true

      const fileData = new FormData()
      fileData.append('masthead', e.target.files[0])

      axios
        .post(`/lessons/masthead`, fileData)
        .then(response => {
          this.masthead = response.data
          this.uploading = false
        })
        .catch(error => {
          this.message = {
            text: 'Error uploading masthead',
            status: 'error',
          }
          this.uploading = false
        })
    },
    loadLesson() {
      if (!this.lesson) return

      this.title = this.lesson.title
      this.body.value(this.lesson.text)
      this.masthead = this.lesson.masthead
      this.options.editorDisabled = this.lesson.disable_editor
      this.options.boilerplate = this.lesson.boilerplate
    },
  },
  watch: {
    lesson() {
      this.loadLesson()
    },
  },
  beforeDestroy() {
    this.$store.dispatch('editLesson', null) // clear lesson
  },
  mounted() {
    this.body = new SimpleMDE({
      status: false,
      toolbar: false,
      el: this.$refs.body,
      placeholder: 'Lesson text...',
    })

    this.loadLesson()
  },
}
</script>