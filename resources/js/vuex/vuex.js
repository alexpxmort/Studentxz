
//Configuração do Vuex e suas respetivas actions
//E configuração do estado na Store

import Vue from   'vue';
import Vuex from 'vuex';
import User from '../services/users';
import Roles from '../services/roles';
import School from '../services/schools';
import * as types from '../mutations/types'
import mutations from '../mutations/mutation'
import {showError} from '../utils/httpErrors';
import {successHttp} from'../utils/successHttp';



Vue.use(Vuex);

const store = new Vuex.Store({
    state:{
        user:null,
        token:'',
        users:null,
        userEdit:null,
        roles:null,
        roleEdit:null,
        schools:null,
        schoolEdit:null,
    },
    mutations,
    actions:{
        ActionLogin(context,payload){
            return  User.login(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.SET_USER,resp.data)
                    Window.router.push('home')
                });
            }).catch(err=>{
                showError(err);
            });
        },
        ActionSignUp(context,payload){
           return User.register(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.SET_USER,resp.data),
                    Window.router.push('home')
                });
            }).catch(err=>{
              showError(err);
            });
        },
        logOutAction(context,payload){
            return  User.logout(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.LOG_OUT,resp.data)
                    Window.router.push({
                        path:'/login/'
                    });
                });
            }).catch(err=>{
                showError(err);
            });
        },
        getUsers(context,payload){
            return  User.list().then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.GET_USERS,resp.data.users)
                });
            }).catch(err=>{
                showError(err);
            });
        },
        deleteUser(context,payload){
            return  User.delete(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.DEL_USER,payload)
                });
            }).catch(err=>{
                showError(err);
            });
        },
        ActionEditUser(context,payload){
            return  User.update(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.UPDATE_USER,payload)
                    Window.router.push({
                        path:'/users/'
                    });
                });
            }).catch(err=>{
                showError(err);
            });
        },
        getUser(context,payload){
            return  User.get(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.GET_USER,resp.data)
                });
            }).catch(err=>{
                showError(err);
            });
        },
        getRoles(context,payload){
            return  Roles.list().then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.GET_ROLES,resp.data.roles)
                });
            }).catch(err=>{
                showError(err.message);
            });
        },
        deleteRole(context,payload){
            return  Roles.delete(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.DEL_ROLE,payload)
                });
            }).catch(err=>{
                showError(err.message);
            });
        },
        ActionEditRole(context,payload){
            return  Roles.update(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.UPDATE_ROLE,payload);
                    Window.router.push({
                        path:'/roles/'
                    });
                });
            }).catch(err=>{
                showError(err.message);
            });
        },
        getRole(context,payload){
            return  Roles.get(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.GET_ROLE,resp.data)
                });
            }).catch(err=>{
                showError(err.message);
            });
        },
        ActionAddRole(context,payload){
            return Roles.register(payload).then(resp=>{
                 successHttp(resp,undefined, ()=>{
                     context.commit(types.ADD_ROLE,resp.data),
                     Window.router.push({
                        path:'/roles/'
                    });
                 });
             }).catch(err=>{
               showError(err.message);
             });
         },
         getSchools(context,payload){
            return  School.list().then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.GET_SCHOOLS,resp.data.schools)
                });
            }).catch(err=>{
                showError(err.message);
            });
        },
        deleteSchool(context,payload){
            return  School.delete(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.DEL_SCHOOL,payload)
                });
            }).catch(err=>{
                showError(err.message);
            });
        },
        ActionEditSchool(context,payload){
            return  School.update(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.UPDATE_SCHOOL,payload);
                    Window.router.push({
                        path:'/schools/'
                    });
                });
            }).catch(err=>{
                showError(err.message);
            });
        },
        getSchool(context,payload){
            return  School.get(payload).then(resp=>{
                successHttp(resp,undefined, ()=>{
                    context.commit(types.GET_SCHOOL,resp.data)
                });
            }).catch(err=>{
                showError(err.message);
            });
        },
        ActionAddSchool(context,payload){
            return School.register(payload).then(resp=>{
                 successHttp(resp,undefined, ()=>{
                     context.commit(types.ADD_SCHOOL,resp.data),
                     Window.router.push({
                        path:'/schools/'
                    });
                 });
             }).catch(err=>{
               showError(err.message);
             });
         }

    }
});


export default store
