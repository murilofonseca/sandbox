<?php

namespace Database\Seeders;

use App\Models\perfil\p_perfil;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                'id' => '1',
                'nome' => 'Admin',
                'descricao' => 'Administrativo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '2',
                'nome' => 'Operador Cobrança',
                'descricao' => 'Acesso a Cobranças (Faturas, Baixas)',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        foreach ($array as $key => $value) {
            p_perfil::create($value);
        }
    }
}
