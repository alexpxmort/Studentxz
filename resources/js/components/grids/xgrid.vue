/*
Componente de grid que cria uma tabela de acordo com as
propriedades passadas para ela
 */


<template>
<div>
    <router-link class="icon" v-bind:to="pathProp">
        <i class="fas fa-plus"></i>
        Add
    </router-link>

<table>
        <thead>
          <tr>
            <th v-for="key in columns"
            v-bind:key="key"
              @click="sortBy(key)"
              :class="{ active: sortKey == key }">
              {{ key | capitalize }}
              <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
              </span>
            </th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="entry in filteredHeroes"  v-bind:key="entry.id" >
            <td v-for="key in columns" :key="key">
              {{entry[key]}}
            </td>
            <td>
                <span class="icon" @click="routeTo(entry)">
                    <i class="fas fa-edit"></i>
                </span>
            </td>
             <td>
                <span class="icon" @click="delFunc(entry)">
                    <i class="fas fa-trash"></i>
                </span>
            </td>
          </tr>
        </tbody>
      </table>
</div>
</template>

<script>
import {mapState,mapActions} from 'vuex';
export default{
    components:{

    },
     computed: {
          filteredHeroes: function() {
            var sortKey = this.sortKey;
            var filterKey = this.filterKey && this.filterKey.toLowerCase();
            var order = this.sortOrders[sortKey] || 1;
            var heroes = this.heroes;
            if (filterKey) {
              heroes = heroes.filter(function(row) {
                return Object.keys(row).some(function(key) {
                  return (
                    String(row[key])
                      .toLowerCase()
                      .indexOf(filterKey) > -1
                  );
                });
              });
            }
            if (sortKey) {
              heroes = heroes.slice().sort(function(a, b) {
                a = a[sortKey];
                b = b[sortKey];
                return (a === b ? 0 : a > b ? 1 : -1) * order;
              });
            }
            return heroes;
          }
        },
    mounted(){
        console.log('Component mounted');
    },
    methods:{

    },
    props: {
          heroes: Array,
          columns: Array,
          filterKey: String,
          delFunc:Function,
          routeTo:Function,
          pathProp:String
    },
    data: function() {
        var sortOrders = {};
        this.columns.forEach(function(key) {
        sortOrders[key] = 1;
        });
        return {
        sortKey: "",
        sortOrders: sortOrders
        };
    },
    filters: {
          capitalize: function(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
          }
    },
    methods: {
          sortBy: function(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
          }
    }
}
</script>
<style scoped>
body {
    font-family: Helvetica Neue, Arial, sans-serif;
    font-size: 14px;
    color: #444;
  }

  table {
    border: 2px solid #42b983;
    border-radius: 3px;
    background-color: #fff;
  }

  th {
    background-color: #42b983;
    color: rgba(255, 255, 255, 0.66);
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  td {
    background-color: #f9f9f9;
  }

  th,
  td {
    min-width: 120px;
    padding: 10px 20px;
  }

  th.active {
    color: #fff;
  }

  th.active .arrow {
    opacity: 1;
  }

  .arrow {
    display: inline-block;
    vertical-align: middle;
    width: 0;
    height: 0;
    margin-left: 5px;
    opacity: 0.66;
  }

  .arrow.asc {
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-bottom: 4px solid #fff;
  }

  .arrow.dsc {
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 4px solid #fff;
  }
</style>
