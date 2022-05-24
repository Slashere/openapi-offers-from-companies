<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientRole = Role::where('slug', 'client')->first();

        $seeOffersPermission = Permission::where('slug','see-offers')->first();
        $createOffersPermission = Permission::where('slug','create-offers')->first();
        $deleteOffersPermission = Permission::where('slug','delete-offers')->first();
        $editOffersPermission = Permission::where('slug','edit-offers')->first();
        $createCompanyPermission = Permission::where('slug','create-company')->first();
        $editCompanyPermission = Permission::where('slug','edit-company')->first();
        $deleteCompanyPermission = Permission::where('slug','delete-company')->first();

        $clientUser = new User();
        $clientUser->name = 'Пользователь' . rand(40,1000);
        $clientUser->email = 'client@guy' . rand(40,1000) .'.com';
        $clientUser->email_verified_at = Carbon::now()->toDateTimeString();
        $clientUser->password = bcrypt('secret');
        $clientUser->save();
        $clientUser->roles()->attach($clientRole);
        $clientUser->permissions()->attach($seeOffersPermission);

    }
}
