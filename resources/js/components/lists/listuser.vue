
<template>
<x-grid
        :v-if="users!=null"
        :heroes="users"
        :columns="gridColumns"
        :filter-key="searchQuery"
         :delFunc="deleteUser"
         :routeTo="routeToUser"
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
         store.dispatch('getUsers',{});
    },
    components:{
        XGrid
    },
    computed:{
         ...mapState({
            users:state=>state.users
        })
    },

     data:()=>{
      return    {
           path:'/signup',
          searchQuery: "",
          gridColumns: ["name", "email",'created_at']
        }
     },
       methods:{
         deleteUser(entry){
               store.dispatch('deleteUser',entry.id);
         },
         routeToUser(entry){
               Window.router.push({
                   path:'/edituser/'+entry.id,
               })
         }
     }


}
</script>
