<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('p_permission_names')->insert([
            [
                'id' => '1',
                'nome' => 'cobranca',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '2',
                'nome' => 'transferencia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '3',
                'nome' => 'ferramenta_cobexpress',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '4',
                'nome' => 'ferramenta_chargeback',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '5',
                'nome' => 'ferramenta_consultarpagamento',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '6',
                'nome' => 'ferramenta_pontomais',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '7',
                'nome' => 'ferramenta_ao3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '8',
                'nome' => 'configuracao_contas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '9',
                'nome' => 'configuracao_filais',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '10',
                'nome' => 'configuracao_empresas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '11',
                'nome' => 'configuracao_webhooks',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '12',
                'nome' => 'configuracao_usuario',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '13',
                'nome' => 'configuracao_perfil',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '14',
                'nome' => 'configuracao_logs',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}
