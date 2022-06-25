<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2a$12$TKwE.Yzopo/.DnJEIu4hrutuhjJytxsKk2ALDQj0XgT0N4ZXq5dge',
                'remember_token' => null,
                'created_at'     => '2019-09-15 06:09:29',
                'updated_at'     => '2019-09-15 06:09:29',
            ],
        ];

        User::insert($users);
    }
}
