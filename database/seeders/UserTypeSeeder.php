<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'user_type' => 'admin'], // record 1
            ['id' => 2, 'user_type' => 'user'], // record 2
         ];
         
        \App\Models\UserType::insert($data);
    }
}
