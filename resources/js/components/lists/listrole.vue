
<template>
<x-grid
        :v-if="roles!=null"
        :heroes="roles"
        :columns="gridColumns"
        :filter-key="searchQuery"
        :delFunc="deleteRole"
        :routeTo="routeToRole"
        :pathProp="path"
      >
</x-grid>
</template>



<script>
import {mapState,mapActions} from 'vuex';
import XGrid from '../grids/xgrid';
import store from '../../vuex/vuex';

export default{

    beforeMount(){
         store.dispatch('getRoles',{});
    },
    components:{
        XGrid
    },
    computed:{
         ...mapState({
            roles:state=>state.roles
        })
    },

     data:()=>{
      return    {
          path:'/addrole',
          searchQuery: "",
          gridColumns: ["name",'created_at']
        }
     },
     methods:{
         deleteRole(entry){
               store.dispatch('deleteRole',entry.id);
         },
        routeToRole(entry){
                Window.router.push({
                   path:'/editrole/'+entry.id,
               })
        }
     }
}
</script>
