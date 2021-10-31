<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'admin', 'email' => 'admin@gmail.com', 'password' => '$2y$10$1dYHbh2lsdpuMJiP8aFg7eyd2fjceeC6mfaqapgLrBYS3xT8qqGVO', 'u_tp_id' => '1'], // record 1
            ['id' => 2, 'name' => 'test1', 'email' => 'test1@gmail.com', 'password' => '$2y$10$1dYHbh2lsdpuMJiP8aFg7eyd2fjceeC6mfaqapgLrBYS3xT8qqGVO', 'u_tp_id' => '2'], // record 1
            ['id' => 3, 'name' => 'test2', 'email' => 'test2@gmail.com', 'password' => '$2y$10$1dYHbh2lsdpuMJiP8aFg7eyd2fjceeC6mfaqapgLrBYS3xT8qqGVO', 'u_tp_id' => '2'], // record 1
         ];


         
        \App\Models\User::insert($data);
    }
}
