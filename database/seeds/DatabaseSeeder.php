<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CoursesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(AnnouncementsTableSeeder::class);
        $this->call(AssignmentsTableSeeder::class);
        $this->call(AssignmentFilesTableSeeder::class);
        $this->call(UserAssignmentsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SubsectionsTableSeeder::class);
        $this->call(FilesTableSeeder::class);
    }
}
