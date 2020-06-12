//Função que Controla os erros em requisições e os mostra na tela


import swal from 'sweetalert';


export const showError =(err)=>{

  var message = err.response.data;
  var status = err.response.status;

   if(status == 400 || status ==404){
    swal("Status:"+status.toString(), JSON.stringify(message));
   }else if(status == 500){
    swal("Status", "Estamos com problemas no Servidor! tente novamente mais tarde!");
   }

}
