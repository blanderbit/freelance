// initial state


import axios from "../../axios.config";

const state = {
  regions: [],
  regionsList: [],
  rolesList: [],
  placesToWork: [],
  cities: [],
  citiesList: [],
  cells:[]
};


/**
 * ----- GETTERS -----
 **/

const getters = {
  getRegionsWithStore() {
    return state.regions
  },
  getRegionsListWithStore() {
    return state.regionsList
  },
  getRolesListWithStore() {
    return state.rolesList
  },
  getPlacesToWorkWithStore() {
    return state.placesToWork
  },
  getCitiesWithStore() {
    return state.cities
  },
  getCitiesListListWithStore() {
    return state.citiesList
  },
  getCategoriesListListWithStore() {
    return state.cells
  }
}

const actions = {
    get_data_with_server({commit}) {
      request('/public/api/get_all_roles.php', 'allDataSpecialistListMut', 'rolesList');
      request('/public/api/get_all_places_to_work.php', 'allDataSpecialistListMut', 'placesToWork');
      request('/public/api/get_region.php', 'allDataSpecialistListMut', ['regions', 'regionsList']);
      function request(url, name_commit, name_mutations) {
        axios.get(url)
          .then(response => commit(name_commit, {data:response.data, name: name_mutations}))
          .catch(err => console.log(err))
      }
    },

    getCityWithServer({commit}, regionId){
      axios
        .get(`/public/api/get_city.php?region_id=${regionId}`)
        .then(cities => {
          commit('cityDataMut', cities)
        })
        .catch(err => console.log(err))
    },

    getCategoriesWithServer({commit}){
      axios
        .get('/public/api/home_page_categories.php')
        .then(response => {
          commit('CategoriesMut', response.data)
        })
        .catch(err => console.log(err))
    },
};

const mutations = {
  allDataSpecialistListMut (state, value) {
    switch(value.name){
      case 'rolesList':
        state[value.name] = value.data.map(item => item.name);
        break;
      case 'placesToWork':
        state[value.name] = Object.keys(value.data).map(key => value.data[key]);
        break;
    }
    if(typeof value.name === 'object') {
      state[value.name[0]] = value.data;
      state[value.name[1]] = value.data.map(item => item.title_en);
    }
  },
  cityDataMut(state, value){
    state.citiesList = value.data.map(item => item.title_en);
    state.cities = value.data;
  },
  CategoriesMut(state, value){
    state.cells = value
  }

};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
