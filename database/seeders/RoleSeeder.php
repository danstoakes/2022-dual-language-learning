<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                "name" => "Admin",
                "description" => "Responsible for managing, troubleshooting, licensing, and updating hardware and software assets."
            ],
            [
                "name" => "Moderator",
                "description" => "Responsible for managing on-site content as well as user requests."
            ],
            [
                "name" => "User",
                "description" => "Reponsible for utilising the site to practise language learning."
            ]
        ];

        foreach ($roles as $role) {
            Role::create(
                [
                    "name" => $role["name"],
                    "description" => $role["description"]
                ]
            );
        }
    }
}