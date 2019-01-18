<template>
  <div id="editor-view">
    <!-- <nav id="editor-toolbar"></nav> -->
    <div id="editor-body">
      <header id="main-header">
        <input type="text" placeholder="title" v-model="title" id="title">
        <span class="author">{{ user.first_name }} {{ user.last_name}}</span>
      </header>
      <textarea ref="editor" id="lesson-body"/>
    </div>
  </div>
</template>
<script>
import SimpleMDE from 'simplemde'
export default {
  props: {
    user: {
      required: true,
      type: Object,
    },
  },
  data: () => ({
    title: '',
    editor: null,
  }),
  mounted() {
    this.editor = new SimpleMDE({
      el: this.$refs.editor,
    })
  },
}
</script>
<style lang="scss" scoped>
#toolbar button {
  width: 2em;
  height: 2em;
  border: none;
  background: none;
  padding: 0 0.25em;
}
</style>
