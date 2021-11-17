<?php

namespace App\Actions\Fortify;

use App\Models\perfil\p_users;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Ramsey\Uuid\Uuid;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            'perfil' => ['required', 'integer']
        ])->validate();

        /*return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        */

        /**Criação do usuário */
        $userCreate = User::create([
            'name' => $input['name'],
            'uuid' => Uuid::uuid4(),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        if ($userCreate) {
            try {
                /**Inserir perfil na tabela p_users */
                $userPerfilCreate = p_users::create([
                    'perfil_id' => $input['perfil'],
                    'user_id' => $userCreate->id
                ]);
                $response = array(
                    "success" => [
                        "user" => $userCreate,
                        "perfil" => $userPerfilCreate
                    ]
                );
                return response()->json($response, 200);
            } catch (\Throwable $th) {
                /**Erro no delete do perfil */
                $destroyUser = User::find($userCreate->id)->delete();
                if ($destroyUser === null) {
                    $response = array(
                        "errors" => [
                            "user" => [
                                "Não foi possível deletar usuário"
                            ]
                        ]
                    );
                    return response()->json($response, 422);
                } else {
                    /**Erro na criação do usuário */
                    $response = array(
                        "errors" => [
                            "user" => [
                                "Não foi possível criar usuário"
                            ]
                        ]
                    );
                    return response()->json($response, 422);
                }
            }
        } else {
            /**Erro na criação do usuário */
            $response = array(
                "errors" => [
                    "user" => [
                        "Não foi possível criar usuário"
                    ]
                ]
            );
            return response()->json($response, 422);
        }
    }
}
