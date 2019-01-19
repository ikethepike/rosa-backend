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
  return state.editorEditing
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
