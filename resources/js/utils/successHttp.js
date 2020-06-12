//Função que Controla se a requisição foi com Sucesso e executa uma ação e exibe
//Uma mensagem caso ela seja passada como paramêtro


export const successHttp =(resp,message,func)=>{
    if(resp.status == 202 || resp.status == 200 || resp.status ==204){
        if(!!message){
            alert(message);
        }

        if(!!func){
            func();
        }
    }
}
