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
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

        DB::table('options')->insert([
       		'question_id' => '1',
            'option' => 'option1',
            'is_correct' => true,
            'description' => $description,
        ]);

        DB::table('options')->insert([
        	'question_id' => '1',
            'option' => 'option2',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
        	'question_id' => '1',
            'option' => 'option3',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '2',
            'option' => 'option1',
            'is_correct' => true,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '2',
            'option' => 'option2',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '2',
            'option' => 'option3',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '3',
            'option' => 'option1',
            'is_correct' => true,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '3',
            'option' => 'option2',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '3',
            'option' => 'option3',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '4',
            'option' => 'option1',
            'is_correct' => true,
        ]);

        DB::table('options')->insert([
            'question_id' => '4',
            'option' => 'option2',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
            'question_id' => '4',
            'option' => 'option3',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
            'question_id' => '5',
            'option' => 'option1',
            'is_correct' => true,
        ]);

        DB::table('options')->insert([
            'question_id' => '5',
            'option' => 'option2',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
            'question_id' => '5',
            'option' => 'option3',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
            'question_id' => '6',
            'option' => 'option1',
            'is_correct' => true,
        ]);

        DB::table('options')->insert([
            'question_id' => '6',
            'option' => 'option2',
            'is_correct' => false
        ]);

        DB::table('options')->insert([
            'question_id' => '6',
            'option' => 'option3',
            'is_correct' => false
        ]);
    }
}
