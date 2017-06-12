<?php

use Illuminate\Database\Seeder;

class ForumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forums')->insert([
       		'unit_id' => '1',
        ]);

        DB::table('forums')->insert([
        	'unit_id' => '2',
        ]);

        DB::table('forums')->insert([
        	'unit_id' => '3',
        ]);
    }
}
