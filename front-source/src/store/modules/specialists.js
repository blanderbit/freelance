// initial state


import axios from "../../axios.config";

const state = {
  allUsersList: [],
  selectedSpecialistData:{},
  reviews: []
};


/**
 * ----- GETTERS -----
 **/

const getters = {
  getAllUsers: (state) => {
    return state.allUsersList;
  },
  getSelectedSpecialist: (state) => {
    return state.selectedSpecialistData;
  },
  getReviewsWithStore: (state) => {
    return state.reviews;
  },
};


/**
 * ----- ACTIONS -----
 **/

const actions = {

  allUsersList({commit}) {
    axios
      .post('/public/api/list_of_the_user.php')
      .then(response=> commit('allUsersListMut', response.data))
      .catch(err=>console.log(err));
  },
  selectedSpecialist ({commit, state}, id) {
    axios
      .get(`/public/api/get_user.php?id=${id}`)
      .then(response => commit('selectedSpecialistMut', response.data))
      .catch(err => console.log(err))
  },
  getReviewsWithServer ({commit}, id) {
    axios
      .get(`/public/api/get_user_rewiews.php?id=${id}`)
      .then(response => commit('getReviewsWithServerAndUpdateState', response.data))
      .catch(err => console.log(err))
  },
  getReviewsWithServerDestroy ({commit}, id) {
    commit('getReviewsWithServerAndUpdateState', {data:[]})
  },
};


/**
 * ----- MUTATIONS -----
 * */

const mutations = {
  allUsersListMut (state, value) {
    state.allUsersList = state.allUsersList.concat(value)
  },
  selectedSpecialistMut(state,value) {
    state.selectedSpecialistData = {...value};
  },
  getReviewsWithServerAndUpdateState(state, value) {
    state.reviews = value;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
