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

        $viewAnyOfferPermission = Permission::where('slug','view-any-offer')->first();
        $viewOfferPermission = Permission::where('slug','view-offer')->first();
        $createOfferPermission = Permission::where('slug','create-offer')->first();
        $deleteOfferPermission = Permission::where('slug','delete-offer')->first();
        $editOfferPermission = Permission::where('slug','edit-offer')->first();

        $viewAnyCompanyPermission = Permission::where('slug','view-any-company')->first();
        $viewCompanyPermission = Permission::where('slug','view-company')->first();
        $createCompanyPermission = Permission::where('slug','create-company')->first();
        $editCompanyPermission = Permission::where('slug','update-company')->first();
        $deleteCompanyPermission = Permission::where('slug','delete-company')->first();

        $adminUser = new User();
        $adminUser->name = 'Администратор';
        $adminUser->email = 'admin@admin.com';
        $adminUser->email_verified_at = Carbon::now()->toDateTimeString();
        $adminUser->password = bcrypt('secret');
        $adminUser->save();
        $adminUser->roles()->attach($adminRole);

        $adminUser->permissions()->attach($viewAnyOfferPermission);
        $adminUser->permissions()->attach($viewOfferPermission);
        $adminUser->permissions()->attach($createOfferPermission);
        $adminUser->permissions()->attach($deleteOfferPermission);
        $adminUser->permissions()->attach($editOfferPermission);

        $adminUser->permissions()->attach($viewAnyCompanyPermission);
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
        $companyUser->permissions()->attach($createOfferPermission);
        $companyUser->permissions()->attach($deleteOfferPermission);
        $companyUser->permissions()->attach($editOfferPermission);
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
        $clientUser->permissions()->attach($viewAnyOfferPermission);
        $clientUser->permissions()->attach($viewCompanyPermission);
    }
}
