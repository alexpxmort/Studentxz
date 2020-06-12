<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                         <div class="hero-body">
                            <div class="container">
                            <h1 class="title">
                                Login  <span class="icon">
                                   <i class="fas fa-lock"></i>
                                </span>
                            </h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                         <section>
                             <form @submit.prevent="submit">
                                 <b-field label="Email">
                            <b-input name="email" v-model.trim="$v.userLogin.email.$model"  v-model="userLogin.email"></b-input>
                        </b-field>
                        <alert-vuexx message="Email is required" v-if="!$v.userLogin.email.required && submitStatus!=null"></alert-vuexx>
                        <b-field label="Password">
                            <b-input name="password" v-model.trim="$v.userLogin.password.$model" v-model="userLogin.password" type="password"></b-input>
                        </b-field>
                        <alert-vuexx message="Password is required" v-if="!$v.userLogin.password.required && submitStatus!=null"></alert-vuexx>
                        <alert-vuexx message="Password is too short"  v-if="!$v.userLogin.password.minLength && submitStatus!=null"></alert-vuexx>

                            <b-field>
                                <b-button  native-type="submit" type="is-success">Login</b-button>
                            </b-field>
                            <router-link  to="/signUp">Ainda não é Cadastrado,Cadastre-se</router-link>
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
import store from '../vuex/vuex';
import Alert from '../components/alert';
import { required, minLength, between } from 'vuelidate/lib/validators'
export default{
    components:{
        Alert
    },
    data(){
        return{
            userLogin:{
                email:'',
                password:''
            },
            submitStatus: null
        }
    },
    computed:{
        ...mapState({
            user:state=>state.user
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
            store.dispatch('ActionLogin',this.userLogin);
        }else{
            this.submitStatus = 'ERROR'
        }
    }
  }
    ,
    validations:{
        userLogin:{
            email:{
                required
            },
            password:{
                required,
                 minLength: minLength(6)
            }
        }
    }
}
</script>
