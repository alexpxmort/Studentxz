import {http} from './config';


export default {
    login:(data)=>http.post('/login',data),
    logout:(data)=>http.post('/logout',data),
    register:(data)=>http.post('/register',data),
    list:()=>http.get('/users'),
    delete:(id)=>http.delete("/user/"+id),
    update:(data)=>http.put("/user/"+data.id,data),
    get:(id)=>http.get("/users/"+id)
}
