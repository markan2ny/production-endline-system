<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            ['name' => 'Administrator', 'email' => 'admin@app.com', 'password' => Hash::make('password'), 'created_at' => Carbon::now(),],
        ]);

        DB::update('UPDATE users SET isAdmin = 1 WHERE id = 1');
    }
}
    