import Axios from 'axios'

/**
 * retrieve
 * @param { state, commit, rootState } param
 */
export const retrieve = async ({ commit }) => {
  return new Promise(resolve => {
    axios.get('/planning').then(response => {
      commit('term', response.data)

      return resolve(response.data)
    })
  })
}

/**
 * createTerm
 * @param { state, commit, rootState } param
 * @param { Number } week
 */
export const createTerm = ({ commit }, week) => {
  return new Promise(resolve => {
    axios
      .post('/planning/term', {
        week: week,
      })
      .then(response => {
        resolve(response.data)
        return commit('term', response.data)
      })
  })
}

/**
 * addClass
 * @param { state, commit, rootState } param
 * @param {*} data
 */
export const attachLesson = ({ commit }, data) => {
  return new Promise(resolve => {
    axios
      .post('/planning/lesson/attach', {
        week: data.week,
        lesson: data.lesson,
      })
      .then(response => resolve(response.data))
  })
}

/**
 * addClass
 * @param { state, commit, rootState } param
 * @param {*} data
 */
export const detachLesson = ({ commit }, data) => {
  return new Promise(resolve => {
    axios
      .post('/planning/lesson/detach', {
        week: data.week,
        lesson: data.lesson,
      })
      .then(response => resolve(response.data))
  })
}
