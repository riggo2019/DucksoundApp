<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('songs')->insert([
                'song_name' => $faker->sentence(3),
                'nation' => $faker->numberBetween(0,1),
                'lyrics' => $faker->paragraph,
                'song_image' => $faker->lexify('??????.jpg'),
                'song_file' => $faker->lexify('??????.mp3'),
                'type_id' => $faker->numberBetween(1, 5),
                'singer_id' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
