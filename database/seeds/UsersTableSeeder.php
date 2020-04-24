<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // reset the users table
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();

        // generate 3 users/author
        factory(User::class, 3)->create();
    }
}
