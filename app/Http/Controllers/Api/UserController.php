<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Roles;
use App\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Controller da api de rota de usuários com seus respectivos metodos de Crud

class UserController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request,User $user,Roles $role)
    {
        $this->request = $request;
        $this->repository = $user;
        $this->relRepo = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $expiration = 60;
        $key = 'user_';

        $users = $this->repository->with('roles')->get();

        return compact('users');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);
        if($user ==""){
            return response()->json(['msg'=>'Usuário Não Encontrado'],404);
        }

        return response()->json(compact('user'),200);
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
        $userData = $this->request->all();
        $user = $this->repository->find($id);
        if($user ==""){
            return response()->json(['msg'=>'Usuário Não Encontrado'],404);
        }

        $user =   $user->update($userData);
        return response()->json(['Usuário Atualizado com Sucesso!'],204);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->repository->find($id);
        if($user ==""){
            return response()->json(['msg'=>'Usuário Não Encontrado'],404);
        }

        $user->delete();
        return response()->json(['msg'=>'Usuário Deletado com Sucesso!'],204);
    }

    public function register($role = null ){
        $user_data = $this->request->all();

        $user_data['password'] = Hash::make($user_data['password']);

        if(isset($user_data['role_id'])){
            $role = $user_data['role_id'];
        }

        $validator =   $this->validateUser();

        if(!$validator->fails()){
            try{
                $user = $this->repository->create($user_data);

                $alunoRole = ($role==null)? $this->relRepo->where('name','Aluno',['id'])->first()
                :$this->relRepo->where('id',$role,['id'])->first();
                $user->roles()->attach($alunoRole);

                return response()->json(['user'=>$user],200);
            }catch(\Exception $e){
                return response()->json(['msg'=>'Erro ao Registrar'],400);
              }
        }else{
            return response()->json($validator->errors(),400);
        }

    }

    public function login(){

          $validator =   $this->validateUser();

            if(!$validator->fails()){
                $credentials = $this->request->only('email', 'password');

                if(Auth::attempt($credentials)){
                    $user = $this->repository->where('email',$credentials['email'])->first();

                    return response()->json(['user'=>$user],202);
                }else{
                    return response()->json(['msg'=>'Erro ao logar'],400);
                }
            }else{
                return response()->json($validator->errors(),400);
            }
    }

    public function validateUser(){
       $validate = Validator::make($this->request->all(),[
            'email'=>'required|email',
            'password'=>'required|alphaNum|min:3'
        ]);

        return $validate;

    }

    public function logout(){
        Auth::logout();
    }

}
