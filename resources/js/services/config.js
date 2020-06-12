
//Configuração do axios e criando um service para ser reutilizado

import axios from 'axios';


export const http = axios.create({
baseURL:'http://localhost:8000/api'
});
