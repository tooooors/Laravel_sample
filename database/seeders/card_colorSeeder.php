<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class card_colorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('card_color')->insert([
            ['card_color' => 'blue'],
            ['card_color' => 'red'],
            ['card_color' => 'yellow'],
            ['card_color' => 'green'],
        ]);
    }
}
