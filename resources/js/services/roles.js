import {http} from './config';


export default {
    register:(data)=>http.post('roles/register',data),
    list:()=>http.get('/roles'),
    delete:(id)=>http.delete("/role/"+id),
    update:(data)=>http.put("/role/"+data.id,data),
    get:(id)=>http.get("/roles/"+id)
}
