<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        for($i = 0; $i < 100; $i++) {

            $post = new Post();

            // Assegno valori specifici alle colonne
            $post->title = $faker->sentence(3);
            $post->content = $faker->text(500);
            $post->slug = Str::of($post->title)->slug('-');

            // Salva il dato in tabella
            $post->save();
        }

    }
}
