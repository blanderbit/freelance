// initial state

import axios from 'axios';


const state = {
  contact: null,
};


/**
 * ----- ACTIONS -----
 **/

const actions = {

  contactForm({commit}, data) {
      let  headers = {
        'Content-Type': 'application/x-www-form-urlencode',
      };
      axios
        .post('https://app.causeffect.nl/public/api/feedback_form.php', data, headers)
        .then(function (response) {
          if (response.data == 'ok') {
            commit('contactMut', true);
          }
          else {
            commit('contactMut', false);
          }

        });
    }
};


/**
 * ----- MUTATIONS -----
 * */

const mutations = {
  contactMut (state, value) {
    state.contact = value;
  }
};

export default {
  namespaced: true,
  state,
  actions,
  mutations
};
