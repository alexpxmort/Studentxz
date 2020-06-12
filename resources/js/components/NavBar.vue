<template>

<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="#">
      <img src="../../imgs/folha.png" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">

      <router-link class="navbar-item"  to="/home"  v-if="user!=null">
         Home
      </router-link>
       <router-link class="navbar-item"  to="/signUp"  v-if="user==null">
         Cadastre-se
      </router-link>
       <router-link class="navbar-item"  to="/users" v-if="user!=null">
         Users
      </router-link>
       <router-link class="navbar-item"  to="/schools" v-if="user!=null">
         Schools
      </router-link>
      <router-link class="navbar-item"  to="/roles"  v-if="user!=null">
         Roles
      </router-link>
      <router-link class="navbar-item"    v-for="item in items" :key="item.key"  v-bind:to="item.path">
         {{ item.name }}
      </router-link>
       <a class="navbar-item" v-if="user!=null">
           <span class="icon">
                <i class="fas fa-user"></i>
            </span> {{user.user.email}}
        </a>
       <a class="navbar-item" v-if="user!=null" @click="logOut()">
        LogOut
      </a>
    </div>
  </div>
</nav>
</template>

<script>
import {mapState,mapActions} from 'vuex';
import store from '../vuex/vuex';

export default{
    mounted(){
        console.log('Component mounted');
    },
    computed:{
        ...mapState({
            user:state=>state.user
        })
    },
    methods:{
       logOut(){
             store.dispatch('logOutAction',{});
       }
    },
    data:()=>{
      return {
            items: [
        ]
      }
    }
}
</script>
