<?php

class UserTableSeeder extends Seeder {

    public function run() {
        $faker = Faker\Factory::create();
        $rank = User_group::create(array('description' => 'admin'));
        for ($i = 0; $i < 100; $i++) {
            $user = User::create(array(
                        'name' => $faker->lastName . ' ' . $faker->firstName,
                        'email' => $faker->email,
                        'password' => $faker->word,
                        'rank' => 1
            ));
        }
    }

}
