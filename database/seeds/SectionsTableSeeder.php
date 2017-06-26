<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section_introduction = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

        $section_guidelines = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

        $section_learning_outcomes = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

        $section_resources = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';


        DB::table('sections')->insert([
       		'unit_id' => '1',
            'name' => 'Section1',
            'introduction' => $section_introduction,
            'guidelines' => $section_guidelines,
            'learning_outcomes' => $section_learning_outcomes,
            'resources' => $section_resources,
        ]);

        DB::table('sections')->insert([
        	'unit_id' => '1',
            'name' => 'Section2',
            'introduction' => $section_introduction,
            'guidelines' => $section_guidelines,
            'learning_outcomes' => $section_learning_outcomes,
            'resources' => $section_resources,
        ]);

        DB::table('sections')->insert([
        	'unit_id' => '1',
            'name' => 'Section3',
            'introduction' => $section_introduction,
            'guidelines' => $section_guidelines,
            'learning_outcomes' => $section_learning_outcomes,
            'resources' => $section_resources,
        ]);
    }
}
