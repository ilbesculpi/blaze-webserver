<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SystemUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => Str::ulid(),
            'name' => 'System Admin',
            'email' => 'sysadmin@localhost',
            'password' => Hash::make('adminadmin%'),
            'role' => 'sysadmin',
        ]);
    }
}
