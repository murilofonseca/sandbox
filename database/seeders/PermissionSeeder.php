<?php

namespace Database\Seeders;

use App\Models\perfil\p_permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            /**Permissão Configurações -> Usuários */
            [
                'id' => '1',
                'permission_name_id' => '12',
                'descricao' => 'Criar',
                'action' => 'store',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '2',
                'permission_name_id' => '12',
                'descricao' => 'Visualizar',
                'action' => 'show',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '3',
                'permission_name_id' => '12',
                'descricao' => 'Exibir',
                'action' => 'index',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '4',
                'permission_name_id' => '12',
                'descricao' => 'Alterar',
                'action' => 'update',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '5',
                'permission_name_id' => '12',
                'descricao' => 'Deletar',
                'action' => 'destroy',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ];
        foreach ($array as $key => $value) {
            p_permission::create($value);
        }
    }
}
