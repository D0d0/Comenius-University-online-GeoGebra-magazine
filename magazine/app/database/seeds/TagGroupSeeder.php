<?php

class TagGroupSeeder extends Seeder {
    public function run() {
        $faker = Faker\Factory::create();
        for ($i=0; $i<10; $i++) {
            Tag_group::create(array(
               'name' => $faker->realText($faker->numberBetween(10,30)), 
               'count' => $faker->numberBetween(1,10),
            ));
        }
    }
}
