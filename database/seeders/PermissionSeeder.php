<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                "name" => "user-list",
                "description" => "List a resource."
            ],
            [
                "name" => "user-create",
                "description" => "Create a resource."
            ],
            [
                "name" => "user-edit",
                "description" => "Edit a resource."
            ],
            [
                "name" => "user-delete",
                "description" => "Delete a resource."
            ],
            [
                "name" => "role-list",
                "description" => "List a resource."
            ],
            [
                "name" => "role-create",
                "description" => "Create a resource."
            ],
            [
                "name" => "role-edit",
                "description" => "Edit a resource."
            ],
            [
                "name" => "role-delete",
                "description" => "Delete a resource."
            ],
            [
                "name" => "permission-list",
                "description" => "List a resource."
            ],
            [
                "name" => "permission-create",
                "description" => "Create a resource."
            ],
            [
                "name" => "permission-edit",
                "description" => "Edit a resource."
            ],
            [
                "name" => "permission-delete",
                "description" => "Delete a resource."
            ],
            [
                "name" => "language-list",
                "description" => "List a resource."
            ],
            [
                "name" => "language-create",
                "description" => "Create a resource."
            ],
            [
                "name" => "language-edit",
                "description" => "Edit a resource."
            ],
            [
                "name" => "language-delete",
                "description" => "Delete a resource."
            ],
            [
                "name" => "module-list",
                "description" => "List a resource."
            ],
            [
                "name" => "module-create",
                "description" => "Create a resource."
            ],
            [
                "name" => "module-edit",
                "description" => "Edit a resource."
            ],
            [
                "name" => "module-delete",
                "description" => "Delete a resource."
            ],
            [
                "name" => "phrase-list",
                "description" => "List a resource."
            ],
            [
                "name" => "phrase-create",
                "description" => "Create a resource."
            ],
            [
                "name" => "phrase-edit",
                "description" => "Edit a resource."
            ],
            [
                "name" => "phrase-delete",
                "description" => "Delete a resource."
            ],
            [
                "name" => "phrase-manage",
                "description" => "Manage a resource."
            ],
            [
                "name" => "recording-list",
                "description" => "List a resource."
            ],
            [
                "name" => "recording-create",
                "description" => "Create a resource."
            ],
            [
                "name" => "recording-edit",
                "description" => "Edit a resource."
            ],
            [
                "name" => "recording-delete",
                "description" => "Delete a resource."
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::create(
                [
                    "name" => $permission["name"],
                    "description" => $permission["description"]
                ]
            );
        }
    }
}