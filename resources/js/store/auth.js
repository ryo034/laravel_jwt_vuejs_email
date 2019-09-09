const state = {
  user: {
    id: Number,
    name: '',
    email: '',
  },
}

const getters = {}

const mutations = {
  setUser (state, user) {
    state.user = user
  },
}

const actions = {
  async logout (context) {
    context.commit('setUser',  null)
    const response = await axios.post('/logout')
  },

  async setUserInfo(context){
    try {
      const res = await axios.get('/api/auth/user')
      if (res.data.data) {
        context.commit('setUser', {id:res.data.data.id, name:res.data.data.name, email:res.data.data.email})
      }
    } catch (e) {
      console.log(e)
    }
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
