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
        $this->call(UserAssignmentsTableSeeder::class);
        $this->call(ForumsTableSeeder::class);
        $this->call(ThreadsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SubsectionsTableSeeder::class);
        $this->call(SubsectionFilesTableSeeder::class);
        $this->call(UserSubsectionFilesTableSeeder::class);
        $this->call(FilesTableSeeder::class);
        $this->call(UserFilesTableSeeder::class);
        $this->call(QuizzesTableSeeder::class);
        $this->call(UserQuizzesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(UserQuestionsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
    }
}
