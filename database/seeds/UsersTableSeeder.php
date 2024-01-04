<?php

use Anacreation\Organization\Entities\Organization;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = [
            [
                'name'              => 'Xavier Au',
                'email'             => 'xavier.au@anacreation.com',
                'password'          => Hash::make('aukaiyuen'),
                'email_verified_at' => \Carbon\Carbon::now(),
                'role'              => 'administrator',
            ],
            [
                'name'              => 'Administrator',
                'email'             => 'admin@sincere.com',
                'password'          => Hash::make('password'),
                'email_verified_at' => \Carbon\Carbon::now(),
                'role'              => 'administrator',
            ],
        ];

        /** @var User $user */
        foreach($users as $user) {
            $role = $user['role'];
            unset($user['role']);
            $newUser = User::create($user);
            $newUser->assignRole($role);
            $newUser->assignToOrganization(Organization::first(),
                                           true);

        }
    }
}
