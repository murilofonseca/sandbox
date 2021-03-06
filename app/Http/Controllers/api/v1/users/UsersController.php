<?php

namespace App\Http\Controllers\api\v1\users;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\perfil\p_perfil;
use App\Models\perfil\p_users;
use App\Models\User;
use App\Repositories\ResponseJsonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{

    public function __construct(User $User)
    {
        $this->model = $User;
        /**
         * Repository da resposta JSON
         */
        $this->responseJson = new ResponseJsonRepository();
        $this->rotaApi = 'users';
    }

    /**
     * Mostra os usuários
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        /**Variavel de pesquisa */
        $search = $request->search == null ? null : $request->search;
        /**Variavel paginate */
        $per_page = $request->per_page == null ? null : $request->per_page;
        /**Variavel OrderBy */
        $orderByKey = $request->orderByKey == null ? 'id' : $request->orderByKey;
        $orderByVal = $request->orderByVal == null ? 'desc' : $request->orderByVal;

        $contOrderbyKey = explode(".", $orderByKey);
        if (count($contOrderbyKey) > 1) {

            $users = $this->model->getDados->with('p_users')->orderBy('p_perfils.nome')->paginate();

        } else {
            $usuarios = $this->model->getDados($search)
                ->with('p_users')
                ->orderBy($orderByKey, $orderByVal)
                ->paginate($per_page);
        }

        //$usuarios - $usuarios->sortBy('p_perfils');
        return $this->responseJson->responseJson('success', $this->rotaApi, $usuarios, 200);


        /**Verificar se existe dados na base*/
        if ($usuarios->count() > 0) {
            return $this->responseJson->responseJson('success', $this->rotaApi, $usuarios, 200);
        } else {
            return $this->responseJson->responseJson('errors', $this->rotaApi, 'Não possui registros', 404);
        }
    }


    /**
     * Cria um usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**Validação de criação de usuário */
        $validate = new CreateNewUser();

        $dados = $request->all();
        $criarUser = $validate->create($dados);

        return $criarUser;
    }

    /**
     * Mostra usuário específico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($usuario = $this->model->with('pUsers')->find($id)) {
            return $this->responseJson->responseJson('success', $this->rotaApi, $usuario, 200);
        }

        return $this->responseJson->responseJson('errors', $this->rotaApi, "Usuário não encontrado", 404);
    }

    /**
     * Atualiza usuário específico
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $item = $this->model->find($id);

        if ($request->method() === 'PATCH') {
            /**
             * Função para executar quando o metodo for PATCH
             */
            $arrayRegrasDinamicas = array();
            foreach ($request->all() as $key => $value) {
                $data[$key] = $value;
                foreach ($this->model->rules($id) as $input => $regra) {
                    /**
                     * Percorre as regras de validação para ser aplicada apenas 
                     * a que for encontrada
                     */
                    if ($input === $key) {
                        $arrayRegrasDinamicas[$input] = $regra;
                    }
                }
                $request->validate($arrayRegrasDinamicas, $this->model->feedback());
            }
        } else {
            /**
             * Função para executar quando o metodo for PUT
             */
            $request->validate($this->model->rules($id), $this->model->feedback());
            $data = $request->all();
        }

        /**
         * Verifica se existe usuário
         */
        if (!$item)
            return $this->responseJson->responseJson('errors', $this->rotaApi, "Usuário não encontrado", 404);

        /**
         * Validação para password e current_password
         */
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
            if (!isset($data['current_password']) || !Hash::check($data['current_password'], $item->password)) {
                $response = array(
                    'current_password' => 'A senha fornecida não confere com a atual'
                );
                return $this->responseJson->responseJson('errors', $this->rotaApi, $response, 500);
            }
        }

        /**
         * Executa a atualização na Tabela users
         */
        if (!$update = $item->update($data)) {
            return $this->responseJson->responseJson('errors', $this->rotaApi, "Erro ao atualizar usuário", 500);
        }

        /**Verificação para atualização do perfil */
        if ($data['perfil'] and p_perfil::find($data['perfil'])) {
            $itemPerfil = p_users::where('user_id', $item->id)->first();
            if ($itemPerfil) {
                if (!$updatePerfil = $itemPerfil->update(['perfil_id' => $data['perfil']])) {
                    return $this->responseJson->responseJson('errors', $this->rotaApi, "Erro ao atualizar perfil", 500);
                }
            }
        } else {
            return $this->responseJson->responseJson('errors', $this->rotaApi, "Perfil não encontrado", 500);
        }

        /**Get dados usuario atualizado */
        $user = $this->model->find($item->id);
        /**Get dados perfil atualizado */
        $perfil = p_users::where('user_id', $item->id)->first();
        /**Inserir no array 'users' */
        $user['perfil_users'] = $perfil;
        return $this->responseJson->responseJson('success', $this->rotaApi, $user, 201);
    }

    /**
     * Remove Usuário específico 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        /**Deletar Perfil - Get id P_users */
        if (!$item = p_users::where('user_id', $id)->first()) {
            return $this->responseJson->responseJson('errors', $this->rotaApi, "Perfil não encontrado", 404);
        }

        /**Deletar Perfil */
        if (!$delete = $item->delete()) {
            return $this->responseJson->responseJson('errors', $this->rotaApi, "Não foi possível deletar perfil", 404);
        }

        /**Deletar usuário - Get no id do usuario */
        if (!$item = $this->model->find($id)) {
            return $this->responseJson->responseJson('errors', $this->rotaApi, "Usuário não encontrado", 404);
        }

        /**Deletar usuário */
        if (!$delete = $item->delete()) {
            return $this->responseJson->responseJson('errors', $this->rotaApi, "Não foi possível deletar usuário", 404);
        }

        /**TODOS OS DELETES FORAM EXECUTADOS */
        return $this->responseJson->responseJson('success', $this->rotaApi, "Usuário excluído", 200);
    }
}
