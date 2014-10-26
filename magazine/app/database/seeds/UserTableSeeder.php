<?php

class UserTableSeeder extends Seeder {

    public function run() {
        $faker = Faker\Factory::create();
        $rank = User_group::create(array('description' => 'admin'));
        $rank = User_group::create(array('description' => 'redakcna rada'));
        $rank = User_group::create(array('description' => 'recenzent'));
        $rank = User_group::create(array('description' => 'uzivatel'));
        for ($i = 0; $i < 100; $i++) {
            $user = User::create(array(
                'name' => $faker->lastName . ' ' . $faker->firstName,
                'email' => $faker->email,
                'password' => Hash::make($faker->word),
                'rank' => 1
            ));
        }
    }

}
