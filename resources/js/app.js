window._ = require("lodash");
window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import Chart from "chart.js";
import InstantSearch from "./components/InstantSearch.vue";
import { createApp } from "vue";

createApp({
    components: {
        InstantSearch,
    },
}).mount("#app");
