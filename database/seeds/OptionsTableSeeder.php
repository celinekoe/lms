<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
       		'question_id' => '1',
            'option' => 'option1',
            'is_correct' => true
        ]);

        DB::table('options')->insert([
        	'question_id' => '1',
            'option' => 'option2',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
        	'question_id' => '1',
            'option' => 'option3',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
            'question_id' => '2',
            'option' => 'option1',
            'is_correct' => true
        ]);

        DB::table('options')->insert([
            'question_id' => '2',
            'option' => 'option2',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
            'question_id' => '2',
            'option' => 'option3',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
            'question_id' => '3',
            'option' => 'option1',
            'is_correct' => true
        ]);

        DB::table('options')->insert([
            'question_id' => '3',
            'option' => 'option2',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
            'question_id' => '3',
            'option' => 'option3',
            'is_correct' => false
        ]);
    }
}
