<?php

use Illuminate\Database\Seeder;

class UsersRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users_role')->insert([
            'description' => 'administrador'
        ]);
        DB::table('users_role')->insert([
            'description' => 'customer'
        ]);
    }
}
