<template>
<section class="hero is-medium is-primary is-bold">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
       Seja bem Vindo
      </h1>
      <h2 class="subtitle">
      Ao Studentx
      </h2>
    </div>
  </div>
</section>
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

    },
    data:()=>{
      return {


      }
    }
}
</script>
