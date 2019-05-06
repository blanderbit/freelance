const axios = require('axios');
export const base_url = getProtocol() + '//app.causeffect.nl';
export const base_email = 'awesomejobs@causeffect.nl';
export default axios.create({
    baseURL:  'https://app.causeffect.nl',
    headers: {}
});

function getProtocol() {
  return `${location.protocol}`;
}
