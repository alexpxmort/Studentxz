/*
Componente que exbibe os erros de validação no formulário
 */
<template>
    <article class="message is-warning">
        <div class="message-body">
            {{message}}
        </div>
    </article>
</template>

<script>

export default{
    mounted(){
        console.log('Component mounted');
    },
    data:()=>{
      return {

      }
    },
    props:{
        message:String
    }
}
</script>

