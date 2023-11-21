import './bootstrap';

import {createApp} from 'vue'

import app from './components/app.vue'

import router from './router/index.js'

import { library } from '@fortawesome/fontawesome-svg-core'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { faEdit } from '@fortawesome/free-solid-svg-icons'
import { faTrashCan } from '@fortawesome/free-solid-svg-icons'

library.add(faEdit)
library.add(faTrashCan)

createApp(app).component('font-awesome-icon', FontAwesomeIcon)
.use(router).mount("#app")