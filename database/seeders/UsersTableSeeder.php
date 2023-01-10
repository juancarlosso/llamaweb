<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'juan.carlos@jasoluciones.com.mx',
            'name' => 'Juan Carlos Salinas Ojeda',
            'password' => bcrypt('familia1'),
            'status' => 1,
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);

    }
}
