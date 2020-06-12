import {http} from './config';


export default {
    register:(data)=>http.post('schools/register',data),
    list:()=>http.get('/schools'),
    delete:(id)=>http.delete("/school/"+id),
    update:(data)=>http.put("/school/"+data.id,data),
    get:(id)=>http.get("/schools/"+id)
}
