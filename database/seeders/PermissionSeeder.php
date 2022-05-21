<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeOffers = new Permission();
        $seeOffers->name = 'Can see Offers';
        $seeOffers->slug = 'see-offers';
        $seeOffers->save();

        $createOffers = new Permission();
        $createOffers->name = 'Can create Offers';
        $createOffers->slug = 'create-offers';
        $createOffers->save();

        $deleteOffers = new Permission();
        $deleteOffers->name = 'Can delete offers';
        $deleteOffers->slug = 'delete-offers';
        $deleteOffers->save();

        $editOffers = new Permission();
        $editOffers->name = 'Can edit offers';
        $editOffers->slug = 'edit-offers';
        $editOffers->save();

        $createCompany = new Permission();
        $createCompany->name = 'Can create company';
        $createCompany->slug = 'create-company';
        $createCompany->save();

        $editCompany = new Permission();
        $editCompany->name = 'Can edit offers';
        $editCompany->slug = 'edit-company';
        $editCompany->save();

        $deleteCompany = new Permission();
        $deleteCompany->name = 'Can delete company';
        $deleteCompany->slug = 'delete-company';
        $deleteCompany->save();
    }
}
