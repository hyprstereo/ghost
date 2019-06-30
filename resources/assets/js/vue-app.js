import Vue from 'vue'
import router from './router';
import store from './store';
import Antd from 'ant-design-vue';
import VueMoment from 'vue-moment';
import 'ant-design-vue/dist/antd.css';
//import 'ant-design-vue/dist/antd.less';


Vue.use(Antd);
Vue.use(VueMoment);

new Vue({
  el: '#app',
  router,
  store
});