import { createStore } from 'vuex'

export default createStore({
  state: {
    user:
    {
      id: null,
      username: null,
      first_name: null
    }
  },
  getters: {
  },
  mutations: {
    fetchUser(state, payload){
        state.user.id = payload.id;
        state.user.username = payload.username;
        state.user.first_name = payload.first_name;
    }
  },
  actions: {
  },
  modules: {
  }
})
