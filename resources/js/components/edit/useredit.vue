<template >
    <div class="container" v-if="userEdit!=null">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="hero-body">
                            <div class="container">
                            <h1 class="title">
                                Edit User  <span class="icon">
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
                                    <b-input v-model.trim="$v.userEdit.name.$model"  v-model="userEdit.name"></b-input>
                                </b-field>
                                <alert-vuexx message="Name is required" v-if="!$v.userEdit.name.required && submitStatus!=null"></alert-vuexx>
                                <b-field label="Email">
                                    <b-input v-model.trim="$v.userEdit.email.$model"  v-model="userEdit.email"></b-input>
                                </b-field>
                                <alert-vuexx message="Email is required" v-if="!$v.userEdit.email.required && submitStatus!=null"></alert-vuexx>
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
        let id =window.location.hash.split("edituser/")[1];
         store.dispatch('getUser',id);
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
                store.dispatch('ActionEditUser',this.userEdit);
            }else{
                this.submitStatus = 'ERROR'
            }
        }
    },
     computed:{
        ...mapState({
            userEdit:state=>state.userEdit
        })
    },
      validations:{
        userEdit:{
            email:{
                required
            },
            name:{
                required
            }
        }
    }

}
</script>
