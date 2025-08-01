<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
class CreateAdmin extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
        ['email' => 'superadmin@example.com'],
        [
            'first_name' => 'le trong',
            'last_name' => 'khanh',
            'password' => '12345678',
        ]
    );
        
        $user->assignRole("superadmin");
    }
}
