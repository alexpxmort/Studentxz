<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default" v-if="roles!=null">
                    <div class="card-header">
                        <div class="hero-body">
                            <div class="container">
                            <h1 class="title" v-if="user==null">
                                SignUp  <span class="icon">
                                 <i class="fas fa-user-plus"></i>
                                </span>
                            </h1>
                               <h1 class="title" v-if="user!=null">
                                Add User  <span class="icon">
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
                                    <b-input v-model.trim="$v.userRegister.name.$model"  v-model="userRegister.name"></b-input>
                                </b-field>
                                <alert-vuexx message="Name is required" v-if="!$v.userRegister.name.required && submitStatus!=null"></alert-vuexx>

                                <b-field label="Email">
                                    <b-input v-model.trim="$v.userRegister.email.$model"  v-model="userRegister.email"></b-input>
                                </b-field>
                                <alert-vuexx message="Email is required" v-if="!$v.userRegister.email.required && submitStatus!=null"></alert-vuexx>
                            <b-field label="Password">
                                <b-input v-model.trim="$v.userRegister.password.$model"  v-model="userRegister.password" type="password"></b-input>
                            </b-field>
                            <alert-vuexx message="Password is required" v-if="!$v.userRegister.password.required && submitStatus!=null"></alert-vuexx>
                            <alert-vuexx message="Password is too short"  v-if="!$v.userRegister.password.minLength && submitStatus!=null"></alert-vuexx>

                             <b-field>
                                    <b-select name="selectedRole" v-model="selectedRole"  v-model.trim="$v.selectedRole.$model" >
                                        <option value="">Selecione Um Role</option>
                                        <option v-for="role in roles" v-bind:value="role.id" v-bind:key="role.id">
                                            {{role.name}}
                                        </option>
                                    </b-select>
                            </b-field>
                            <alert-vuexx message="Role is required" v-if="!$v.selectedRole.required && submitStatus!=null"></alert-vuexx>

                            <b-field>
                                <b-button  native-type="submit" type="is-success">SignUp</b-button>
                            </b-field>
                            <router-link v-if="user==null" to="/login">Já é Cadastrado,Logar</router-link>
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
import User from '../services/users';
import Alert from '../components/alert';
import { required, minLength, between } from 'vuelidate/lib/validators'
import store from '../vuex/vuex';

export default{
    beforeMount(){
        store.dispatch('getRoles',{});
    },
    components:{
        Alert
    },
     data(){
        return{
            userRegister:{
                email:'',
                password:'',
                name:''
            },
             submitStatus: null,
             selectedRole:""
        }
    },
    computed:{
        ...mapState({
            user:state=>state.user,
            roles:state=>state.roles
        })
    },
    mounted(){
        console.log('Component mounted');
    },
    methods:{
        submit() {
            this.$v.$touch()
            if (!this.$v.$invalid) {
                this.submitStatus = 'PENDING'
                if(!!this.selectedRole){
                    this.userRegister['role_id'] = this.selectedRole;
                }
                store.dispatch('ActionSignUp',this.userRegister);
            }else{
                this.submitStatus = 'ERROR'
            }
        }
    },
      validations:{
        userRegister:{
            email:{
                required
            },
            password:{
                required,
                 minLength: minLength(6)
            },
            name:{
                required
            },
        },
        selectedRole:{
                required
            }
    }

}
</script>
