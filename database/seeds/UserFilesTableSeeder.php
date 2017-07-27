<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Test_user_1

            // Unit info files

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 1,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 2,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 3,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 4,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

            // Assignment files

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 5,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 6,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 7,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 8,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 9,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 10,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

            // Subsection files

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 11,
            'completed' => true,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 12,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 13,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 14,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 15,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 16,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 17,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 18,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 19,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 20,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 21,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 1,
            'file_id' => 22,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Test_user_2

            // Unit info files

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 1,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 2,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 3,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 4,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

            // Assignment files

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 5,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 6,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 7,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 8,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 23,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 24,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

            // Subsection files

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 11,
            'completed' => true,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 12,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 13,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 14,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 15,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 16,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 17,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 18,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 19,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 20,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 21,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => 2,
            'file_id' => 22,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
