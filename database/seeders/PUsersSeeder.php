<?php

namespace Database\Seeders;

use App\Models\perfil\p_users;
use Illuminate\Database\Seeder;

class PUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**Seeder para usuário Victor Pefil ADMIN*/
        $array = [
            [
                'perfil_id' => '1',
                'user_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        foreach ($array as $key => $value) {
            p_users::create($value);
        }
    }
}
