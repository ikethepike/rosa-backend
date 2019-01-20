import Axios from 'axios'

/**
 * toggleEditor
 * @param { state, commit, rootState } param
 * @param {Boolean} active
 */
export const toggleEditor = ({ commit, state }, active = null) => {
  return commit('toggleEditor', active)
}

/**
 * editLesson
 * @param { state, commit, rootState } param
 * @param { Number } lesson
 */
export const editLesson = ({ commit }, id) => {
  return commit('editLesson', id)
}

/**
 * editorDarkMode
 * @param { state, commit, rootState } param
 * @param {*} darkMode
 */
export const editorDarkMode = (
  { commit, state },
  darkMode = !state.editor.darkMode
) => {
  return commit('editorDarkMode', darkMode)
}

/**
 * toast
 * @param { state, commit, rootState } param
 * @param {*} toast
 */
export const toast = ({ commit }, toast = null) => {
  return commit('toast', toast)
}

/**
 * getLessons
 * @param { state, commit, rootState } param
 */
export const getLessons = async ({ commit }) => {
  const lessons = await axios.get('/resource/lessons')

  return commit('lessons', lessons.data)
}
