<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Milagros',
            'email' => 'mruiz.oporta@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678') , // password
            'cedula' =>'365-260786-0001J',
            'address' => 'Modesto Duarte',
            'phone'=>'84368899',
            'role'=>'admin',
        ]);

        User::create([
            'name' => 'Paciente1',
            'email' => 'peciente@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678') , // password
            'cedula' =>'365-260786-0001J',
            'address' => 'Modesto Duarte',
            'phone'=>'84368899',
            'role'=>'paciente',
        ]);

        User::create([
            'name' => 'Doctor',
            'email' => 'doctor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678') , // password
            'cedula' =>'365-260786-0001J',
            'address' => 'Modesto Duarte',
            'phone'=>'84368899',
            'role'=>'doctor',
        ]);
        User::factory()
                ->count(50)
                ->state(['role'=> 'paciente'])
                ->create();
    }
}
