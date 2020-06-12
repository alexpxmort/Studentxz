import * as types from './types';


//Mutations que mudam o estado da store no Vuex
export default{
    [types.SET_USER](state,payload){
        state.user = payload;
        console.log(state.user);
    },
    [types.LOG_OUT](state,payload){
        state.user = null;
    },
    [types.GET_USERS](state,payload){
        state.users = payload;
    },

    [types.DEL_USER](state,payload){
      if(!!state){
        state.users = state.users.filter((val)=>{
            return val.id!=payload;
        });
      }
    },

    [types.GET_USER](state,payload){
        state.userEdit = payload.user;
    },
    [types.UPDATE_USER](state,payload){
         if(!!state.users){
            state.users.forEach((val)=>{
                if(val.id == payload.id){
                    val = payload;
                }
             });
         }
    },
    [types.GET_ROLES](state,payload){
        state.roles = payload;
    },
    [types.DEL_ROLE](state,payload){
       if(!!state.roles){
        state.roles = state.roles.filter((val)=>{
            return val.id!=payload;
        });
       }
    },
    [types.GET_ROLE](state,payload){
        state.roleEdit = payload.role;
    },
    [types.UPDATE_ROLE](state,payload){
         if(!!state.roles){
            state.roles.forEach((val)=>{
                if(val.id == payload.id){
                    val = payload;
                }
             });
         }
    },
    [types.ADD_ROLE](state,payload){
        state.roles[state.roles.length+1]=payload;
   },

[types.GET_SCHOOLS](state,payload){
    state.schools = payload;
},
[types.DEL_SCHOOL](state,payload){

    if(!!state.schools){
        state.schools = state.schools.filter((val)=>{
            return val.id!=payload;
        });
    }
},
[types.GET_SCHOOL](state,payload){
    state.schoolEdit = payload.school;
},
[types.UPDATE_SCHOOL](state,payload){
    if(!!state.schools){
        state.schools.forEach((val)=>{
            if(val.id == payload.id){
                val = payload;
            }
         });
    }
},
[types.ADD_SCHOOL](state,payload){
  if(!!state.schools){
    state.schools[state.schools.length+1]=payload;
  }
},


}
