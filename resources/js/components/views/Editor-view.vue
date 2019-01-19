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
          <a>
            <preview-icon></preview-icon>
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
        <span class="author">{{ user.first_name }} {{ user.last_name}}</span>
      </header>
      <textarea ref="body" id="lesson-body"/>
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

export default {
  components: {
    bulbIcon,
    saveIcon,
    imageIcon,
    previewIcon,
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
    masthead: null,
    uploading: false,
  }),
  computed: {
    ...mapGetters(['editor']),
  },
  methods: {
    ...mapActions({
      toggleDarkMode: 'editorDarkMode',
    }),
    save() {
      axios
        .post('/resource/lessons', {
          title: this.title,
          text: this.body.value(),
          masthead: null,
          snippets: [],
        })
        .then(response => {
          this.masthead = response.data
          this.message = {
            status: 'success',
            text: `Lesson saved`,
          }
        })
        .error(error => {
          this.message = {
            status: 'error',
            text: 'Error saving lesson',
          }
        })
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
  },
  mounted() {
    this.body = new SimpleMDE({
      status: false,
      toolbar: false,
      el: this.$refs.body,
      placeholder: 'Lesson text...',
    })
  },
}
</script>