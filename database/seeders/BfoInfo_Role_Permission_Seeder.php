<?php

namespace Totaa\TotaaBfo\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class BfoInfo_Role_Permission_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Permission::where("name", "view-bfo")->count() == 0) {
            $permission[] = Permission::create(['name' => 'view-bfo', "description" => "Xem Thông tin BFO", "group" => "Thông tin BFO", "order" => 1, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "view-bfo")->first();
        }

        if (Permission::where("name", "add-bfo")->count() == 0) {
            $permission[] = Permission::create(['name' => 'add-bfo', "description" => "Thêm Thông tin BFO", "group" => "Thông tin BFO", "order" => 2, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "add-bfo")->first();
        }

        if (Permission::where("name", "edit-bfo")->count() == 0) {
            $permission[] = Permission::create(['name' => 'edit-bfo', "description" => "Sửa Thông tin BFO", "group" => "Thông tin BFO", "order" => 3, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "edit-bfo")->first();
        }

        if (Permission::where("name", "delete-bfo")->count() == 0) {
            $permission[] = Permission::create(['name' => 'delete-bfo', "description" => "Xóa Thông tin BFO", "group" => "Thông tin BFO", "order" => 4, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "delete-bfo")->first();
        }

        if (Role::where("name", "super-admin")->count() == 0) {
            $super_admin =  Role::create(['name' => 'super-admin', "description" => "Super Admin", "group" => "Admin", "order" => 1, "lock" => true,]);
        } else {
            $super_admin = Role::where("name", "super-admin")->first();
        }

        if (Role::where("name", "admin")->count() == 0) {
            $admin = Role::create(['name' => 'admin', "description" => "Admin", "group" => "Admin", "order" => 2, "lock" => true,]);
        } else {
            $admin = Role::where("name", "admin")->first();
        }

        if (Role::where("name", "admin-bfo")->count() == 0) {
            $admin_bfo = Role::create(['name' => 'admin-bfo', "description" => "Admin Quản lý Thông tin BFO", "group" => "Admin", "order" => 2, "lock" => true,]);
        } else {
            $admin_bfo = Role::where("name", "admin-bfo")->first();
        }

        $super_admin->givePermissionTo($permission);
        $admin->givePermissionTo($permission);
        $admin_bfo->givePermissionTo($permission);
    }
}
