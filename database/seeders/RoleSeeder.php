<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Contracts\Permission as PermissionContract;


class RoleSeeder extends Seeder
{
    public RoleContract|Role $admin;
    public RoleContract|Role $auditor;
    public RoleContract|Role $register;
    public RoleContract|Role $guest;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Todo Create Roles 
        $this->createRoles();

        // todo Add Permission 

        // todo routes auditActivity.index

        $this->AddPermission(
            roles: [$this->admin], 
            permission: Permission::create(["name" => "auditActivity.index.year"])
        );

        $this->AddPermission(
            roles: [$this->admin, $this->register], 
            permission: Permission::create(["name" => "auditActivity.index.newAuditActivity"])
        );

        // todo routes auditActivity.show

        $this->AddPermission(
            roles: [$this->admin, $this->register], 
            permission: Permission::create(["name" => "auditActivity.show.designationAcreditation"])
        );

        // todo routes handoverDocument.register

        $this->AddPermission(
            roles: [$this->admin, $this->register], 
            permission: Permission::create(["name" => "handoverDocument.register"])
        );
    }

    private function createRoles(): void
    {
        $this->admin = Role::create(["name" => "admin"]);
        $this->auditor = Role::create(["name" => "auditor"]);
        $this->register = Role::create(["name" => "register"]);
        $this->guest = Role::create(["name" => "guest"]);
    }

    private function AddPermission(array $roles, PermissionContract|Permission $permission): void
    {
        $permission->syncRoles($roles);
    }

}
