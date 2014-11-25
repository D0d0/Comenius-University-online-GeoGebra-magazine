<?php

class TagSeeder extends Seeder {
    public function run() {
        $faker = Faker\Factory::create();
        // create many tags...:
        for ($i=0; $i<500; $i++) {
            Tag::create(array(
               'id_tag' => $faker->numberBetween(1, 10),
               // not every article will have tag...:
               'id_article' => $faker->numberBetween(1, 90),
            ));
        }
    }
}
