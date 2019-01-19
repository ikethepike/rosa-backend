<template>
  <div id="editor-view" :class="{ 'dark-mode' : editor.darkMode }">
    <nav id="editor-toolbar">
      <section class="left">
        <a role="button" @click="toggleDarkMode()">Lights</a>
      </section>

      <section class="right">
        <a role="save">Save</a>
      </section>
    </nav>

    <div id="editor-body">
      <header id="main-header">
        <input type="text" placeholder="title" v-model="title" id="title">
        <span class="author">{{ user.first_name }} {{ user.last_name}}</span>
      </header>
      <textarea ref="body" id="lesson-body"/>
    </div>
  </div>
</template>
<script>
import SimpleMDE from 'simplemde'
import { mapGetters, mapActions } from 'vuex'

export default {
  props: {
    user: {
      required: true,
      type: Object,
    },
  },
  data: () => ({
    body: null,
    title: '',
  }),
  computed: {
    ...mapGetters(['editor']),
  },
  methods: {
    ...mapActions({
      toggleDarkMode: 'editorDarkMode',
    }),
  },
  mounted() {
    this.body = new SimpleMDE({
      status: false,
      toolbar: false,
      el: this.$refs.body,
      placeholder: 'Lesson text...',
      autoDownloadFontAwesome: true,
    })
  },
}
</script>