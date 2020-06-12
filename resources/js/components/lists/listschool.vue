
<template>
<x-grid
        :v-if="schools!=null"
        :heroes="schools"
        :columns="gridColumns"
        :filter-key="searchQuery"
        :delFunc="deleteSchool"
        :routeTo="routeToSchool"
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
         store.dispatch('getSchools',{});
    },
    components:{
        XGrid
    },
    computed:{
         ...mapState({
            schools:state=>state.schools
        })
    },

     data:()=>{
      return    {
          path:'/addschool',
          searchQuery: "",
          gridColumns: ["name",'created_at']
        }
     },
     methods:{
         deleteSchool(entry){
               store.dispatch('deleteSchool',entry.id);
         },
        routeToSchool(entry){
                Window.router.push({
                   path:'/editschool/'+entry.id,
               })
        }
     }
}
</script>
