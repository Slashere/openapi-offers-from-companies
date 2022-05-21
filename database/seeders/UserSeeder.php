<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug','admin')->first();
        $companyRole = Role::where('slug', 'company')->first();
        $clientRole = Role::where('slug', 'client')->first();

        $seeOffersPermission = Permission::where('slug','see-offers')->first();
        $createOffersPermission = Permission::where('slug','create-offers')->first();
        $deleteOffersPermission = Permission::where('slug','delete-offers')->first();
        $editOffersPermission = Permission::where('slug','edit-offers')->first();
        $createCompanyPermission = Permission::where('slug','create-company')->first();
        $editCompanyPermission = Permission::where('slug','edit-company')->first();
        $deleteCompanyPermission = Permission::where('slug','delete-company')->first();

        $adminUser = new User();
        $adminUser->name = 'Администратор';
        $adminUser->email = 'admin@admin.com';
        $adminUser->email_verified_at = Carbon::now()->toDateTimeString();
        $adminUser->password = bcrypt('secret');
        $adminUser->save();
        $adminUser->roles()->attach($adminRole);
        $adminUser->permissions()->attach($seeOffersPermission);
        $adminUser->permissions()->attach($createOffersPermission);
        $adminUser->permissions()->attach($deleteOffersPermission);
        $adminUser->permissions()->attach($editOffersPermission);
        $adminUser->permissions()->attach($createCompanyPermission);
        $adminUser->permissions()->attach($editCompanyPermission);
        $adminUser->permissions()->attach($deleteCompanyPermission);


        $companyUser = new User();
        $companyUser->name = 'Компания 1';
        $companyUser->email = 'company@guy.com';
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


        $clientUser = new User();
        $clientUser->name = 'Клиент 1';
        $clientUser->email = 'client@guy.com';
        $clientUser->email_verified_at = Carbon::now()->toDateTimeString();
        $clientUser->password = bcrypt('secret');
        $clientUser->save();
        $clientUser->roles()->attach($clientRole);
        $clientUser->permissions()->attach($seeOffersPermission);
    }
}
