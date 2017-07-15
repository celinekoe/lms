<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit_info = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

       	DB::table('units')->insert([
       		'course_id' => '1',
            'unit_code' => 'UC1',
            'name' => 'Unit1',
            'unit_term' => 'TJA',
            'unit_year' => '2017',
            'info' => $unit_info,
        ]);

        DB::table('units')->insert([
        	'course_id' => '1',
            'unit_code' => 'UC2',
            'name' => 'Unit2',
            'unit_term' => 'TJA',
            'unit_year' => '2017',
            'info' => $unit_info,
        ]);

        DB::table('units')->insert([
        	'course_id' => '1',
            'unit_code' => 'UC3',
            'name' => 'Unit3',
            'unit_term' => 'TJA',
            'unit_year' => '2017',
            'info' => $unit_info,
        ]);
    }
}
