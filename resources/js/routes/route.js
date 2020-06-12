

//Rotas que controlam a navegação pela aplicação


import SignUp  from '../components/SignUpComponent.vue';
import Login from '../components/LoginComponent.vue';
import Home from '../components/HomeComponent.vue';
import ListUser from '../components/lists/listuser.vue';
import EditUser from '../components/edit/useredit.vue';

import ListRoles from '../components/lists/listrole.vue';
import EditRole from '../components/edit/roleedit.vue';
import AddRole from '../components/add/roleadd.vue';


import ListSchools from '../components/lists/listschool.vue';
import EditSchool from '../components/edit/schooledit.vue';
import AddSchool from '../components/add/addschool.vue';

const routes = [

    {
        path: "/",
        redirect: "/login"
    },
    {
        name:'signUp',
        path:'/signUp',
        component:SignUp,
    },{
        name:'login',
        path:'/login',
        component:Login,
    },
    {
        name:'home',
        path:'/home',
        component:Home,
    },
    {
        name:'users',
        path:'/users',
        component:ListUser,
    },
    {
        name:'edituser',
        path:'/edituser/:id?',
        component:EditUser,
    },
    {
        name:'roles',
        path:'/roles',
        component:ListRoles,
    },
    {
        name:'editrole',
        path:'/editrole/:id?',
        component:EditRole,
    },
    {
        name:'addrole',
        path:'/addrole',
        component:AddRole,
    },

    //
    {
        name:'schools',
        path:'/schools',
        component:ListSchools,
    },
    {
        name:'editschool',
        path:'/editschool/:id?',
        component:EditSchool,
    },
    {
        name:'addschool',
        path:'/addschool',
        component:AddSchool,
    }
]


export default routes;
