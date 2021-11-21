<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Basic admin account for debugging
        User::createAdmin('team_origin', 'team_origin@protonmail.com', 'admin');

        // Hey! Tired of changing things every time you pull from a repository? Do this!
        // This will prevent local changes from being made into the real repository, and that is very.. very useful.
        // git update-index —assume-unchanged database/seeders/DatabaseSeeder.php
    }
}
