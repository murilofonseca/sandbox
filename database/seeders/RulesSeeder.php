<?php

namespace Database\Seeders;

use App\Models\perfil\p_rules;
use Illuminate\Database\Seeder;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            /**Regras das permissões do Perfil ADMIN */
            [   
                'id' => '1',
                'perfil_id' => '1',
                'permission_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'id' => '2',
                'perfil_id' => '1',
                'permission_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'id' => '3',
                'perfil_id' => '1',
                'permission_id' => '3',
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'id' => '4',
                'perfil_id' => '1',
                'permission_id' => '4',
                'created_at' => now(),
                'updated_at' => now()
                
            ],
            [
                'id' => '5',
                'perfil_id' => '1',
                'permission_id' => '5',
                'created_at' => now(),
                'updated_at' => now()
                
            ]
        ];
        foreach ($array as $key => $value) {
            p_rules::create($value);
        }
    }
}
