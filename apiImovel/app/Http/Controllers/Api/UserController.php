<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Api\ApiMessages;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
       if(!$request->has('password')|| !$request->get('password')){
        $message = new ApiMessages('É nessario informar uma senha para o usuario');
       return response()->json($message->getMessage(), 401);
       }
        Validator::make($data,[
         'celular' => 'required',
        'telefone' => 'required'
         ]);
         try{
        $data['password'] = bcrypt($data['password']);
        $user = $this->user->create($data);
        $user->perfil()->create(
        [
        'telefone' => $data['telefone'],
        'celular' => $data['celular']
        ]
         );
       return response()->json([
       'data' => [
        'msg' => 'Usuário cadastrado com sucesso'
        ]
        ], 200);
        }catch(\Exception $e){
       $message = new ApiMessages($e->getMessage());
        return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
