<?php

namespace App\Http\Controllers;

use App\Roles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

//Controller da api de rota de roles com seus respectivos metodos de Crud


class RolesController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request,Roles $role)
    {
        $this->request = $request;
        $this->repository = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->repository->with('users')->get();

        return compact('roles');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->repository->find($id);
        if($role ==""){
            return response()->json(['msg'=>'Role Não Encontrado'],404);
        }

        return response()->json(compact('role'),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roleData = $this->request->all();
        $role = $this->repository->find($id);
        if($role ==""){
            return response()->json(['msg'=>'Role Não Encontrado'],404);
        }

        $role =   $role->update($roleData);
        return response()->json(['Role Atualizado com Sucesso!'],204);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->repository->find($id);
        if($role ==""){
            return response()->json(['msg'=>'Role Não Encontrado'],404);
        }

        $role->delete();
        return response()->json(['msg'=>'Role Deletado com Sucesso!'],204);
    }

    public function register(){
        $role_data = $this->request->all();


        $validator =   $this->validateRole();

        if(!$validator->fails()){
            try{
                $role = $this->repository->create($role_data);
                return response()->json(compact('role'),200);
            }catch(\Exception $e){
                return response()->json(['msg'=>'Erro ao Registrar Role'],400);
              }
        }else{
            return response()->json($validator->errors(),400);
        }

    }


    public function validateRole(){
       $validate = Validator::make($this->request->all(),[
            'name'=>'required|min:6'
        ]);

        return $validate;

    }

}
