<?php

class StateGroupsSeeder extends Seeder {

    public function run() {
        State_group::create(array('description' => 'koncept'));
        State_group::create(array('description' => 'odoslany'));
        State_group::create(array('description' => 'schvaleny'));
        State_group::create(array('description' => 'neschvaleny'));
        State_group::create(array('description' => 'publikovany'));
    }

}
