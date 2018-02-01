import Login from './views/Login.vue'
import NotFound from './views/404.vue'
import Home from './views/Home.vue'
import Users from './views/Users.vue'
import Register from './views/Register.vue'

import Index from './views/Index.vue'
import Proyecto from './views/proyecto.vue'
import DefaultView from './views/chat.vue'
import Repositorio from './views/Repositorio.vue'
import Minutas from './views/Minutas.vue'
import Requerimientos from './views/Requerimientos.vue'
import Encuestas from './views/Encuestas.vue'
import event from './views/event.vue'

let routes = [
   
    {

        path: '/login',
        component: Login,
        name: 'Login',
       
        meta: {auth: false},
    },

    {
        path: '/register',
        component: Register,
        name: 'Register'
    },

    {
        path: '/',
        redirect: '/index',
        component: Home,
        name: 'Home',
        iconCls: 'fa fa-id-card-o',
        meta: {auth: true},
    },
    {
        path: '/',
        component: Home,
        name: 'Administration',
        iconCls: 'el-icon-message',
        meta: {auth: true},
        children: [
            { path: '/users', component: Users, name: 'Users' },
            { path: '/index', component: Index, name: 'Index' },
            { path: '/panel/proyecto/:id', redirect: { name:'chat' }, component: Proyecto, name: 'Proyecto',
                children:[
                    {
                          path: '/panel/proyecto/:id/chat',
                          name: 'chat',
                          component: DefaultView
                    },
                    {
                          path: '/panel/proyecto/:id/repositorio',
                          name: 'repositorio',
                          component: Repositorio,
                          
                    },
                    {
                          path: '/panel/proyecto/:id/minutas',
                          name: 'minutas',
                          component: Minutas,
                          
                    },
                     {
                          path: '/panel/proyecto/:id/requerimientos',
                          name: 'requerimientos',
                          component: Requerimientos,
                          
                    },
                     {
                          path: '/panel/proyecto/:id/encuestas',
                          name: 'encuestas',
                          component: Encuestas,
                          
                    }
                ]
            },
        ]
    },
     {
        path: '/event',
        component:event,
        meta: {auth: false},
        name: 'Event'
    },

    {
        path: '/404',
        component: NotFound,
        name: '',
        hidden: true
    },
    {
        path: '*',
        hidden: true,
        redirect: { path: '/404' }
    }
];

export default routes;
