require("./bootstrap");

import Vue from "vue";

import App from "./vue/app";

import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faPlusSquare,
    faTrash,
    faEdit
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import router from "./router";

//Modal
import VueModal from "@kouts/vue-modal";
import "@kouts/vue-modal/dist/vue-modal.css";

library.add(faPlusSquare, faTrash, faEdit);

Vue.component("font-awesome-icon", FontAwesomeIcon);
Vue.component("Modal", VueModal);

import { BSpinner, BTable, BToast } from "bootstrap-vue";
Vue.component("b-spinner", BSpinner);
Vue.component("b-table", BTable);
Vue.component("b-toast", BToast);

const app = new Vue({
    router,
    render: h => h(App)
}).$mount("#app");
