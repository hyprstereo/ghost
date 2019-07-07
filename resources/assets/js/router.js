import Vue from 'vue';
import VueRouter from 'vue-router';

import Main from './components/Main';
import Home from './components/views/Home';
import Login from './components/views/auth/Login';

/* investigations */
import Investigations from './components/views/investigations';
import InvestigationEntry from './components/views/investigations/InvestigationEntry';
import InvestigationList from './components/views/investigations/InvestigationList';
import InvestigationEdit from './components/views/investigations/InvestigationEdit';

/* users */
import Users from './components/views/Users';

/* settings */
import Settings from './components/views/Settings';

Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'main',
            component: Main,
            children: [
                {
                    path: '',
                    name: 'home',
                    component: Home
                },
                {
                    path: 'login',
                    name: 'login',
                    component: Login,
                },

                        {
                            path: 'case/:id',
                            name: 'investigation_edit',
                            component: InvestigationEdit
                        },
                {
                    path: 'investigation',
                    name: 'investigation',
                    component: Investigations,
                    children: [
                        {
                            path: '',
                            name: 'investigation_list',
                            component: InvestigationList
                        },
                        {
                            path: 'entry',
                            name: 'investigation_entry',
                            component: InvestigationEntry
                        }
                    ]
                },
                {
                    path: 'users',
                    name: 'users',
                    component: Users
                },
                {
                    path: 'settings',
                    name: 'settings',
                    component: Settings
                }
            ]
        }
    ]
});

export default router;