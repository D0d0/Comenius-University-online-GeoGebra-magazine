<?php

class UserTableSeeder extends Seeder {

    public function run() {
        $faker = Faker\Factory::create();
        User_group::create(array('description' => 'admin'));
        User_group::create(array('description' => 'redakcna rada'));
        User_group::create(array('description' => 'recenzent'));
        User_group::create(array('description' => 'uzivatel'));
        for ($i = 0; $i < 100; $i++) {
            User::create(array(
                'name' => $faker->lastName . ' ' . $faker->firstName,
                'email' => $faker->email,
                'password' => Hash::make($faker->word),
                'city' => $faker->city,
                'rank' => $faker->numberBetween(1, 4),
                'facebook' => $faker->lastName . ' ' . $faker->firstName,
                'school' => $faker->address,
                'birth' => $faker->dateTimeThisCentury,
                'rank' => 1
            ));
        }
    }

}
