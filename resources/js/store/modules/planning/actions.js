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
