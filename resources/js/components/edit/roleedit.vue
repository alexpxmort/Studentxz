<template >
    <div class="container" v-if="roleEdit!=null">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="hero-body">
                            <div class="container">
                            <h1 class="title">
                                Edit Role  <span class="icon">
                                 <i class="fas fa-user-plus"></i>
                                </span>
                            </h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                         <section>
                             <form  @submit.prevent="submit">
                                <b-field label="Name">
                                    <b-input v-model.trim="$v.roleEdit.name.$model"  v-model="roleEdit.name"></b-input>
                                </b-field>
                                <alert-vuexx message="Name is required" v-if="!$v.roleEdit.name.required && submitStatus!=null"></alert-vuexx>
                            <b-field>
                                <b-button  native-type="submit" type="is-success">Save Changes</b-button>
                            </b-field>
                             </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState,mapActions} from 'vuex';
import Alert from '../../components/alert';
import { required, minLength, between } from 'vuelidate/lib/validators'
import store from '../../vuex/vuex';
export default{
    components:{
        Alert
    },

    beforeMount(){
        let id =window.location.hash.split("editrole/")[1];
         store.dispatch('getRole',id);
    },
     data(){
        return{

            submitStatus: null
        }
    },
    mounted(){
        console.log('Component mounted');
    },
    methods:{
        submit() {
            this.$v.$touch()
            if (!this.$v.$invalid) {
                this.submitStatus = 'PENDING'
                store.dispatch('ActionEditRole',this.roleEdit);
            }else{
                this.submitStatus = 'ERROR'
            }
        }
    },
     computed:{
        ...mapState({
            roleEdit:state=>state.roleEdit
        })
    },
      validations:{
        roleEdit:{
            name:{
                required
            }
        }
    }

}
</script>
