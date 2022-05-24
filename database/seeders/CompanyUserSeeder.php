<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CompanyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyRole = Role::where('slug', 'company')->first();

        $seeOffersPermission = Permission::where('slug','see-offers')->first();
        $createOffersPermission = Permission::where('slug','create-offers')->first();
        $deleteOffersPermission = Permission::where('slug','delete-offers')->first();
        $editOffersPermission = Permission::where('slug','edit-offers')->first();
        $createCompanyPermission = Permission::where('slug','create-company')->first();
        $editCompanyPermission = Permission::where('slug','edit-company')->first();
        $deleteCompanyPermission = Permission::where('slug','delete-company')->first();

        $companyUser = new User();
        $companyUser->name = 'Пользователь' . rand(40,1000);
        $companyUser->email = 'company@guy' . rand(40,1000) .'.com';
        $companyUser->email_verified_at = Carbon::now()->toDateTimeString();
        $companyUser->password = bcrypt('secret');
        $companyUser->save();
        $companyUser->roles()->attach($companyRole);
        $companyUser->permissions()->attach($createOffersPermission);
        $companyUser->permissions()->attach($deleteOffersPermission);
        $companyUser->permissions()->attach($editOffersPermission);
        $companyUser->permissions()->attach($createCompanyPermission);
        $companyUser->permissions()->attach($editCompanyPermission);
        $companyUser->permissions()->attach($deleteCompanyPermission);

    }
}
