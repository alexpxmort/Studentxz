<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


//Controller da api de rota de schools com seus respectivos metodos de Crud

class SchoolController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request,School $school)
    {
        $this->request = $request;
        $this->repository = $school;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = $this->repository->with('users')->get();

        return compact('schools');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $school = $this->repository->find($id);
        if($school ==""){
            return response()->json(['msg'=>'Escola Não Encontrada'],404);
        }

        return response()->json(compact('school'),200);
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
        $schoolData = $this->request->all();
        $school = $this->repository->find($id);
        if($school ==""){
            return response()->json(['msg'=>'Escola Não Encontrada'],404);
        }

        $school =   $school->update($schoolData);
        return response()->json(['Escola Atualizado com Sucesso!'],204);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = $this->repository->find($id);
        if($school ==""){
            return response()->json(['msg'=>'Escola Não Encontrada'],404);
        }

        $school->delete();
        return response()->json(['msg'=>'Escola Deletada com Sucesso!'],204);
    }

    public function register(){
        $school_data = $this->request->all();


        $validator =   $this->validateRole();

        if(!$validator->fails()){
            try{
                $school = $this->repository->create($school_data);
                return response()->json(compact('school'),200);
            }catch(\Exception $e){
                return response()->json(['msg'=>'Erro ao Registrar Escola'],400);
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
