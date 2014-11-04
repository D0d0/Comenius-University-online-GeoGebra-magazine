<?php

class ArticleTableSeeder extends Seeder {

    public function run() {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            Article::create(array(
                'user_id' => $faker->numberBetween(1, 100),
                'state' => $faker->numberBetween(1, 5),
                'title' => $faker->realText($faker->numberBetween(10, 30)),
                'abstract' => $faker->realText($faker->numberBetween(200, 250)),
                'text' => $faker->realText($faker->numberBetween(1000, 1500)),
            ));
        }
    }

}
