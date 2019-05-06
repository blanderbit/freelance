// initial state


import axios from "../../axios.config";

const state = {
  clickedPopUp: false,
  partPopUp: 1,
  formSend: false,
};


/**
* ----- GETTERS -----
**/

const getters = {

  getSpecialistClickedPopUp: (state) => {
      return state.clickedPopUp;
  },
  getSpecialistPartPopUp: (state) => {
      return state.partPopUp;
  }
};


/**
* ----- ACTIONS -----
**/

const actions = {
  statePopUpAct({commit,state}, data) {
    commit('statePopUpMut', data);
    if(!state.clickedPopUp){
      commit('partPopUpPopUpMut', 1);
    }
  },
  partPopUpAct({commit}, data) {
    commit('partPopUpPopUpMut', data);
  },
  specialistFormSend({commit}, data) {
    let  headers = {
      'Content-Type': 'application/x-www-form-urlencode',
    };
    console.log(data);
    axios
      .post('/public/api/send_email.php', data, headers)
      .then(function (response) {
        console.log(response);
        if (response.data == 'ok') {
          commit('formSendMut', true);
        }
        else {
          commit('formSendMut', false);
        }

      });
  }
};


/**
* ----- MUTATIONS -----
* */

const mutations = {
  statePopUpMut (state, value) {
    state.clickedPopUp = value;
  },
  partPopUpPopUpMut (state, value) {
    state.partPopUp = value;
  },
  formSendMut (state, value) {
    state.formSend = value;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
