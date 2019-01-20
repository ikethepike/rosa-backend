/**
 * editorActive
 * @param {state, getters, rootState, rootGetters}
 * @return state.editorActive
 */
export const editorActive = state => {
  return state.editor.active
}

/**
 * editorEditing
 * @param {state, getters, rootState, rootGetters}
 * @return state.editorEditing
 */
export const editorEditing = state => {
  if (!state.lessons.length || !state.editor.editing) {
    return null
  }

  const filtered = state.lessons.filter(
    lesson => state.editor.editing == lesson.id
  )

  if (!filtered.length) {
    return null
  }

  return filtered[0]
}

/**
 * editor
 * @param {state, getters, rootState, rootGetters}
 * @return state.editor
 */
export const editor = state => {
  return state.editor
}

/**
 * toast
 * @param {state, getters, rootState, rootGetters}
 * @return state.toast
 */
export const toast = state => {
  return state.toast
}

/**
 * lessons
 * @param {state, getters, rootState, rootGetters}
 * @return state.lessons
 */
export const lessons = state => {
  return state.lessons
}
