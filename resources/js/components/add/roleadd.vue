<template >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="hero-body">
                            <div class="container">
                            <h1 class="title">
                                Add Role  <span class="icon">
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
                                    <b-input v-model.trim="$v.roleAdd.name.$model"  v-model="roleAdd.name"></b-input>
                                </b-field>
                                <alert-vuexx message="Name is required" v-if="!$v.roleAdd.name.required && submitStatus!=null"></alert-vuexx>
                                <alert-vuexx message="Name is too short"  v-if="!$v.roleAdd.name.minLength && submitStatus!=null"></alert-vuexx>

                            <b-field>
                                <b-button  native-type="submit" type="is-success">Save</b-button>
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
     data(){
        return{
            roleAdd:{
                name:''
            },
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
                store.dispatch('ActionAddRole',this.roleAdd);
            }else{
                this.submitStatus = 'ERROR'
            }
        }
    },
      validations:{
        roleAdd:{
            name:{
                required,
                minLength: minLength(6)
            }
        }
    }

}
</script>
