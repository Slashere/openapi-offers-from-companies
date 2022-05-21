<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new Role();
        $manager->name = 'Админ';
        $manager->slug = 'admin';
        $manager->save();

        $manager = new Role();
        $manager->name = 'Компания';
        $manager->slug = 'company';
        $manager->save();

        $developer = new Role();
        $developer->name = 'Клиент';
        $developer->slug = 'client';
        $developer->save();
    }
}
