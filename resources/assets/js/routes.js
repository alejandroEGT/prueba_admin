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
import Wiki from './views/Wiki.vue'
import Notificaciones from './views/Notificaciones.vue'
import Persona from './views/personas/persona.vue'
import Chat from './views/personas/chat.vue'

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
            { path: '/panel/proyecto/:id/', redirect: {name:'chat'}, component: Proyecto, name: 'Proyecto',
                children:[
                    {
                          path: 'chat',
                          name: 'chat',
                          component: DefaultView
                    },
                    {
                          path: 'repositorio',
                          name: 'repositorio',
                          component: Repositorio,
                          
                    },
                    {
                          path: 'minutas',
                          name: 'minutas',
                          component: Minutas,
                          
                    },
                     {
                          path: 'requerimientos',
                          name: 'requerimientos',
                          component: Requerimientos,
                          
                    },
                    {
                          path: 'encuestas',
                          name: 'encuestas',
                          component: Encuestas,
                          
                    },
                    {
                          path: 'wiki',
                          name: 'wiki',
                          component: Wiki,
                          
                    }
                    ,
                    {
                          path: '/panel/proyecto/:id/notificaciones',
                          name: 'notificaciones',
                          component: Notificaciones,
                    },
                      
                ]
            },
            {
              path: '/panel/persona/:id/', redirect:{ name:'chat-people' }, component: Persona, name:'Persona',
                children:[
                  {
                      path: 'chat',
                      name: 'chat-people',
                      component: Chat
                  }
                ]
            }
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
