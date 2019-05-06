// initial state

import axios from 'axios';


const state = {
  authenticated: false,
}

/**
 * ----- ACTIONS -----
 **/

const actions = {

  checkoutLog ({ commit }, data) {
    let  headers = {
      'Content-Type': 'application/x-www-form-urlencode',
    };
    console.log('----------------',data);
    axios
      .post('https://app.causeffect.nl/public/api/user_create.php', data, headers)
      .then(function (response) {
        if (response.data == 'ok') {
          commit('login', true);
        }
        else {
          commit('login', false);
        }

      });
  },
};


/**
 * ----- MUTATIONS -----
 * */

const mutations = {
  login (state, data) {
    state.authenticated = data;
  }
};

export default {
  namespaced: true,
  state,
  actions,
  mutations
}
