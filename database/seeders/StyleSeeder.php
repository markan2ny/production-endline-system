<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('styles')
                ->insert([
                    ['author_id' => 1, 'style_code' => 'WN012345672AC', 'quota' => 5000],
                    ['author_id' => 1, 'style_code' => 'WN012345678RM', 'quota' => 5000],
                    ['author_id' => 1, 'style_code' => 'WN012345678AD', 'quota' => 5000],
                    ['author_id' => 1, 'style_code' => 'WN012345678NZ', 'quota' => 5000],
                ]);
    }
}
